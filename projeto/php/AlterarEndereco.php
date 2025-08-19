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
$idEndereco = $_GET['id'];

$sql = "UPDATE Endereco SET cep = '$Cep' , logradouro = '$Logradouro' , complemento = '$Complemento' , rua = '$Rua', 
        bairro = '$Bairro' , cidade = '$Cidade', uf = '$Uf', numero = $Numero where id_endereco = $idEndereco";



if ($mysqli->query($sql) === TRUE) {
    header('Location: ../telas/InfoCliente.php');
    exit;
}else{
    echo $mysqli->error;
}

$mysqli->close();
?>