<?php
include("../php/Conexao.php");
session_start();
$senhas = "visually-hidden";
$cpf = "visually-hidden";
$email = "visually-hidden";
if(isset($_SESSION['senha_nao_confere'])){
    if($_SESSION['senha_nao_confere']){
        $senhas = "";
        $_SESSION['senha_nao_confere'] = false;
    }
}

if(isset($_SESSION['cpf_invalido'])){
    if($_SESSION['cpf_invalido']){
        $cpf = "";
        $_SESSION['cpf_invalido'] = false;
    }
}

if(isset($_SESSION['usuario_existe'])){
    if($_SESSION['usuario_existe']){
        $email = "";
        $_SESSION['usuario_existe'] = false;
    }
}


?>

<!DOCTYPE html>
<html lang="pt">

<!-- Inicio do cabeçalho -->

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastro</title>
  <link rel="stylesheet" href="../css/Home.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <script src="../JS/index.js"></script>


</head>


<body>

  <!-- Inicio do header -->
  <div class="container">
    <header class="d-flex flex-wrap align-items-center justify-content-center py-3 mb-5 border-bottom">
      <div class="col-md-3 mb-2 mb-md-0">
        <a href="Home.php" target="_blank" class="logo"><img id="logo" src="../imagens/Logo.png" class="imagem"></a>
        </a>
      </div>
    </header>
  </div>
  <!-- Fim do header -->

  <!--Inicio do Form de Cadastro de Cliente-->
  <div class="alert alert-danger <?php echo $senhas ?>" role="alert">
    Senhas não batem
  </div>
  <div class="alert alert-danger <?php echo $cpf ?>" role="alert">
    Cpf não é valido
  </div>
  <div class="alert alert-danger <?php echo $email ?>" role="alert">
    email já é cadastrado
  </div>
  <form id="FormCadastroCliente" method="post" action="../php/CadastrarCliente.php" enctype="multipart/form-data"
    class="row g-3 justify-content-evenly needs-validation" novalidate>
    <div class="row justify-content-evenly mb-5">
      <div class="col-4 col-md-5 border border-3 border-black rounded-4" id="InfoPessoaisCliente">
        <div class="row justify-content-evenly">

          <h3 class="text-center mb-4">Informações Pessoais</h3>

          <div class="col-md-6 mb-2">
            <!-- Campo nome -->
            <label for="nome" class="form-label">Nome Completo</label>
            <input type="text" class="form-control " id="nmCliente" name="nmCliente" value="" required />
          </div>

          <div class="col-md-6">
            <!-- Campo CPF -->
            <label for="Cpf" class="form-label">CPF</label>
            <input type="text" class="form-control" id="Cpf" name="Cpf" required />

          </div>

          <div class="col-md-6 mb-2">
            <!-- Campo E-mail -->
            <label for="Email" class="form-label">E-mail</label>
            <input type="email" class="form-control" id="Email" name="Email" placeholder="exemplo@email.com" required />

          </div>

          <div class="col-md-6">
            <!-- Campo data -->
            <label for="nome" class="form-label">Data de nascimento</label>
            <input type="date" class="form-control" id="data" name="data" required />
  
          </div>

          <div class="col-md-6 mb-2">
            <!-- Campo Senha -->
            <label for="Senha" class="form-label">Senha</label>
            <input type="password" class="form-control" id="Senha" name="Senha" required />
          </div>

          <div class="col-md-6">
            <!-- Campo Senha -->
            <label for="Senha" class="form-label">Confirmar Senha</label>
            <input type="password" class="form-control" id="Senha" name="ConfirmarSenha" required />

          </div>

          <div class="col-md-4">
            <!--Campo Genero-->
            <label for="nome" class="form-label">Genero</label>
            <select name="genero" class="form-select" required>
              <option value="" disabled selected>Genero</option>
              <option value="Masculino" name="genero">Masculino</option>
              <option value="Feminino" name="genero">Feminino</option>
              <option value="Outro" name="genero">Outro</option>
            </select>
          </div>
        </div>
      </div>

      <Br />

      <div class="col-6 border border-3 border-black rounded-4" id="InfoPessoaisCliente">
        <h3 class="text-center mb-4">Endereço de Faturamento</h3>
        <div class="row justify-content-evenly">

          <div class="col-md-6">
            <!--Campo CEP-->
            <label for="Cep" class="form-label">CEP</label>
            <input type="number" class="form-control" id="Cep" name="Cep" onChange="loadDoc(0)" required />
          </div>

          <div class="col-md-6">
            <!--Campo Rua-->
            <label class="form-label">Rua</label>
            <input type="text" class="form-control" id="Rua" name="Rua" readonly />
          </div>

          <div class="col-md-8">
            <!--Bairro-->
            <label class="form-label">Bairro</label>
            <input type="text" class="form-control" id="Bairro" name="Bairro" readonly />
          </div>

          <div class="col-md-4">
            <!--Campo Complemento-->
            <label class="form-label">Complemento</label>
            <input type="text" class="form-control" id="Complemento" name="Complemento" />
          </div>

          <div class="col-md-8">
            <!--Campo Cidade-->
            <label class="form-label">Cidade</label>
            <input type="text" class="form-control" id="Cidade" name="Cidade" readonly />
          </div>

          <div class="col-md-4">
            <!--Campo Logradouro-->
            <label class="form-label">Logradouro</label>
            <input type="text" class="form-control" id="Logradouro" name="Logradouro" readonly />
          </div>

          <div class="col-md-4">
            <!-- Campo estado-->
            <label class="form-label">UF</label>
            <input type="text" class="form-control" id="Uf" name="Uf" readonly />
          </div>

          <div class="col-md-4">
            <!--Campo Número-->
            <label class="form-label">Numero</label>
            <input type="text" class="form-control" id="Numero" name="Numero" required />
          </div>


          <!--Confirmar Endereço-->
          <div class="form-check mt-5">
            <input class="form-check-input" name="chk" type="checkbox" id="flexCheck" onChange="toggleEntrega()">
            <label class="form-check" for="flexCheckChecked">
              Usar Endereço de Faturamento como meu Endereço de entrega
            </label>
          </div>

          <br />
        </div>
      </div>
    </div>

    <!-- endereco de entrega -->
    <div class="col-10 border border-3 border-black rounded-4" id="entrega">
      <div class="row justify-content-evenly" id="InfoPessoaisCliente">
        <h3 class="text-center mb-4">Endereço de Entrega</h3>

        <div class="col-md-6">
          <!--Campo CEP-->
          <label for="Cep" class="form-label">CEP</label>
          <input type="number" class="form-control" id="Cep" name="Cep" onChange="loadDoc(0)" required />
        </div>

        <div class="col-md-6">
          <!--Campo Rua-->
          <label class="form-label">Rua</label>
          <input type="text" class="form-control" id="Rua" name="Rua" readonly />
        </div>

        <div class="col-md-8">
          <!--Bairro-->
          <label class="form-label">Bairro</label>
          <input type="text" class="form-control" id="Bairro" name="Bairro" readonly />
        </div>

        <div class="col-md-4">
          <!--Campo Complemento-->
          <label class="form-label">Complemento</label>
          <input type="text" class="form-control" id="Complemento" name="Complemento" />
        </div>

        <div class="col-md-8">
          <!--Campo Cidade-->
          <label class="form-label">Cidade</label>
          <input type="text" class="form-control" id="Cidade" name="Cidade" readonly />
        </div>

        <div class="col-md-4">
          <!--Campo Logradouro-->
          <label class="form-label">Logradouro</label>
          <input type="text" class="form-control" id="Logradouro" name="Logradouro" readonly />
        </div>

        <div class="col-md-4">
          <!-- Campo estado-->
          <label class="form-label">UF</label>
          <input type="text" class="form-control" id="Uf" name="Uf" readonly />
        </div>

        <div class="col-md-4">
          <!--Campo Número-->
          <label class="form-label">Numero</label>
          <input type="text" class="form-control" id="Numero" name="Numero" required />
        </div>

      </div>
    </div>
    <!--Botão Cadastrar-->
    <div class=" justify-content-center align-content-center" id="btnCadastrarCliente">
      <button class="btn btn-primary" id="btnCliente" type="submit" action="CadastrarCliente.php">
        Me Cadastrar
      </button>
    </div>

  </form>

  <!--Fim do Form-->


  <!-- Footer -->
  <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
    <div class="col-md-4 d-flex align-items-center">
      <a href="/" class="mb-3 me-2 mb-md-0 text-body-secondary text-decoration-none lh-1">
        <img id="logo" src="../imagens/Logo.png" class="imagem">
      </a>
      <span class="mb-3 mb-md-0 text-body-secondary">© 2023 Company, Inc</span>
    </div>

    <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
      <li class="ms-3"><a class="text-body-secondary" href="#">Natan</a></li>
      <li class="ms-3"><a class="text-body-secondary" href="#">Bruno</a></li>
      <li class="ms-3"><a class="text-body-secondary" href="#">Iago</a></li>
    </ul>
    <!--Fim do Footer-->
  </footer>


  <script>
    function toggleEntrega() {
      var checkbox = document.getElementById('flexCheck');
      var entregaDiv = document.getElementById('entrega');

      if (checkbox.checked) {
        entregaDiv.style.display = 'none';
      } else {
        entregaDiv.style.display = 'block';
      }
    }
  </script>
  <!--Fim da Função JS-->
  <script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    /*
    (function () {
      'use strict'

      // Fetch all the forms we want to apply custom Bootstrap validation styles to
      var forms = document.querySelectorAll('.needs-validation')

      // Loop over them and prevent submission
      Array.prototype.slice.call(forms)
        .forEach(function (form) {
          form.addEventListener('submit', function (event) {
            if (!form.checkValidity()) {
              event.preventDefault()
              event.stopPropagation()
            }

            form.classList.add('was-validated')
          }, false)
        })
    })()
    */
  </script>
</body>

</html>