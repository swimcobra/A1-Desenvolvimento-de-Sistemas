<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Consagrado - Sistema de Reservas</title>
</head>
<body>
    <h1>Hotel Consagrado - Sistema de Reservas</h1>

    <nav>
        <a href="index.php">Home</a>
        <a href="cadastro.php">Página de Cadastros</a>
        <a href="logout.php">Logout</a>
    </nav>

    <?php
        require_once 'require/functions.php';

        verificar_codigo();

        session_start();

        incluir_form_login();
    ?>
</body>
</html>