<?php
include("../php/Conexao.php");
$idPedido = $_POST['idPedido'];

$sql = "UPDATE Pedido SET status_pedido = 'entregue' WHERE id_pedido = '$idPedido'";
if ($mysqli->query($sql) === TRUE) {
  echo "O status do pedido foi alterado para 'entregue'.";
} else {
  echo "Erro ao atualizar o status do pedido: " . $mysqli->error;
}

$mysqli->close();
?>
