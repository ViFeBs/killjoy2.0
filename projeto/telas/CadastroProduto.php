<!DOCTYPE html>
<html>
<!-- Inicio do cabeçalho -->

<head>
  <title>Cadastro de Produtos</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/Cadastro.css" />
  
  </head>
<!-- Fim do cabeçalho -->

<body>
  <!-- Inicio do menu -->
  <nav class="navbar navbar-expand-lg bg-body-tertiary" style="background-color: #e3f2fd;">
    <div class="container-fluid">
      <a class="navbar-brand" href="HomeAdmin.php">Dashboard</a>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
          <a class="nav-link" href="CadastroProduto.php">Cadastrar Produtos</a>
          <a class="nav-link" href="ListarProduto.php">Listar Produtos</a>
          <a class="nav-link" href="Cadastro.html">Cadastrar Usuarios</a>
          <a class="nav-link" href="ListarUsuario.php">Lista de Usuarios</a>
        </div>
      </div>
    </div>
  </nav>
  <!-- Fim do menu -->

  <!-- Inicio do Form de Cadastro de Produto -->
  <div class="container my-5">
    <form method="post" action="../php/CadastroProduto.php" enctype="multipart/form-data">
      <!-- enctype="multipart/form-data" é necessário para o upload de arquivos -->
      
      <h1 class="text-center my-3">Cadastro de Produtos</h1>
      <!--Campo nome do Produto-->
      <label for="nome">Nome do Produto</label>
      <div class="form mb-3">
        <input type="text" class="form-control" id="nmProduto" name="nmProduto" placeholder="" />
      </div>

      <!--Campo Descrição do Produto-->
      <label for="nome">Descrição do Produto</label>
      <div class="form mb-3">
        <input type="text" class="form-control" id="descricao" name="descricao" placeholder="" />
      </div>

      <!--Campo Preço do Produto-->
      <label for="nome">Preço</label>
      <div class="form mb-3">
        <input type="number" class="form-control" id="preco" name="preco" placeholder="" step="0.01" required />
      </div>

      <!--Campo Quantidade do Produto-->
      <label for="nome">Quantidade</label>
      <div class="form mb-3">
        <input type="text" class="form-control" id="quantidade" name="quantidade" placeholder="" />
      </div>

      <!--Campo Foto do Produto-->
      
      <div class="file-field input-field">
        <div>
          <span>Foto de Capa</span>
          <input name="imagens[]" type="file" multiple="multiple">
        </div>
      </div>

      <!--Botão de Cadastro de Produto-->
      <div class="d-grid">
        <button class="btn btn-primary mx-5 my-5" type="submit" action="CadastroProduto.php" >Cadastrar</button>
      </div>

    </form>
  </div>
</body>

</html>