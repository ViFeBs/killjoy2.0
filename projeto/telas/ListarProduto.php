<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Produtos</title>
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

  <h1>Listagem de Produtos</h1>
  <!--Pesquisa de produtos-->
  <div class="container">
    <form method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      <label for="filtro">Filtrar por nome:</label>
      <input type="text" name="filtro" id="filtro" value="<?php echo isset($_GET['filtro']) ? $_GET['filtro'] : ''; ?>">
      <button type="submit">Filtrar</button>
    </form>
  </div>

  <!--Tabela de Produtos-->
  <div class="container">
    <a class="btn btn-dark " href="CadastroProduto.php" role="button">+</a>
    <table>
      <thead>
        <tr>
          <th>Foto</th>
          <th>Nome</th>
          <th>Descricao</th>
          <th>Preço</th>
          <th> Quantidade </th>
          <th>Editar</th>
          <th> Ver </th>
        </tr>
      </thead>

      <tbody>
        <?php include("../php/ListarProduto.php"); ?>
      </tbody>

    </table>
  </div>
  <?php
  $mysqli->close();
  ?>
  </div>

</body>

</html>