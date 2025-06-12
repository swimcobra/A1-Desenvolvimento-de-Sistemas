<?php session_start();
    //Verfica se as variaveis de sessão estão definidas
    if(!isset($_SESSION['email']) || !isset($_SESSION['senha'])) {
        header('location:index.php?codigo=0'); 
    }
?>
