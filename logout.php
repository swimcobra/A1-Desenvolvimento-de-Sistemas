<?php session_start();
    unset($_SESSION);   // Apaga dados da variável de sessão
    session_destroy();  // Finaliza a sessão
    header('location:index.php');
?>