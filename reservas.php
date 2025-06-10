<?php require_once 'require/lock.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservas</title>
</head>
<body>
    <h1>Reservas</h1>

    <nav>
        <a href="index.php">Home</a>
        <a href="reservas.php">Reservas</a>
        <a href="quartos.php">Quartos</a>
        <a href="logout.php">Logout</a>
    </nav>
    
     <h2>Bem vindo, <?= $_SESSION['nome'] ?>!</h2>

    <?php
        require_once 'require/functions.php';

        verificar_codigo();
    ?>
</body>
</html>