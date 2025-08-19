<?php
$logado = false; // Definir uma variável $logado inicializada como false
if (!$logado && !empty($_SESSION['cart'])) {
    setcookie('cart', json_encode($_SESSION['cart']), time() + (86400 * 30), "/"); // Salvar o carrinho por 30 dias
}
session_start();
include("../php/Conexao.php");
$idCliente = isset($_SESSION['idCliente']) ? $_SESSION['idCliente'] : "";
$nome = "";
$hiddenUser = "visually-hidden";
$valor = 0;
if (!$logado && empty($_SESSION['cart']) && isset($_COOKIE['cart'])) {
    $_SESSION['cart'] = json_decode($_COOKIE['cart'], true);
}
if (isset($_SESSION['Logado'])) {
    $logado = $_SESSION['Logado'];
    $nome = $_SESSION['nmCliente'];
    $hidden = "visually-hidden";
    $hiddenUser = "";
}
//$sql_query = $mysqli->query($sql_code) or die($mysqli->error);

// Verificar se o carrinho está vazio
if (empty($_SESSION['cart'])) {
    $carrinhoVazio = true;
} else {
    $carrinhoVazio = false;
}
$frete = 0;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sacola</title>
    <link rel="stylesheet" href="../css/Carrinho.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/afdd67c71b.js" crossorigin="anonymous"></script>
</head>


