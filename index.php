<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Consagrado - Sistema de Reservas</title>
    <link rel="stylesheet" href="css/desktop.css">
</head>
<body>
    <header>
    <h1>Hotel Consagrado - Sistema de Reservas</h1>
        <nav>
            <a href="index.php">Home</a>
            <a href="cadastro.php">Cadastre-se</a>
            <a href="reservas.php">Reservas</a>
            <a href="quartos.php">Quartos</a>
            <a href="logout.php">Logout</a>
        </nav>
    </header>
    <hr>
    <main>
        <?php
            //Garante que o arquivos functions será incluído apenas uma vez
            require_once 'require/functions.php';
            verificar_codigo();
            session_start(); //Inicia a sessão PHP que permite acessar dados entre paginas
            incluir_form_login();
        ?>
    </main>
    <footer>
        <p>Site criado apenas para estudo pessoal</p>
    </footer>
</body>
</html>
