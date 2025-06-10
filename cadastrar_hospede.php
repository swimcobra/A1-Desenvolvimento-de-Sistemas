<?php
    require_once 'require/functions.php';

    if(form_nao_enviado()) {
        header('location:index.php?codigo=0');
        exit;
    }

    if(campos_em_branco_cadastro()) {
        header('location:index.php?codigo=2');
        exit;
    }

    $nome   = $_POST['nome']; 
    $cpf    = $_POST['cpf'];
    $email  = $_POST['email'];
    $senha  = $_POST['senha'];

    require_once 'require/conexao.php';
    $conn = conectar_banco();

    $sql = "INSERT INTO hospedes (nome, cpf, email, senha) VALUES (?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);
    
    if(!$stmt) {
        header('location:index.php?codigo=3');
        exit;
    }

    mysqli_stmt_bind_param($stmt, "ssss", $nome, $cpf, $email, $senha);

    if(!mysqli_stmt_execute($stmt)) {
        header('location:index.php?codigo=3');
        exit;
    }

    mysqli_stmt_store_result($stmt); 

    if(mysqli_stmt_affected_rows($stmt) <= 0) {
        header('location:index.php?codigo=5');
        exit;
    }

    header('location:index.php?codigo=6');
?>