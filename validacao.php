<?php
    require_once 'require/functions.php';

    if(form_nao_enviado()) {
        header('location:index.php?codigo=0');
        exit;
    }

    if(campos_em_branco_login()) {
        header('location:index.php?codigo=2');
        exit;
    }

    $email  = $_POST['email'];
    $senha  = $_POST['senha'];

    require_once 'require/conexao.php';
    $conn = conectar_banco();

    // Criando a consulta no BD
    $query = "SELECT * FROM hospedes WHERE email = ? AND senha = ?";

    $stmt = mysqli_prepare($conn, $query);

    if(!$stmt) {
        header('location:index.php?codigo=3');
        exit;
    }

    mysqli_stmt_bind_param($stmt, "ss", $email, $senha);

    $result = mysqli_stmt_execute($stmt);

    if(!$result) {
        header('location.index.php?codigo=3');
        exit;
    }

    mysqli_stmt_store_result($stmt);
    $linhas = mysqli_stmt_num_rows($stmt);

    if($linhas <= 0) {
        header('location:index.php?codigo=1');
        exit;
    }

    mysqli_stmt_bind_result($stmt, $login_id, $login_nome, $login_cpf, $login_email, $login_senha);

    mysqli_stmt_fetch($stmt);

    session_start();
    $_SESSION['id']     = $login_id;
    $_SESSION['nome']   = $login_nome;
    $_SESSION['cpf']    = $login_cpf;
    $_SESSION['email']  = $login_email;
    $_SESSION['senha']  = $login_senha;

    header('location:reservas.php');
?>