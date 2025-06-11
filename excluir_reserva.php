<?php 
    require_once 'require/lock.php';

    if(!isset($_GET['id_reserva'])) {
        header('location:reservas.php?codigo=0');
        exit;
    }

    if($_SESSION['id'] != (int)$_GET['id_hospede']) {
        header('location:reservas.php?codigo=11');
        exit;
    }

    $id_reserva = (int)$_GET['id_reserva'];
    
    $sql = "DELETE FROM reservas WHERE id_reserva = $id_reserva";

    require_once 'require/conexao.php';
    $conn = conectar_banco();

    mysqli_query($conn, $sql);

    if(mysqli_affected_rows($conn) <= 0) {
        header('location:reservas.php?codigo=4');
        exit;
    }

    mysqli_close($conn);
    
    header('location:reservas.php');
?>