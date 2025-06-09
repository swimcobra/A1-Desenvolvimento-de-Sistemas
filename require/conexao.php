<?php 
function conectar_banco() {

    $servidor   = 'localhost:3306'; // Conferir qual porta está sendo utilizada pelo MySql no xampp
    $usuario    = 'root';
    $senha      = '';
    $banco      = 'hotelconsagrado_bd';   
    
    $conn = mysqli_connect($servidor, $usuario, $senha, $banco);

    if (!$conn) {
        exit("Erro na conexão: " . mysqli_connect_error());
    }

    return $conn;
}

?>