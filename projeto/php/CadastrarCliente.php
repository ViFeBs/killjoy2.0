<?php

session_start();
include("conexao.php");
$nome = mysqli_real_escape_string($mysqli, $_POST['nmCliente']);
$Cpf = mysqli_real_escape_string($mysqli, $_POST['Cpf']);
$Email = mysqli_real_escape_string($mysqli, $_POST['Email']);
$Senha = mysqli_real_escape_string($mysqli, ($_POST['Senha']));
$Data = mysqli_real_escape_string($mysqli, ($_POST['data']));
$Genero = mysqli_real_escape_string($mysqli, $_POST['genero']);

if($Genero == "Masculino"){
	$Genero = 'M';
}else if($Genero == "Feminino"){
$Genero = 'F';
}else{
	$Genero = 'O';
}
  

//Endereço Faturamento
$Cep = mysqli_real_escape_string($mysqli, $_POST['Cep']);
$Logradouro = mysqli_real_escape_string($mysqli, $_POST['Logradouro']);
$Complemento = mysqli_real_escape_string($mysqli, $_POST['Complemento']);
$Rua = mysqli_real_escape_string($mysqli, $_POST['Rua']);
$Bairro = mysqli_real_escape_string($mysqli, $_POST['Bairro']);
$Cidade = mysqli_real_escape_string($mysqli, $_POST['Cidade']);
$Uf = mysqli_real_escape_string($mysqli, $_POST['Uf']);
$Numero = mysqli_real_escape_string($mysqli, $_POST['Numero']);

$isEntrega = false;
if(!isset($_POST['chk'])){
	$isEntrega = true;
	echo("ok");
	$CepEntrega = mysqli_real_escape_string($mysqli, $_POST['CepEntrega']);
	$LogradouroEntrega = mysqli_real_escape_string($mysqli, $_POST['LogradouroEntrega']);
	$ComplementoEntrega = mysqli_real_escape_string($mysqli, $_POST['ComplementoEntrega']);
	$RuaEntrega = mysqli_real_escape_string($mysqli, $_POST['RuaEntrega']);
	$BairroEntrega = mysqli_real_escape_string($mysqli, $_POST['BairroEntrega']);
	$CidadeEntrega = mysqli_real_escape_string($mysqli, $_POST['CidadeEntrega']);
	$UfEntrega = mysqli_real_escape_string($mysqli, $_POST['UfEntrega']);
	$NumeroEntrega = mysqli_real_escape_string($mysqli, $_POST['NumeroEntrega']);
}



function validar_cpf($cpf)
{
	// remove caracteres especiais do CPF
	$cpf = preg_replace('/[^0-9]/', '', $cpf);
	// verifica se o CPF tem 11 dígitos
	if (strlen($cpf) != 11) {
		return false;
	}
	// verifica se o CPF é uma sequência de números iguais (ex: 111.111.111-11)
	if (preg_match('/(\d)\1{10}/', $cpf)) {
		return false;
	}
	// calcula o primeiro dígito verificador
	$soma = 0;
	for ($i = 0; $i < 9; $i++) {
		$soma += (int) $cpf[$i] * (10 - $i);
	}
	$resto = $soma % 11;
	$digito1 = $resto < 2 ? 0 : 11 - $resto;
	// calcula o segundo dígito verificador
	$soma = 0;
	for ($i = 0; $i < 10; $i++) {
		$soma += (int) $cpf[$i] * (11 - $i);
	}
	$resto = $soma % 11;
	$digito2 = $resto < 2 ? 0 : 11 - $resto;
	// verifica se os dígitos verificadores estão corretos
	if ($cpf[9] != $digito1 || $cpf[10] != $digito2) {
		return false;
	}
	// CPF válido
	return true;
}

$sql = "select count(*) as total from Cliente where email = '$Email'";
$result = $mysqli->query($sql);
$row = mysqli_fetch_assoc($result);

if ($row['total'] == 1) {
	$_SESSION['usuario_existe'] = true;
	header('Location: ../telas/CadastroCliente.php');
	exit;
}


if (!validar_cpf($Cpf)) {
	$_SESSION['cpf_invalido'] = true;
	header('Location: ../telas/CadastroCliente.php');
	exit;
}

$confirmSenha = mysqli_real_escape_string($mysqli, trim(($_POST['ConfirmarSenha'])));
if ($Senha !== $confirmSenha) {
  $_SESSION['senha_nao_confere'] = true;
  header('Location: ../telas/Cadastro.html');
  exit;
}

$sql = "INSERT INTO Endereco(cep, logradouro, complemento, rua, bairro, cidade, uf,numero)
        	VALUES( '$Cep', '$Logradouro', '$Complemento','$Rua','$Bairro', '$Cidade', '$Uf','$Numero')";
if ($mysqli->query($sql) === TRUE) {
	$idEndereco = $mysqli->insert_id;
	$sql = "INSERT INTO Cliente(nmCliente, cpf, email, senha, dtNacimento, genero, id_enderecoFaturamento)
				VALUES( '$nome', '$Cpf', '$Email',md5('$Senha'),'$Data', '$Genero', '$idEndereco')";
	if ($mysqli->query($sql) === TRUE) {
		$idCliente = $mysqli->insert_id;
		$padrao = false;
		$sql = "select count(*) as total from Endereco_Entrega where id_cliente = '$idCliente'";
		$result = $mysqli->query($sql);
		$row = mysqli_fetch_assoc($result);

		if ($row['total'] < 1) {
			$padrao = true;
		}
		if(!$isEntrega){
			$sql = "INSERT INTO Endereco_Entrega(id_endereco, id_cliente, padrao)
						VALUES( '$idEndereco', '$idCliente', 'false')";
			if ($mysqli->query($sql) === TRUE) {
				header('Location: ../telas/LoginCliente.php?id=0');
				exit;
			}
		}else{
			$sql = "INSERT INTO Endereco(cep, logradouro, complemento, rua, bairro, cidade, uf,numero)
						VALUES( '$CepEntrega', '$LogradouroEntrega', '$ComplementoEntrega','$RuaEntrega','$BairroEntrega', '$CidadeEntrega', '$UfEntrega','$NumeroEntrega')";
			if ($mysqli->query($sql) === TRUE) {
				$idEnderecoE = $mysqli->insert_id;
				$sql = "INSERT INTO Endereco_Entrega(id_endereco, id_cliente, padrao)
							VALUES( '$idEnderecoE', '$idCliente', 'false')";
				if ($mysqli->query($sql) === TRUE) {
					header('Location: ../telas/LoginCliente.php');
					exit;
				}
			}
		}
	}
} else {
	echo $mysqli->error;
}

$mysqli->close();

?>