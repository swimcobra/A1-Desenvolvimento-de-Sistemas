<?php
    require_once 'require/functions.php';//teste

    if(form_nao_enviado()) {
        header('location:cadastro.php?codigo=0');
        exit;
    }

    if(campos_em_branco_cadastro()) {
        header('location:cadastro.php?codigo=2');
        exit;
    }

    $nome   = $_POST['nome']; 
    $cpf    = $_POST['cpf'];
    $email  = $_POST['email'];
    $senha  = $_POST['senha'];

    require_once 'require/conexao.php';
    $conn = conectar_banco();

    $query = "SELECT * FROM hospedes WHERE email = ? OR cpf = ?";

    $stmt = mysqli_prepare($conn, $query);

    if(!$stmt) {
        header('location:cadastro.php?codigo=3');
        exit;
    }

    mysqli_stmt_bind_param($stmt, "ss", $email, $cpf);

    $result = mysqli_stmt_execute($stmt);

    if(!$result) {
        header('location.cadastro.php?codigo=3');
        exit;
    }

    mysqli_stmt_store_result($stmt);
    $linhas = mysqli_stmt_num_rows($stmt);

    if($linhas > 0) {
        header('location:cadastro.php?codigo=7');
        exit;
    }

    $sql = "INSERT INTO hospedes (nome, cpf, email, senha) VALUES (?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);
    
    if(!$stmt) {
        header('location:cadastro.php?codigo=3');
        exit;
    }

    mysqli_stmt_bind_param($stmt, "ssss", $nome, $cpf, $email, $senha);

    if(!mysqli_stmt_execute($stmt)) {
        header('location:cadastro.php?codigo=3');
        exit;
    }

    mysqli_stmt_store_result($stmt); 

    if(mysqli_stmt_affected_rows($stmt) <= 0) {
        header('location:cadastro.php?codigo=9');
        exit;
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    header('location:index.php?codigo=6');
?>