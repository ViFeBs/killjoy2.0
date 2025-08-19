<?php
session_start();
include("conexao.php");
$idCliente = $_SESSION['idCliente'];


$nmCliente = $_POST['nmCliente'];
$genero = $_POST['genero'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$dtNacimento = $_POST['dtNascimento'];

if($genero == "Masculino"){
    $genero = 'M';
}else if($genero == "Feminino"){
    $genero = 'F';
}else{
    $genero = 'O';
}

$confirmSenha = mysqli_real_escape_string($mysqli, trim(($_POST['confirmSenha'])));
if ($senha !== $confirmSenha) {
  $_SESSION['senha_nao_confere'] = true;
  header('Location: ../telas/AlterarCliente.php');
  exit;
}


$sqlUpdate = "UPDATE Cliente SET nmCliente='$nmCliente',email='$email',senha=md5('$senha'),dtNacimento='$dtNacimento', genero = '$genero' WHERE id_cliente = $idCliente";


$result = $mysqli->query($sqlUpdate);
header('Location: ../telas/InfoCliente.php');
?>