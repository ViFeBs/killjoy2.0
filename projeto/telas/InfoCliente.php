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


  <!-- Infos cliente-->
  <div class="container" id="Perfil">
    <div class="row align-items-center">

      <div class="col" id="InfosPerfilEdit">
        <?php if ($rows > 0): ?>
          <?php while ($c = $sql_query->fetch_assoc()): ?>

            <!-- Campo nome -->
            <div class="col-6 col-sm-6 col-md-6">
              <h3 for="nome">Nome Completo</h3>
              <p>
                <?php echo ($c['nmCliente']) ?>
              </p>
            </div>

            <!-- Campo cpf -->
            <div class="col-12 col-sm-6 col-md-6">
              <h3 for="Cpf">CPF</h3>
              <p>
                <?php echo ($c['cpf']) ?>
              </p>
            </div>

            <!-- Campo email -->
            <div class="col-12 col-sm-6 col-md-6">
              <h3 for="Email">E-mail</h3>
              <p>
                <?php echo ($c['email']) ?>
              </p>
            </div>

            <!-- Campo data -->
            <div class="col-12 col-sm-6 col-md-6">
              <h3 for="Date">Data</h3>
              <p>
                <?php echo ($c['dtNacimento']) ?>
              </p>
            </div>

            <!-- Campo genero -->
            <div class="col-12 col-sm-6 col-md-6">
              <h3 for="Genero">Genero</h3>
              <p>
                <?php echo ($c['genero']) ?>
              </p>
            </div>

            <a href="AlterarCliente.php" class="btn btn-light" id="btnEditPerfil">Editar perfil</a>

          <?php endwhile ?>
        <?php endif ?>
      </div>


      <!-- Procura Endereços do cliente -->

      <?php
      $sql_code = "select * from Cliente C 
                            inner join Endereco_Entrega Ea on C.id_cliente = Ea.id_Cliente 
                            inner join Endereco E on Ea.id_endereco = E.id_endereco where C.id_cliente = $idCliente;";
      $sql_query = $mysqli->query($sql_code) or die($mysqli->error);
      $rows = $sql_query->num_rows;
      ?>
      <!-- Endereços do cliente -->
      <div class="col" id="InfosPerfilEdit">
        <h3 for="Endereco">Endereços</h3>
        <!-- botao add endereco cliente -->
        <a href="Enderecos.php" class="btn btn-primary" id="btnEnderecoPerfil">Adicionar novo endereço</a>


        <?php if ($rows > 0): ?>
          <?php while ($c = $sql_query->fetch_assoc()): ?>

            <div class="card col-md-12 text-center mx-auto" id="enderecosCard">
              <?php if ($c['padrao']) { ?>
                <div class="card-header">
                  Endereço de Entrega
                </div>

              <?php } elseif ($rows > 1) { ?>
                <div class="card-header">
                  <a href="../php/EnderecoPadrao.php?id=<?= $c['id_endereco'] ?>"> Tornar esse Meu Endereco Padrão </a>
                </div>
              <?php } ?>

              <div class="card-body">
                <h5 class="card-title">CEP:
                  <?= $c['cep'] ?>
                </h5>
                <p class="card-text">Rua:
                  <?= $c['rua'] ?> Bairro:
                  <?= $c['bairro'] ?> Cidade:
                  <?= $c['cidade'] ?>,
                  <?= $c['uf'] ?>, Nº
                  <?= $c['numero'] ?>
                </p>

                <a href="Enderecos.php?id=<?= $c['id_endereco'] ?>" class="btn btn-primary">Editar</a>
              </div>
            </div>

          <?php endwhile ?>
        <?php endif ?>
      </div>
    </div>

    <?php
    $sql_code = "select * from pedido P INNER JOIN cliente C ON P.id_cliente = C.id_cliente 
                                          INNER JOIN endereco E ON P.id_endereco = E.id_endereco where C.id_cliente = $idCliente";
    $sql_query = $mysqli->query($sql_code) or die($mysqli->error);
    $rows = $sql_query->num_rows;
    ?>

    <!-- pedidos do cliente -->
    <div class="col" id="InfosPerfilEdit">
      <h3 for="Pedidos">Pedidos</h3>
      <?php if ($rows > 0): ?>
        <?php while ($c = $sql_query->fetch_assoc()): ?>

          <div class="card col-md-12 text-center mx-auto" id="enderecosCard">
            <div class="card-header">
              Pedido:
              <?php echo $c['id_pedido'] ?>
            </div>
            <div class="card-body">
              <h5 class="card-title">Status:
                <?= $c['status_pedido'] ?>
              </h5>
              <p class="card-text">Rua:
                <?= $c['rua'] ?> Nº
                <?= $c['numero'] ?>
                Valor Total:
                <?= $c['valor_total'] ?>
              </p>

              <a href="DetalhePedido.php?id=<?= $c['id_pedido'] ?>" class="btn btn-primary">Detalhes</a>
            </div>
          </div>

        <?php endwhile ?>
      <?php endif ?>
    </div>
  </div>
  </div>




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