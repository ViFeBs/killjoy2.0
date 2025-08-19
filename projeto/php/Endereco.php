<?php

include("../php/Conexao.php");
session_start();

$Cep = mysqli_real_escape_string($mysqli, $_POST['Cep']);
$Logradouro = mysqli_real_escape_string($mysqli, $_POST['Logradouro']);
$Complemento = mysqli_real_escape_string($mysqli, $_POST['Complemento']);
$Rua = mysqli_real_escape_string($mysqli, $_POST['Rua']);
$Bairro = mysqli_real_escape_string($mysqli, $_POST['Bairro']);
$Cidade = mysqli_real_escape_string($mysqli, $_POST['Cidade']);
$Uf = mysqli_real_escape_string($mysqli, $_POST['Uf']);
$Numero = mysqli_real_escape_string($mysqli, $_POST['Numero']);
$idCliente = $_SESSION['idCliente'];


$sql = "INSERT INTO Endereco (cep, logradouro, complemento, rua, bairro, cidade, uf,numero)
         VALUES( '$Cep', '$Logradouro', '$Complemento','$Rua','$Bairro', '$Cidade', '$Uf','$Numero')";



if ($mysqli->query($sql) === TRUE) {
	$idEndereco = $mysqli->insert_id;
    $sql = "INSERT INTO Endereco_Entrega(id_endereco, id_cliente, padrao)
                VALUES( '$idEndereco', '$idCliente', 'false')";
    if ($mysqli->query($sql) === TRUE) {
        header('Location: ../telas/InfoCliente.php');
        exit;
    }
}else{
    echo $mysqli->error;
}

$mysqli->close();
?>