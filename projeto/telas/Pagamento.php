<?php
include("../php/Conexao.php");
session_start();
$idCliente = $_SESSION['idCliente'];
$nome = "";
$hiddenUser = "visually-hidden";
if (isset($_SESSION['Logado'])) {
    $logado = $_SESSION['Logado'];
    $nome = $_SESSION['nmCliente'];
    $hidden = "visually-hidden";
    $hiddenUser = "";
}
$total = $_GET['val'];
$enderecoEntrega = 0;
if (isset($_SESSION['enderecoEntrega'])) {
    $enderecoEntrega = $_SESSION['enderecoEntrega'];
}
//$sql_query = $mysqli->query($sql_code) or die($mysqli->error);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagamento</title>
    <link rel="stylesheet" href="../css/Carrinho.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/afdd67c71b.js" crossorigin="anonymous"></script>
</head>

<body>

    <!-- Header -->
    <div class="container-fluid col-md-12 col-sm-12" id="headerHome">
        <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between ">

            <div class="col-3 col-md-3 col-sm-6 justify-content-center">
                <a href="Home.php" target="_blank" class="logo">
                    <img id="logo" src="../imagens/Logo.png" class="imagem">
                </a>
            </div>

            <!-- Login e botão -->
            <div class="col-md-3 text-center d-inline-flex justify-content-center align-items-center">

                <!-- botão quando logado-->
                <div class="<?php echo $hiddenUser ?> col-sm-6">
                    <a href="Home.php" id="btnUser">
                        <i class="fa-solid fa-chevron-left fa-md" style="color: #fff;">voltar</i>
                    </a>
                </div>

            </div>
        </header>
    </div>
    <!--Fim do Header-->


    <div class="container ">

        <div class="row border-bottom mx-5 mb-5 py-3">

            <!-- Forma de pagamento-->

            <div class="input-group mb-3 border-end col-md-6">
                <h3 class="mx-5">
                    <?php echo "Valor a Pagar: R$$total"; ?>
                </h3>
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01">Opções de pagamento </label>
                </div>
                <select class="custom-select" id="inputGroupSelect01">
                    <option selected>Escolher...</option>
                    <option value="1">Pix</option>
                    <option value="2">Boleto</option>
                    <option value="3">Cartão de crédito</option>
                </select>
            </div>
            <div id="cartaoCreditoInput" style="display: none;">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Número do cartão">
                </div>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Validade do cartão">
                </div>
            </div>

            <?php
            $sql_code = "select * from Cliente C 
                                                inner join Endereco_Entrega Ea on C.id_cliente = Ea.id_Cliente 
                                                inner join Endereco E on Ea.id_endereco = E.id_endereco where C.id_cliente = $idCliente;";
            $sql_query = $mysqli->query($sql_code) or die($mysqli->error);
            $rows = $sql_query->num_rows;
            ?>

            <!-- endereços-->
            <div class="col-md-12">
                <br />

                <div class="row" id="Enderecos">
                    <?php if ($rows > 0): ?>
                        <?php while ($c = $sql_query->fetch_assoc()): ?>
                            <div class="col-sm-6">

                                <div class="card text-center">
                                    <?php if ($enderecoEntrega != 0) { ?>
                                        <?php if($_SESSION['enderecoEntrega'] == $c['id_endereco']) { ?>
                                            <div class="card-header" style="backGround-color:#006400; color:#fff">
                                                Endereço de entrega
                                            </div>
                                        <?php } else {?>
                                            <div class="card-header">
                                                <a href="../php/SelecionarEndereco.php?id=<?= $c['id_endereco'] ?>&va=<?= $total ?>">
                                                    Trocar para este endereço
                                                </a>
                                            </div>
                                        <?php } ?>
                                    <?php } else { ?>
                                        <div class="card-header">
                                            <a href="../php/SelecionarEndereco.php?id=<?= $c['id_endereco'] ?>&va=<?= $total ?>">
                                                Trocar para este endereço
                                            </a>
                                        </div>
                                    <?php } ?>
                                    <div class="card-body">
                                        <h5 class="card-title">CEP:
                                            <?= $c['cep'] ?>
                                        </h5>
                                        <p class="card-text">
                                            Rua:
                                            <?= $c['rua'] ?>
                                        </p>
                                        <p class="card-text">
                                            Nº
                                            <?= $c['numero'] ?>
                                        </p>
                                        <a href="Enderecos.php?id=<?= $c['id_endereco'] ?>" class="btn btn-primary">Editar
                                            Endereço</a>
                                    </div>

                                </div>
                            </div>
                        <?php endwhile ?>
                    <?php endif ?>
                </div>
                <div class="text-center">
                <a href="Enderecos.php" class="btn btn-primary" id="btnEnderecos">Cadastrar Novo Endereço</a>
            </div>
            </div>

        </div>

        <?php $_SESSION['Endereco_Entrega'] = $enderecoEntrega ?>
        <?php $_SESSION['valor'] = $total ?>
        <form action="../php/Pedido.php" class="text-center" method="POST">
            <a href="../php/Pedido.php" type="submit" class="btn btn-success">Confirmar Compra</a>
        </form>
        
    </div>
    <!-- fim checkout -->

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
    <!-- Fim do Footer -->

    <script>
        document.getElementById("inputGroupSelect01").addEventListener("change", function () {
            var option = this.value;
            var cartaoCreditoInput = document.getElementById("cartaoCreditoInput");

            if (option === "3") {
                cartaoCreditoInput.style.display = "block";
            } else {
                cartaoCreditoInput.style.display = "none";
            }
        });
    </script>

</body>

</html>