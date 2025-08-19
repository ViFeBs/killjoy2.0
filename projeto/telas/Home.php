<!--Funções php-->
<?php
include("../php/Conexao.php");
session_start();
$hidden = "";
$hiddenUser = "visually-hidden";
$nome = "";
if (isset($_SESSION['Logado'])) {
  $logado = $_SESSION['Logado'];
  $nome = $_SESSION['nmCliente'];
  $hidden = "visually-hidden";
  $hiddenUser = "";
}
$sql_code = "SELECT * FROM Produto";
$sql_query = $mysqli->query($sql_code) or die($mysqli->error);
?>
<!DOCTYPE html>
<html lang="pt">

<!--Header-->

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>
  <link rel="stylesheet" href="../css/Home.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/afdd67c71b.js" crossorigin="anonymous"></script>
</head>
<!--Fim do Header-->

<body>
  <!-- Home -->
  <div id="home">

    <!-- Header da navbar-->
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
      <!--Fim do Header da Navbar-->
    </div>

    <!-- Barra de Pesquisa -->
    <form class="col-12 " id="pesquisaForm" role="Pesquisar" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      <input type="text" class="form-control" placeholder="Pesquisar..." aria-label="Recipient's username"
        aria-describedby="button-addon2" id="PesquisaInput"
        value="<?php echo isset($_GET['filtro']) ? $_GET['filtro'] : ''; ?>">
      <button class="btn btn-outline-secondary" type="submit" id="PesquisaButton">
        <i class="fa-solid fa-magnifying-glass"></i>
      </button>
    </form>

    <!-- cards dos produtos -->
    <div class="container">

      <div class="row row-cols-2 row-cols-sm-2 row-cols-md-4 g-4 justify-content-center" id="cardItem">
        <?php if ($sql_query->num_rows > 0): ?>
          <?php while ($produto = $sql_query->fetch_assoc()): ?>
            <div class="col" style="backgroundColor: #000000">
              <div class="card">
                <!--Botão de comprar dentro da imagem do produto-->
                <a href="../php/AddCarrinho.php?id=<?= $produto['id_produto'] ?>">
                  <i class="fa-sharp fa-solid fa-money-bill-wave fa-xl" id="btnComprar"></i>
                </a>

                <img src="<?= $produto['ftCapa'] ?>" class="card-img-top" alt="Camisa smile">

                <!--Informações do produto-->
                <div class="card-body">
                  <h3 class="card-title">
                    <?= $produto['nmProduto'] ?>
                  </h3>

                  <!--Preço do Produto-->
                  <p class="card-text">R$
                    <?= $produto['preco'] ?>
                  </p>

                  <!--Botão ver mais-->
                  <a href="InfoProduto.php?id=<?= $produto['id_produto'] ?>" class="btn btn-primary" id="btnVerMais">Ver
                    Mais
                  </a>
                </div>
              </div>
            </div>
          <?php endwhile ?>
        <?php endif ?>
      </div>
    </div>


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
</body>

</html>