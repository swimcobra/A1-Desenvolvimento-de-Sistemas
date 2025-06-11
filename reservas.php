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

    <h2>Cadastrar Reserva</h2>
    <form action="cadastrar_reserva.php" method="post">
        <p>
            <label for="checkIn">Data de CheckIn</label>
            <input type="date" name="checkIn" id="checkIn">
        </p>
        <p>
            <label for="checkOut">Data de CheckOut</label>
            <input type="date" name="checkOut" id="checkOut">
        </p>
        <p>
            <label for="quarto_id">Id do Quarto</label>
            <input type="number" name="quarto_id" id="quarto_id">
        </p>
        <button type="submit">Cadastrar</button>
    </form>

    <?php
        require_once 'require/conexao.php';
        require_once 'require/functions.php';

        verificar_codigo();
        $conn = conectar_banco();

        $id = $_SESSION['id'];

        $sql = "SELECT * FROM reservas INNER JOIN hospedes ON reservas.hospede_id = hospedes.id_hospede WHERE hospede_id = $id";

        $result = mysqli_query($conn, $sql);

        if(mysqli_affected_rows($conn) <= 0) {
            exit("<h3>Não existem reservas cadastradas no seu nome</h3>");
        }

        echo "<h3>Lista de Reservas</h3>";
        echo    "<table>";
        echo        "<tr>";
        echo            "<th>Id da Reserva</th>";
        echo            "<th>Data de CheckIn</th>";
        echo            "<th>Data de CheckOut</th>";
        echo            "<th>Id do Hospede</th>";
        echo            "<th>Id do Quarto</th>";
        echo        "</tr>";
        while($reserva = mysqli_fetch_assoc($result)) {
            $id_reserva     = $reserva['id_reserva'];
            $data_checkIn   = $reserva['checkIn'];
            $data_checkOut  = $reserva['checkOut'];
            $id_hospede     = $reserva['hospede_id'];
            $id_quarto      = $reserva['quarto_id'];

            echo "<tr>";
            echo    "<td>" . $id_reserva . "</td>"; 
            echo    "<td>" . $data_checkIn . "</td>"; 
            echo    "<td>" . $data_checkOut . "</td>"; 
            echo    "<td>" . $id_quarto . "</td>"; 
            echo    "<td>" . $id_hospede . "</td>"; 
            echo    '<td><a href="edicao.php?id_reserva=' . $id_reserva . '&id_hospede=' . $id_hospede . '">Editar</a></td>';
            echo    '<td><a href="excluir_reserva.php?id_reserva=' . $id_reserva . '&id_hospede=' . $id_hospede . '">Excluir</a></td>'; 
            echo "</tr>";
        }
        echo "</table>";
    ?>
</body>
</html>