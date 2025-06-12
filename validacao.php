<?php
    require_once 'require/functions.php';

    //Verifica se o forms não foi enviado
    if(form_nao_enviado()) {
        //Redireciona para o index com código de erro '0'
        header('location:index.php?codigo=0');
        exit; //Interrompe o script
    }

    //Verifica se os campos de login estão em branco
    if(campos_em_branco_login()) {
        header('location:index.php?codigo=2');
        exit;
    }

    //Guarda os dados enviados pelo form via post
    $email  = $_POST['email'];
    $senha  = $_POST['senha'];

    //Inclui a função de conexão ao BD
    require_once 'require/conexao.php';
    //Conecta ao BD
    $conn = conectar_banco();

    // Criando a consulta no SQL
    $query = "SELECT * FROM hospedes WHERE email = ? AND senha = ?";
    //Prepara a consulta, evitando SQL injection
    $stmt = mysqli_prepare($conn, $query);

    //Se falhar redireciona
    if(!$stmt) {
        header('location:index.php?codigo=3');
        exit;
    }

    //Substitui os '?' pelos valores do usuario
    mysqli_stmt_bind_param($stmt, "ss", $email, $senha);

    //Executa a query
    $result = mysqli_stmt_execute($stmt);

    if(!$result) {
        header('location.index.php?codigo=3');
        exit;
    }

    //Guarda o resultado da consulta
    mysqli_stmt_store_result($stmt);
    //Verifica a aquiantidade de linhas retornadas
    $linhas = mysqli_stmt_num_rows($stmt);

    //Caso não encontre linhas redireciona
    if($linhas <= 0) {
        header('location:index.php?codigo=1');
        exit;
    }
    //Liga cada coluna as variaveis
    mysqli_stmt_bind_result($stmt, $login_id, $login_nome, $login_cpf, $login_email, $login_senha);
    //Busca os dados da linha e armazena nas variaveis
    mysqli_stmt_fetch($stmt);

    session_start();
    //Armazena os dados do usuario
    $_SESSION['id']     = $login_id;
    $_SESSION['nome']   = $login_nome;
    $_SESSION['cpf']    = $login_cpf;
    $_SESSION['email']  = $login_email;
    $_SESSION['senha']  = $login_senha;
    
    header('location:reservas.php');
?>
