<?php

session_start();
include("conexao.php");
$idCliente = $_SESSION['idCliente']; 
$idEntrega = $_SESSION['Endereco_Entrega'];
$valor = $_SESSION['valor'];
$max = sizeof($_SESSION['cart']);


$sql = "INSERT INTO Pedido(id_cliente, id_endereco, valor_total, status_pedido)
        	VALUES( '$idCliente', '$idEntrega' ,'$valor', 'aguardando pagamento')";
if ($mysqli->query($sql) === TRUE) {
	$idPedido = $mysqli->insert_id;
    for ($i = 0; $i < $max; $i++){
        $id_prod = $_SESSION['cart'][$i]['product'];
        $qtd = $_SESSION['cart'][$i]['quantity'];
        $sql = "INSERT INTO Produtos_Pedido(id_pedido, id_produto, quantidade)
                    VALUES( '$idPedido', '$id_prod', '$qtd')";
   //     $mysqli->query($sql) or die($mysqli->error);
    }
    $_SESSION['id_pedido'] = $idPedido;
    $_SESSION['cart'] = null;
    header('Location: ../telas/Home.php?id=0');
    exit;
} else {
	echo $mysqli->error;
}

$mysqli->close();

?>