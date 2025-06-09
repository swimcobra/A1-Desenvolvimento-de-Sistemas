<?php require_once 'require/lock.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservas</title>
</head>
<body>
    <h1>Cadastro</h1>

    <nav>
        <a href="index.php">Home</a>
        <a href="cadastro.php">Cadastro</a>
        <a href="logout.php">Logout</a>
    </nav>
    
     <h2>Bem vindo, <?= $_SESSION['nome'] ?>!</h2>

    <ul>
        <li><a href="hospedes.php">Hospedes</a></li>
        <li><a href="reservas.php">Reservas</a></li>
        <li><a href="quartos.php">Quartos</a></li>
    </ul>

    <?php
        require_once 'require/functions.php';

        verificar_codigo();
    ?>
</body>
</html>