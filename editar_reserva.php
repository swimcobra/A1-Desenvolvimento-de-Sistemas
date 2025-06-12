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
    //Garante que o usuario esta editando apenas a sua reserva
    if($_SESSION['id'] != (int)$_POST['id_hospede']) {
        header('location:reservas.php?codigo=12');
        exit;
    }
    
    //Armazena os dados do form
    $id_reserva = $_POST['id_reserva'];
    $id_hospede = $_POST['id_hospede']; 
    $checkIn    = $_POST['checkIn'];
    $checkOut   = $_POST['checkOut'];
    $quarto_id  = $_POST['quarto_id'];

    require_once 'require/conexao.php';
    $conn = conectar_banco();

    //Prepara uma consulta para verificar se o quarto existe
    $query = "SELECT COUNT(*) AS total_quartos FROM quartos WHERE id_quarto = ?";
    $stmt = mysqli_prepare($conn, $query);

    //Se nao conseguir prepara, redireciona com erro
    if (!$stmt) {
        error_log("Erro ao preparar statement de verificação de quarto: " . mysqli_error($conn));
        header('location:reservas.php?codigo=3');
        exit;
    }

    //Vincula o parametro quarto_id e executa a consulta
    mysqli_stmt_bind_param($stmt, "i", $quarto_id);
    mysqli_stmt_execute($stmt);
    //Busca o resultado da consulta
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    $quarto_existe = $row['total_quartos'];
    mysqli_stmt_close($stmt);

    if ($quarto_existe == 0) {
        header('location:reservas.php?codigo=16'); 
        exit;
    }
    //Consulta para verificar se há conflito de datas
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
    //Vincula os parametros e executa
    mysqli_stmt_bind_param($stmt, "issi", $quarto_id, $checkOut, $checkIn, $id_reserva);

    $result = mysqli_stmt_execute($stmt);

    if(!$result) {
        header('location.reservas.php?codigo=3');
        exit;
    }

    //Pega o resultado da consulta de conflito
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    $num_conflitos = $row['conflitos'];
    mysqli_stmt_close($stmt);

    if($num_conflitos > 0) {
        header('location:reservas.php?codigo=8');
        exit;
    }
    //Prepara a query para atualizar a reserva
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
