<?php
include("../php/Conexao.php");
session_start();
$idProduto = $_GET['id'];
$sql_code = "SELECT * FROM Produto WHERE id_produto = $idProduto";
$nome = "";
$hiddenUser = "visually-hidden";
if (isset($_SESSION['Logado'])) {
  $logado = $_SESSION['Logado'];
  $nome = $_SESSION['nmCliente'];
  $hidden = "visually-hidden";
  $hiddenUser = "";
}
$sql_query = $mysqli->query($sql_code) or die($mysqli->error);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Info Produto</title>
  <link rel="stylesheet" href="../css/InfoProduto.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/afdd67c71b.js" crossorigin="anonymous"></script>
</head>

<body>

  <!-- Header da navbar-->
  <div id="home">
    <div class="container-fluid col-md-12" id="headerHome">
      <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between">
        <div class="col-md-3 mb-2 mb-md-0 justify-content-center">
          <a href="Home.php" target="_blank" class="logo">
            <img id="logo" src="../imagens/Logo.png" class="imagem">
          </a>
        </div>

        <!-- Barra de navegação -->
        <div class="col-md-4 text-center" id="navHome">
          <ul class="nav col-12 col-md-12 mb-2  mb-md-0">
            <li><a href="#" class="nav-link px-2 ">Home</a></li>
            <li><a href="#" class="nav-link px-2 text-white ">Coleção</a></li>
            <li><a href="#" class="nav-link px-2 text-white ">Lançamentos</a></li>
            <li><a href="#" class="nav-link px-2 text-white ">Promoções</a></li>
          </ul>
        </div>

        <!-- Login e botão -->
        <div class="col-md-3 text-center d-inline-flex justify-content-center align-items-center">

          <div class="<?php echo $hiddenUser ?>">
            <a href="InfoCliente.php" id="btnUser">
              <i class="fa-solid fa-user fa-2xl" style="color: #e7e42e;"></i>
              <?php echo $nome ?>
            </a>
          </div>

          <!-- botão quando deslogado-->
          <a href="LoginCliente.php" class=" <?php echo ($hidden) ?>" id="btnUser">
            <i class="fa-solid fa-user fa-2xl" style="color: #e7e42e;"></i>
            Perfil
          </a>

          <!-- botão carrinho-->
          <a href="../telas/Carrinho.php" id="btnUser" style="color: #2ea12e;">
            <i class="fa-solid fa-sack-dollar fa-2xl"></i>

          </a>

        </div>
      </header>
    </div>
    <!--Fim do Header da Navbar-->

    <!-- Produto -->
    <div class="container">
      <!--O carrossel com as imagens deve ser funcional
        - Deve apresentar nome do produto, descrição detalhada, valor, a avaliação-->

      <div class="row">
        <?php $produto = $sql_query->fetch_assoc() ?>
        <div class="col-6 ">
          <div id="carouselExample" class="carousel slide">
            <div class="carousel-inner">
              <?php $sql_code = "SELECT * FROM imagem_produto WHERE id_produto = $idProduto";
              $sql_query = $mysqli->query($sql_code) or die($mysqli->error);
              ?>
              <?php while ($img = $sql_query->fetch_assoc()): ?>
                <div class="carousel-item active">
                  <img src="<?= $img['imagem'] ?>" class="d-block w-100" alt="...">
                </div>
              <?php endwhile ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
        </div>

        <div class="col">
          <h1>
            <?= $produto['nmProduto'] ?>
          </h1>
          <p>R$
            <?= $produto['preco'] ?>
          </p>

          <a href="../php/AddCarrinho.php?id=<?= $produto['id_produto'] ?>" class="btn btn-success">Adicionar a
            sacola</a>

          <h3>Descrição
            <p id="subs">
              <?= $produto['descricao'] ?>
            </p>
          </h3>
          <!-- Aqui precisamos cadastrar as avaliacoes-->


        </div>
      </div>
    </div>
    <?php session_abort() ?>

    <!-- Footer -->
    <footer class="d-flex flex-wrap justify-content-between align-items-center" id="footer">
      <div class="col-md-2 d-flex align-items-center">
        <a href="HomeAdmin.php" class="mb-3 me-2 mb-md-0 text-body-secondary text-decoration-none lh-1">
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
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
    crossorigin="anonymous"></script>
</body>

</html>