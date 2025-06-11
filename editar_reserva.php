<?php
    require_once 'require/lock.php';

    require_once 'require/functions.php';

    if(form_nao_enviado()) {
        header('location:edicao.php?codigo=0');
        exit;
    }

    if(campos_em_branco_reserva()) {
        header('location:edicao.php?codigo=2');
        exit;
    }

    if($_SESSION['id'] != (int)$_POST['id_hospede']) {
        header('location:reservas.php?codigo=12');
        exit;
    }


    $id_reserva = $_POST['id_reserva'];
    $id_hospede = $_POST['id_hospede']; 
    $checkIn    = $_POST['checkIn'];
    $checkOut   = $_POST['checkOut'];
    $quarto_id  = $_POST['quarto_id'];

    require_once 'require/conexao.php';
    $conn = conectar_banco();

    $query = "SELECT COUNT(*) AS conflitos
                FROM reservas
                WHERE
                    quarto_id = ? AND
                    (
                    checkIn < ? AND
                    checkOut > ?
                    )
                    AND id_reserva != ?";

    $stmt = mysqli_prepare($conn, $query);

    if(!$stmt) {
        header('location:reservas.php?codigo=3');
        exit;
    }

    mysqli_stmt_bind_param($stmt, "issi", $quarto_id, $checkOut, $checkIn, $id_reserva);

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

    $sql = "UPDATE reservas 
                SET 
                    checkIn = ?, checkOut = ?, quarto_id = ?
                WHERE
                    id_reserva = ?";

    $stmt = mysqli_prepare($conn, $sql);
    
    if(!$stmt) {
        header('location:reservas.php?codigo=3');
        exit;
    }

    mysqli_stmt_bind_param($stmt, "ssii", $checkIn, $checkOut, $quarto_id, $id_reserva);

    if(!mysqli_stmt_execute($stmt)) {
        header('location:reservas.php?codigo=3');
        exit;
    }

    mysqli_stmt_store_result($stmt); 

    if(mysqli_stmt_affected_rows($stmt) <= 0) {
        header('location:reservas.php?codigo=14');
        exit;
    }

    header('location:reservas.php?codigo=15');
?>