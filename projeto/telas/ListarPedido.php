<?php
include("../php/Conexao.php");
session_start();
$idPedido = $_POST['idPedido'];
$sql = "UPDATE Pedido SET status_pedido = 'entregue' WHERE id_pedido = '$idPedido'";
if ($mysqli->query($sql) === TRUE) {
  echo "O status do pedido foi alterado para 'entregue'.";
} else {
  echo "Erro ao atualizar o status do pedido: " . $mysqli->error;
}
$idCliente = $_SESSION['idCliente'];
$hidden = "";
$hiddenUser = "visually-hidden";
$nome = "";
if (isset($_SESSION['Logado'])) {
  $logado = $_SESSION['Logado'];
  $nome = $_SESSION['nmCliente'];
  $hidden = "visually-hidden";
  $hiddenUser = "";
}
$sql_code = "SELECT * FROM Cliente where id_cliente = $idCliente";
$sql_query = $mysqli->query($sql_code) or die($mysqli->error);
$rows = $sql_query->num_rows;
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pedidos</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/ListarProduto.css" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N"
    crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/afdd67c71b.js" crossorigin="anonymous"></script>

</head>

<body>

  <!--Header Navbar-->
  <header class="header">
    <div class="content">
      <a href="Home.php" target="_blank" class="logo"><img id="logo" src="../imagens/Logo.png" class="imagem"></a>
      <input class="mobile-btn" type="checkbox" id="mobile-btn" />
      <label class="mobile-icon" for="mobile-btn"><span class="hamburguer"></span></label>
      <ul class="nav">
        <li><a href="ListarPedido.php" title="Home">Pedidos</a></li>
        <li><a href="ListarUsuario.php" title="Usuário">Usuários</a></li>
        <li><a href="ListarProduto.php" title="Produtos">Produtos</a></li>
      </ul>
    </div>
  </header>
  <!--Fim do Header Navbar-->

  <h1>Listagem de Pedidos</h1>

  <?php
  $sql_code = "select * from pedido P INNER JOIN cliente C ON P.id_cliente = C.id_cliente 
                                          INNER JOIN endereco E ON P.id_endereco = E.id_endereco where C.id_cliente = $idCliente";
  $sql_query = $mysqli->query($sql_code) or die($mysqli->error);
  $rows = $sql_query->num_rows;
  ?>

  <!-- pedidos do cliente -->
  <div class="col-md-12" id="InfosPedidos">
    <?php if ($rows > 0): ?>
      <div class="row mx-5">
        <?php while ($c = $sql_query->fetch_assoc()): ?>

          <div class="col-md-4 my-5">
            <div class="card text-center mx-auto">
              <div class="card-header <?php echo ($c['status_pedido'] == 'aguardando pagamento') ? 'bg-danger text-white' : 'bg-success text-white'; ?>"">
                Pedido:
                <?php echo $c['id_pedido'] ?>
              </div>


              <div class="card-body">
                <?php if ($c['status_pedido'] == "aguardando pagamento"): ?>
                  <h5 class="card-title text-danger">Status:
                    <?php echo $c['status_pedido'] ?>
                  </h5>
                <?php else: ?>
                  <h5 class="card-title">Status:
                    <?php echo $c['status_pedido'] ?>
                  </h5>
                <?php endif ?>
                <?php if ($c['status_pedido'] == "aguardando pagamento"): ?>
                  <form action="../telas/ListarPedido.php" method="POST">
                    <input type="hidden" name="idPedido" value="<?php echo $c['id_pedido'] ?>">
                    <button type="submit">Entregue</button>
                  </form>
                <?php endif ?>
                <p class="card-text">
                  <strong>Rua:</strong>
                  <?= $c['rua'] ?> Nº
                  <?= $c['numero'] ?><br>
                  <strong>Valor Total:</strong>
                  <?= $c['valor_total'] ?>
                </p>
                <a href="DetalhePedido.php?id=<?= $c['id_pedido'] ?>" class="btn btn-primary">Detalhes</a>
              </div>
            </div>
          </div>


        <?php endwhile ?>
      </div>
    <?php endif ?>

  </div>

</body>

</html>