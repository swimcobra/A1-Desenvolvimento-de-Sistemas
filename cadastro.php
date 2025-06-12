<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="css/desktop.css">
</head>
<body>
    <header>
        <h1>Cadastro</h1>
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
            require_once 'require/functions.php';
            verificar_codigo();
        ?>
        <form action="cadastrar_hospede.php" method="post">
        
            <p>
                <label for="nome">Nome</label><br>
                <input type="text" name="nome" id="nome">
            </p>
            <p>
                <label for="cpf">CPF</label><br>
                <input type="text" name="cpf" id="cpf">
            </p>
            <p>
                <label for="email">E-mail</label><br>
                <input type="email" name="email" id="email">
            </p>
            <p>
                <label for="senha">Senha</label><br>
                <input type="password" name="senha" id="senha">
            </p>
        <button type="submit">Cadastrar</button>
    </form>
</main>
<footer>
        <p>Site criado apenas para estudo pessoal</p>
    </footer>
</body>
</html>