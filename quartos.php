<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quartos</title>
    <link rel="stylesheet" href="css/desktop.css">
</head>
<body>
    <header>
        <h1>Quartos</h1>
        <nav>
            <a href="index.php">Home</a>
            <a href="reservas.php">Reservas</a>
            <a href="quartos.php">Quartos</a>
            <a href="logout.php">Logout</a>
        </nav>
    </header>
    <hr>
    <main>
        <?php
            require_once 'require/conexao.php';
            require_once 'require/functions.php';
            verificar_codigo();
            $conn = conectar_banco();
            $sql = "SELECT * FROM quartos";
            $result = mysqli_query($conn, $sql);
            if(mysqli_affected_rows($conn) <= 0) {
                exit("<h3>Não existem quartos cadastrados</h3>");
            }
            echo "<h3>Lista de Quartos</h3>";
            echo    "<table>";
            echo        "<tr>";
            echo            "<th>Id</th>";
            echo            "<th>Número</th>";
            echo            "<th>Tipo</th>";
            echo            "<th>Preço</th>";
            echo        "</tr>";
            while($quarto = mysqli_fetch_assoc($result)) {
                $id_quarto          = $quarto['id_quarto'];
                $numero_quarto      = $quarto['numero'];
                $tipo_quarto        = $quarto['tipo'];
                $preco_quarto       = $quarto['preco'];
                echo "<tr>";
                echo    "<td> $id_quarto </td>";
                echo    "<td> $numero_quarto </td>";
                echo    "<td> $tipo_quarto </td>";
                echo    "<td> $preco_quarto </td>";
                echo "</tr>";
            }
            echo "</table>";
        ?>
    </main>
    <footer>
        <p>Site criado apenas para estudo pessoal</p>
    </footer>
</body>
</html>