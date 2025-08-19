<?php
    include("../php/Conexao.php");
    session_start();
    $idCliente = $_SESSION['idCliente'];
    $hidden = "";
    $hiddenUser = "visually-hidden";
    $nome = "";
    if(isset($_SESSION['Logado'])){
        $logado = $_SESSION['Logado'];
        $nome = $_SESSION['nmCliente'];
        $hidden = "visually-hidden";
        $hiddenUser = "";
    }
    $isEdicao = false;

    if(isset($_GET['id'])){
        $isEdicao = true;
        $idEndereco = $_GET['id'];
    }
?>
<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar Cliente</title>
    <link rel="stylesheet" href="../css/Home.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/afdd67c71b.js" crossorigin="anonymous"></script>
    <script src="../JS/index.js"></script>
</head>

<body>

    <!-- Header -->
    <div class="container">
        <header
            class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
            <div class="col-md-3 mb-2 mb-md-0">
                <a href="Home.php" target="_blank" class="logo">
                    <img id="logo" src="../imagens/Logo.png" class="imagem">
                </a>
            </div>

            <h1><?php echo($nome) ?> </h1>

            <!-- Login e botão -->
            <div class="col-md-3 text-end">
                <a href="InfoCliente.php" style="color: #1D5C96;">Voltar</a>
                <a href="LoginCliente.php" style="color: #D4251A;">Sair</a>
            </div>
        </header>
    </div>

    <!-- form de alteração de cliente -->
   <div class="container" id="telaEndereco">
        <?php if(!$isEdicao): ?>
            <form action="../php/Endereco.php" method="post">
                <label for="Cep">CEP</label>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="Cep" name="Cep" placeholder="00000-000" onChange="loadDoc(0)"/>
                </div>
                <label id="demo"></label>
                <!--Campo Logradouro-->
                <label>Logradouro</label>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="Logradouro" name="Logradouro" readonly />
                </div>
                <!--Campo Complemento-->
                <label>Complemento</label>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="Complemento" name="Complemento" />
                </div>
                <!--Campo Rua-->
                <label>Rua</label>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="Rua" name="Rua" readonly />
                </div>
                <!--Bairro-->
                <label>Bairro</label>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="Bairro" name="Bairro" readonly />
                </div>
                <!--Campo Cidade-->
                <label>Cidade</label>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="Cidade" name="Cidade" readonly />
                </div>
                <!-- Campo estado-->
                <label>Uf</label>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="Uf" name="Uf" readonly />
                </div>
                <!--Campo Número-->
                <label>Numero</label>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="Numero" name="Numero" />
                </div>
                <div class="d-grid justify-content-center align-content-center" id="btnCadastrarCliente">
                    <button class="btn btn-primary" id="btnCliente" type="submit" action="Endereco.php">Cadastrar novo Endereço</button>
                </div>
            </form>
        <?php endif ?>
        <?php if($isEdicao): ?>
            <?php   
                    $sql_code = "select * from Endereco where id_endereco = $idEndereco";
                    $sql_query = $mysqli->query($sql_code) or die($mysqli->error);
                    $rows = $sql_query->num_rows;
            ?>
            <?php if ($rows > 0): ?>
                <?php while ($c = $sql_query->fetch_assoc()): ?>
                    <form method="post" action="../php/AlterarEndereco.php?id='<?= $idEndereco ?>'">
                        <label for="Cep">CEP</label>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="Cep" name="Cep" placeholder="00000-000" onChange="loadDoc(0)" value="<?= $c['cep'] ?>"/>
                        </div>
                        <label id="demo"></label>
                        <!--Campo Logradouro-->
                        <label>Logradouro</label>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="Logradouro" name="Logradouro" value="<?= $c['logradouro'] ?>" readonly />
                        </div>
                        <!--Campo Complemento-->
                        <label>Complemento</label>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="Complemento" name="Complemento" value="<?= $c['complemento'] ?>" />
                        </div>
                        <!--Campo Rua-->
                        <label>Rua</label>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="Rua" name="Rua" readonly value="<?= $c['rua'] ?>"/>
                        </div>
                        <!--Bairro-->
                        <label>Bairro</label>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="Bairro" name="Bairro" readonly value="<?= $c['bairro'] ?>"/>
                        </div>
                        <!--Campo Cidade-->
                        <label>Cidade</label>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="Cidade" name="Cidade" readonly value="<?= $c['cidade'] ?>"/>
                        </div>
                        <!-- Campo estado-->
                        <label>Uf</label>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="Uf" name="Uf" readonly value="<?= $c['uf'] ?>"/>
                        </div>
                        <!--Campo Número-->
                        <label>Numero</label>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="Numero" name="Numero" value="<?= $c['numero'] ?>"/>
                        </div>
                        <div class="d-grid justify-content-center align-content-center" id="btnCadastrarCliente">
                            <button class="btn btn-primary" id="btnCliente" type="submit" action="AlterarEndereco.php?id='<?= $idEndereco ?>'">Editar Endereço</button>
                        </div>
                    </form>
                <?php endwhile ?>
            <?php endif ?>
        <?php endif ?>
   </div>

    <!-- footer -->
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
    </footer>
</body>

</html>