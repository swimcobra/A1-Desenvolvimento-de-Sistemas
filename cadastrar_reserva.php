<?php
    require_once 'require/lock.php';

    require_once 'require/functions.php';

    if(form_nao_enviado()) {
        header('location:reservas.php?codigo=0');
        exit;
    }

    if(campos_em_branco_reserva()) {
        header('location:reservas.php?codigo=2');
        exit;
    }

    $id_hospede   = $_SESSION['id']; 
    $checkIn    = $_POST['checkIn'];
    $checkOut  = $_POST['checkOut'];
    $quarto_id  = $_POST['quarto_id'];

    require_once 'require/conexao.php';
    $conn = conectar_banco();

    $query = "SELECT COUNT(*) AS total_quartos FROM quartos WHERE id_quarto = ?";
    $stmt = mysqli_prepare($conn, $query);

    if (!$stmt) {
        error_log("Erro ao preparar statement de verificação de quarto: " . mysqli_error($conn));
        header('location:reservas.php?codigo=3');
        exit;
    }

    mysqli_stmt_bind_param($stmt, "i", $quarto_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    $quarto_existe = $row['total_quartos'];
    mysqli_stmt_close($stmt);

    if ($quarto_existe == 0) {
        header('location:reservas.php?codigo=16'); 
        exit;
    }

    $query = "SELECT COUNT(*) AS conflitos
                FROM reservas
                WHERE
                    quarto_id = ? AND
                    (
                    checkIn < ? AND
                    checkOut > ?
                    )";

    $stmt = mysqli_prepare($conn, $query);

    if(!$stmt) {
        header('location:reservas.php?codigo=3');
        exit;
    }

    mysqli_stmt_bind_param($stmt, "iss", $quarto_id, $checkOut, $checkIn);

    $result = mysqli_stmt_execute($stmt);

    if(!$result) {
        header('location.reservas.php?codigo=3');
        exit;
    }
    
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    $num_conflitos = $row['conflitos'];
    mysqli_stmt_close($stmt);

    if($num_conflitos > 0) {
        header('location:reservas.php?codigo=8');
        exit;
    }

    $sql = "INSERT INTO reservas (checkIn, checkOut, hospede_id, quarto_id) VALUES (?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);
    
    if(!$stmt) {
        header('location:reservas.php?codigo=3');
        exit;
    }

    mysqli_stmt_bind_param($stmt, "ssii", $checkIn, $checkOut, $id_hospede, $quarto_id);

    if(!mysqli_stmt_execute($stmt)) {
        header('location:reservas.php?codigo=3');
        exit;
    }

    mysqli_stmt_store_result($stmt); 

    if(mysqli_stmt_affected_rows($stmt) <= 0) {
        header('location:reservas.php?codigo=5');
        exit;
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    header('location:reservas.php?codigo=10');
?>