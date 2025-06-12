<?php 
    require_once 'require/lock.php';
    //Verfica se o parametro foi passado pela URL, se não foi redireciona com erro
    if(!isset($_GET['id_reserva'])) {
        header('location:reservas.php?codigo=0');
        exit;
    }
    //Verficica se o usuario logado é o mesmo que está tentando excluir
    if($_SESSION['id'] != (int)$_GET['id_hospede']) {
        header('location:reservas.php?codigo=11');
        exit;
    }
    //Converte o ID para int
    $id_reserva = (int)$_GET['id_reserva'];
    //Monta a query para excluir
    $sql = "DELETE FROM reservas WHERE id_reserva = $id_reserva";

    require_once 'require/conexao.php';
    $conn = conectar_banco();
    //Executa a query da exclusão
    mysqli_query($conn, $sql);
    //Verifica se alguma linha foi alterada
    if(mysqli_affected_rows($conn) <= 0) {
        header('location:reservas.php?codigo=4');
        exit;
    }
    //Fecha a conexão com o BD
    mysqli_close($conn);
    
    header('location:reservas.php');
?>
