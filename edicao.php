<?php 
    require_once 'require/lock.php';
    require_once 'require/functions.php';
    require_once 'require/conexao.php';
     //Verifica  se o ID da reserva foi passado pela URL
    if(!isset($_GET['id_reserva'])) {
        header('location:reservas.php?codigo=0');
        exit;
    }
    //Verifica se o usuario logado é o dono da reserva
    if($_SESSION['id'] != (int)$_GET['id_hospede']) {
        header('location:reservas.php?codigo=12');
        exit;
    }

    //Captura os parametros da URL e converte para inteiro
    $id_reserva = (int)$_GET['id_reserva'];
    $id_hospede = (int)$_GET['id_hospede'];

    Abre conexão com bd
    $conn = conectar_banco();


    $query = "SELECT checkIn, checkOut, quarto_id FROM reservas WHERE id_reserva = ?";
    $stmt = mysqli_prepare($conn, $query);

    if(!$stmt) {
        header('location:reservas.php?codigo=3');
        exit;
    }

    //Vincula o parametro da reserva
    mysqli_stmt_bind_param($stmt, "i", $id_reserva);
    //Executa a consulta
    mysqli_stmt_execute($stmt);
    //Pega o resultado
    $result = mysqli_stmt_get_result($stmt);
    $dados = mysqli_fetch_assoc($result);
    //Fecha a consulta e a conexão com o banco
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    //Verifica se encontrou os dados da reserva
    if(!$dados) {
        header('lcoation:reservas?codigo=13');
        exit;
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Reserva</title>
    <link rel="stylesheet" href="css/desktop.css">
</head>
<body>
    <header>
        <h1>Editar Reserva</h1>
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
        <form action="editar_reserva.php" method="post">
        
            <p>
                <label for="checkIn">CheckIn</label><br>
                <input type="date" name="checkIn" value="<?php echo $dados['checkIn']; ?>">
            </p>
            <p>
                <label for="checkOut">checkOut</label><br>
                <input type="date" name="checkOut" value="<?php echo $dados['checkOut']; ?>">
            </p>
            <p>
                <label for="quarto_id">Id do quarto</label><br>
                <input type="number" name="quarto_id" value="<?php echo $dados['quarto_id']; ?>">
            </p>
            <input type="hidden" name="id_reserva" value="<?php echo ($id_reserva); ?>">
            <input type="hidden" name="id_hospede" value="<?php echo ($id_hospede); ?>">
            <button type="submit">Editar</button>
        </form>
    </main>
    <footer>
        <p>Site criado apenas para estudo pessoal</p>
    </footer>
</body>
</html>
