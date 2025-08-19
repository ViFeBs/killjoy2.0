<?php
include("../php/Conexao.php");
$sql_code = "SELECT * FROM Produto";
$sql_query = $mysqli->query($sql_code) or die($mysqli->error);
?>
<!DOCTYPE html>
<html lang="pt">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Cliente</title>
  <link rel="stylesheet" href="../css/Home.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>


<body id="home">

  <header class="py-3 mb-4 border-bottom justify-content-center" style="background-color: black;">
    <a href="Home.php" target="_blank" class="logo">
      <img id="logoLogin" src="../imagens/Logo.png" class="imagem">
    </a>
  </header>

  <div class="container">
  <h1 class="text-center mt-5">Login</h1>

  <div class="row justify-content-center">
    <div class="col-md-6">
      <form id="loginForm" method="post" action="../php/LoginClientes.php">
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="text" class="form-control" id="email" name="email"  />
        </div>

        <div class="mb-3">
          <label for="senha" class="form-label">Senha</label>
          <input type="password" class="form-control" id="senha" name="senha" />
        </div>

        <div class="d-grid gap-2">
          <button class="btn btn-primary" type="submit" id="btnLogar">Logar</button>
          <a class="btn btn-success mt-2" href="CadastroCliente.php" id="btnCadastro">Me Cadastrar</a>
        </div>
      </form>
    </div>
  </div>
</div>

<footer class="d-flex flex-wrap align-items-center" id="footer">
  <div class="container">
    <div class="row">
      <div class="col-md-2">
        <a class="mb-3 me-2 mb-md-0 text-body-secondary text-decoration-none lh-1">
          <img id="logo" src="../imagens/Logo.png" class="imagem">
        </a>
      </div>
      <div class="col-md-7 mt-5 text-center text-white">
        <span>© 2023 Company, Inc</span>
      </div>
      <div class="col-md-3 text-end">
        <ul class="nav mt-5 justify-content-end">
          <li class="nav-item"><a class="nav-link text-white" href="#">Natan</a></li>
          <li class="nav-item"><a class="nav-link text-white" href="#">Bruno</a></li>
          <li class="nav-item"><a class="nav-link text-white" href="#">Iago</a></li>
        </ul>
      </div>
    </div>
  </div>
</footer>


</body>

</html>