<body>

    <!-- Header -->
    <div class="container-fluid col-md-12" id="headerHome">
        <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between ">

            <div class="col-3 col-md-3 justify-content-center">
                <a href="Home.php" target="_blank" class="logo">
                    <img id="logo" src="../imagens/Logo.png" class="imagem">
                </a>
            </div>

            <!-- Login e botão -->
            <div class="col-md-3 text-center d-inline-flex justify-content-center align-items-center">

                <!-- botão quando logado-->
                <div class="<?php echo $hiddenUser ?>">
                    <a href="Home.php" id="btnUser">
                        <i class="fa-solid fa-chevron-left fa-md" style="color: #fff;"> voltar</i>
                    </a>
                </div>

            </div>
        </header>
    </div>
    <!--Fim do Header-->


    <div class="row justify-content-evenly align-items-baseline" id="row">
        <div class="col-md-6">

            <div class="col-md-6 col-sm-6 px-5 py-5 mt-3">

                <?php if ($carrinhoVazio): ?>
                    <p class="text-center">Não há itens no carrinho.</p>
                <?php else: ?>
                    <table class="table table-hover">
                        <thead class="table-dark ">
                            <tr>
                                <th>Produto</th>
                                <th>Nome</th>
                                <th>Preço</th>
                                <th></th>
                                <th>Quantidade</th>
                                <th></th>
                                <th>Remover</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $valor = 0.0;
                            $max = sizeof($_SESSION['cart']);
                            for ($i = 0; $i < $max; $i++): ?>
                                <?php
                                $id_prod = $_SESSION['cart'][$i]['product'];
                                $qtd = $_SESSION['cart'][$i]['quantity'];
                                $sql_code = "SELECT * FROM Produto where id_produto = $id_prod ";
                                $sql_query = $mysqli->query($sql_code) or die($mysqli->error);
                                ?>
                                <?php if ($sql_query->num_rows > 0): ?>
                                    <?php while ($produto = $sql_query->fetch_assoc()) {
                                        $img = $produto['ftCapa'];
                                        $nome = $produto['nmProduto'];
                                        $desc = $produto['descricao'];
                                        $preco = $produto['preco'];
                                        $valor += (float) $preco * (int) $qtd;
                                        echo "<tr>";
                                        echo "<td><img src='$img' height=50px weight=50px /></td>";
                                        echo "<td>$nome</td>";
                                        echo "<td>$preco</td>";
                                        echo "<td><a href='../php/AumentarCarrinho.php?id=$id_prod' class='link-body-emphasis link-offset-2 link-underline-opacity-25 link-underline-opacity-75-hover'><i class='fa-sharp fa-solid fa-plus'></i></a></td>";
                                        echo "<td>$qtd</td>";
                                        echo "<td><a href='../php/DiminuiCarrinho.php?id=$id_prod'class='link-body-emphasis link-offset-2 link-underline-opacity-25 link-underline-opacity-75-hover'><i class='fa-sharp fa-solid fa-minus'></i></a></td>";
                                        echo "<td><a href='../php/RemoverCarrinho.php?index=$i' class='link-danger link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover'><i class='fa-solid fa-trash'></i></a></td>";
                                        echo "</tr>";
                                    } ?>
                                <?php endif ?>
                            <?php endfor ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
        </div>
        <!-- fim tabela-->


        <!-- Informacoes de frete, forma de pagamento, endereço-->
        <div class="col-md-6 col-sm-12 col-sm-2">
            <div class="InfoCart col-md-10 col-sm-2">
                <?php if (!$logado): ?>
                    <p>Você precisa estar logado para sua melhor experiencia. Faça o login abaixo:</p>
                    <a href="LoginCliente.php" class="btn btn-primary">Fazer Login</a>
                <?php else: ?>

                    <!-- fretes -->
                    <div class="border-bottom mb-3">
                        <h4>Frete</h4>
                        <div class="form-check " id="freteCarrinho">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" value="f1"
                                id="flexRadioDefault1" onClick=selectFrete()>
                            <label class="form-check-label" for="flexRadioDefault1">
                                R$ 0,00 (25 dias úteis)

                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" value="f2"
                                id="flexRadioDefault2" onClick=selectFrete()>
                            <label class="form-check-label" for="flexRadioDefault2">
                                R$ 9,90 (15 dias úteis)

                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" value="f3"
                                id="flexRadioDefault3" onClick=selectFrete()>
                            <label class="form-check-label" for="flexRadioDefault3">
                                R$ 19,90 (5 dias úteis)

                            </label>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="Total" id="TotalCheck">
                    <h4>
                        Sacola: R$<p id="valorFrete">
                            <?php echo $valor ?>
                        </p>
                    </h4>
                    <h4 id="frete">
                        Frete: R$0.00
                    </h4>
                    <h3 class="border-top mt-4">
                        Total: R$<p id="total">
                            <?php echo $valor ?>
                        </p>
                    </h3>
                </div>

                <!-- botao pagar -->
                <a href="#" id="btnPagar" onClick="sendTotal();" class="btn btn-success " role="button">Pagar</a>

            </div>
        </div>
    </div>
    <!-- Fim do carrinho -->

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
        function selectFrete() {
            if (document.getElementById("flexRadioDefault1").checked) {
                document.getElementById("frete").innerHTML = "Frete: R$0.00"
                var valor = parseFloat(document.getElementById("valorFrete").innerHTML)
                document.getElementById("total").innerHTML = (valor + 0.00).toFixed(2);
            }
            if (document.getElementById("flexRadioDefault2").checked) {
                document.getElementById("frete").innerHTML = "Frete: R$9.90"
                var valor = parseFloat(document.getElementById("valorFrete").innerHTML)
                document.getElementById("total").innerHTML = (valor + 9.90).toFixed(2);
            }
            if (document.getElementById("flexRadioDefault3").checked) {
                document.getElementById("frete").innerHTML = "Frete: R$19.90"
                var valor = parseFloat(document.getElementById("valorFrete").innerHTML)
                document.getElementById("total").innerHTML = (valor + 19.90).toFixed(2);
            }
        }
    </script>

    <script>
        function sendTotal() {
            var total = parseFloat(document.getElementById("total").innerHTML)
            console.log(total)
            document.getElementById("btnPagar").href = "Pagamento.php?val=" + total;
            return false;
        }
    </script>
</body>

</html>