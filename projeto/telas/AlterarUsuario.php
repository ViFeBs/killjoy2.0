<?php
  include("../php/Conexao.php");
  session_start();
  $idUsuario = $_GET['id'];
  $sql_code = "SELECT * FROM Usuario WHERE id_usuario = $idUsuario";
  $sql_query = $mysqli->query($sql_code) or die($mysqli->error);
?>
<html lang="en">
  <!--Header-->
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
      function mostrarSenha() {
            var x = document.getElementById("senhaPwd");
            if (x.type === "password") {
              x.type = "text";
            } else {
              x.type = "password";
            }
          }
          document.getElementById("mostrarSenhaCheckbox").addEventListener("click", mostrarSenha);
    </script>
    <link rel="stylesheet" href="../css/Cadastro.css" />
    <title>Cadastro</title>
  </head>
  <!--Fim do Header-->
  <body>
    <!--Navbar-->
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
    <!--Fim da Navbar-->
    
    <!--Formulário de alteração de usuário-->
    <?php while ($usuario = $sql_query->fetch_assoc()): ?>
        <form method="POST" action="../php/AlterarUsuario.php">
            <div class="container">
                <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <h1 class="text-center mb-3">Edição</h1>

                    <!-- Campo Nome -->
                    <label for="nome">Nome</label>
                    <div class="form-floating mb-3">
                    <input
                        type="text"
                        class="form-control"
                        id="nome"
                        name="nome"
                        placeholder="Fulano da silva"
                        value="<?= $usuario['nmUsuario'] ?>"
                    />
                    </div>

                    <!-- Campo CPF -->
                    <label for="Cpf">CPF</label>
                    <div class="form-floating mb-3">
                    <input
                        type="text"
                        class="form-control"
                        id="Cpf"
                        name="Cpf"
                        placeholder="000.000.000-00"
                        pattern="[0-9]{10,11}"
                        required
                        value="<?= $usuario['cpf'] ?>"
                    />
                    </div>

                    <!-- Campo E-mail -->
                    <label for="Email">E-mail</label>
                    <div class="form-floating mb-3">
                    <input
                        type="email"
                        class="form-control"
                        id="Email"
                        name="Email"
                        placeholder="exemplo@email.com"
                        value="<?= $usuario['email'] ?>"
                    />
                    </div>

                    <!-- Campo Senha -->
                    <label for="Senha">Senha</label>
                    <div class="form-floating mb-3">
                    <input
                        type="password"
                        class="form-control"
                        id="Senha"
                        name="Senha"
                        placeholder="********"
                    />
                    </div>
                    <!-- Campo Senha -->
                    <label for="Senha">Confirmar Senha</label>
                    <div class="form-floating mb-3">
                    <input
                        type="password"
                        class="form-control"
                        id="Senha"
                        name="ConfirmarSenha"
                        placeholder="********"
                    />
                    </div>
                    <!--Campo Permissao-->
                    <div class="input-field col s12">
                    <select name="cargo">
                        <option value="" disabled selected>Escolha sua área</option>
                        <option value="Admin" name="cargo">Admin</option>
                        <option value="Estoquista" name="cargo">Estoquista</option>
                    </select>
                    </div>
                    <!-- Botão de Cadastro -->
                    <div class="d-grid">
                        <button class="btn btn-primary" type="submit" action="AlterarUsuario.php">Editar</button>
                    </div>
                    <br />
                    <!-- Botão de Inativação -->
                    <div class="d-grid">
                        <?php if ($usuario['statusUsuario']) {
                            echo "<a class='btn btn-danger' href='../php/AlterarStatus.php?id=$idUsuario&acao=Inativar'>Inativar</a>";
                        } else {
                            echo "<a class='btn btn-danger' href='../php/AlterarStatus.php?id=$idUsuario&acao=Ativar'>Reativar</a>";
                        }?>
                    </div>
                </div>
                </div>
            </div>
        </form>
    <?php endwhile; 
            $_SESSION['idUsuario'] = $idUsuario; 
        ?>  
  </body>
</html>
