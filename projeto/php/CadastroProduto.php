<?php

session_start();
include("conexao.php");
$nomeProduto = mysqli_real_escape_string($mysqli, $_POST['nmProduto']);
$descricao = mysqli_real_escape_string($mysqli, $_POST['descricao']);
$preco = mysqli_real_escape_string($mysqli, $_POST['preco']);
$quantidade = mysqli_real_escape_string($mysqli, $_POST['quantidade']);


$arquivo = $_FILES['imagens'];
$ftCapa = "../imagens/ftCapa/" . $arquivo['name'][0];


$sql = "INSERT INTO Produto(nmProduto, descricao, preco, quantidade, ftCapa)
        VALUES( '$nomeProduto', '$descricao', '$preco','$quantidade','$ftCapa')";

if ($mysqli->query($sql) === TRUE) {
	$idProduto = $mysqli->insert_id;
	if(count($arquivo) > 0){
		for($i = 1;$i < count($arquivo); $i++){
			$path = "../imagens/ftCapa/" . $arquivo['name'][$i];
			if(move_uploaded_file($arquivo['tmp_name'][$i],$path)){
				$sql = "INSERT INTO imagem_produto(id_produto, imagem)
        				VALUES( '$idProduto', '$path')";
				$mysqli->query($sql) or die($mysqli->error);
			}
		}
	}
	$_SESSION['status_cadastro'] = true;
	header('Location: ../telas/HomeAdmin.php');
	exit;
} else {
	echo $mysqli->error;
}

$mysqli->close();
?>