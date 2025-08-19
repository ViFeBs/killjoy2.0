<?php
include("../php/Conexao.php");
session_start();
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
$idPedido = $_GET['id'];
?>

<!DOCTYPE html>
<html lang="pt">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Meu Perfil</title>
  <link rel="stylesheet" href="../css/Home.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/afdd67c71b.js" crossorigin="anonymous"></script>
</head>

<body>

  <!-- Header -->
  <div class="container-fluid col-md-12" id="headerHome">
    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between">
      <div class="col-md-3 mb-2 mb-md-0 justify-content-center">
        <a href="Home.php" target="_blank" class="logo">
          <img id="logo" src="../imagens/Logo.png" class="imagem">
        </a>
      </div>


      <h1>
        Perfil
      </h1>
      <!-- Login e botão -->
      <div class="col-md-3 text-end">
        <a href="Home.php" style="color: #1D5C96;">Voltar</a>
        <a href="../php/Deslogar.php" style="color: #D4251A;">Sair</a>
      </div>

    </header>
  </div>
  <!--Fim do Header da Navbar-->


  <?php
      $sql_code = "select * from pedido P INNER JOIN cliente C ON P.id_cliente = C.id_cliente 
                                            INNER JOIN endereco E ON P.id_endereco = E.id_endereco 
                                            WHERE C.id_cliente = $idCliente AND P.id_pedido = $idPedido;";
      $sql_query = $mysqli->query($sql_code) or die($mysqli->error);
      $rows = $sql_query->num_rows;
      ?>
    <!-- Infos pedido-->
    <?php if ($rows > 0): ?>
          <?php while ($c = $sql_query->fetch_assoc()): ?>
                <div class="container" id="Perfil">
                    <div class="row align-items-center">
                    <div class="col">
                        <h1>
                            Pedido: <?php echo $c['id_pedido'] ?>
                        </h1>
                        <h2>
                            Status do Pedido: <?php echo $c['status_pedido'] ?>
                        </h2>
                        <h4>
                            Endereco de Entrega: 
                        </h4>
                        <p>Rua:
                            <?= $c['rua'] ?> Bairro:
                            <?= $c['bairro'] ?> Cidade:
                            <?= $c['cidade'] ?>,
                            <?= $c['uf'] ?>, Nº
                            <?= $c['numero'] ?>
                        </p>
                        <?php
                            $sql_code = "select * from produto P INNER JOIN produtos_pedido PE ON P.id_produto = PE.id_produto 
                                                    INNER JOIN Pedido PD ON PE.id_pedido = PD.id_pedido 
                                                    where PD.id_pedido = $idPedido;";
                            $sql_query = $mysqli->query($sql_code) or die($mysqli->error);
                            $rows = $sql_query->num_rows;
                        ?>
                        <h4>
                            Total do Pedido: <?= $c['valor_total'] ?>
                        </h4>
                        <h4>
                            Produtos do Pedido:
                        </h4>
                        <div class="d-flex col-12">
                        <?php while ($p = $sql_query->fetch_assoc()): ?>
                            <div class="col-md-3 mx-5" style="backgroundColor: #000000">
                                <div class="card">
                                    <img src="<?= $p['ftCapa'] ?>" class="card-img-top" alt="Camisa smile">

                                    <!--Informações do produto-->
                                    <div class="card-body">
                                    <h3 class="card-title">
                                        <?= $p['nmProduto'] ?>
                                    </h3>

                                    <!--Preço do Produto-->
                                    <p class="card-text">R$
                                        <?= $p['preco'] ?> Quantidade pedida:
                                        <?= $p['quantidade'] ?>
                                    </p>
                                    

                                    <!--Botão ver mais-->
                                    <a href="InfoProduto.php?id=<?= $p['id_produto'] ?>" class="btn btn-primary" id="btnVerMais">Ver
                                        Mais
                                    </a>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile ?>
                        </div>
                    </div>
                </div>
            <?php endwhile ?>
    <?php endif ?>



  <!-- Footer -->
  <footer class="d-flex flex-wrap justify-content-between align-items-center" id="footer">
    <div class="col-md-2 d-flex align-items-center">
      <a href="/" class="mb-3 me-2 mb-md-0 text-body-secondary text-decoration-none lh-1">
        <img id="logo" src="../imagens/Logo.png" class="imagem">
      </a>

    </div>
    <a class="mb-3 mb-md-0 text-white ">© 2023 Company, Inc</a>

    <ul class="nav col-md-2 justify-content-center list-unstyled d-flex">
      <li class="ms-3"><a class="text-white " href="#">Natan</a></li>
      <li class="ms-3"><a class="text-white " href="#">Bruno</a></li>
      <li class="ms-3"><a class="text-white " href="#">Iago</a></li>
    </ul>

  </footer>
  <!--Fim do Footer-->

</body>

</html>