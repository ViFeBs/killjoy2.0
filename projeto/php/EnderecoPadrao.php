<?php

include("../php/Conexao.php");
session_start();

$idCliente = $_SESSION['idCliente'];
$idEndereco = $_GET['id'];

$sql = "SELECT count(*) as total FROM Endereco_Entrega where padrao = true and id_cliente = $idCliente";
$result = $mysqli->query($sql);
$row = mysqli_fetch_assoc($result);

if ($row['total'] >= 1) {
	$sql_code = "UPDATE Endereco_Entrega SET padrao = false where id_cliente = $idCliente";
    $sql_query = $mysqli->query($sql_code) or die($mysqli->error);
}

$sql = "UPDATE Endereco_Entrega SET padrao = true WHERE id_cliente = $idCliente and id_endereco = $idEndereco";


//ao clicar no padrao ta jogando pro perfil

if ($mysqli->query($sql) === TRUE) {
    header('Location: ../telas/InfoCliente.php');
    exit;
}else{
    echo $mysqli->error;
}

$mysqli->close();
?>