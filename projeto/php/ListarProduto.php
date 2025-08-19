<?php
session_start();
include("conexao.php");

if(isset($_POST['filtrar'])) {
    $nome = mysqli_real_escape_string($mysqli, $_POST['nome']);
    $sql = "SELECT * FROM Produto WHERE nmProduto LIKE '%$nome%' ORDER BY nmUsuario ASC";
} else {
    $sql = "SELECT * FROM Produto ORDER BY nmProduto ASC";
}

$resultado = $mysqli->query($sql);
$idProduto = 0;
if ($resultado->num_rows > 0) {
    while ($linha = $resultado->fetch_assoc()) {
      
        $ftCapa = $linha['ftCapa'];
        $id = $linha['id_produto'];
        $nome = $linha['nmProduto'];
        $descricao = $linha['descricao'];
        $preco = $linha['preco'];
        $quantidade = $linha['quantidade'];

        echo "<tr>";
        echo "<td><img src='../php/$ftCapa' height=50px weight=50px/></td>";
        echo "<td>$nome</td>";
        echo "<td>$descricao</td>";
        echo "<td>$preco</td>";
        echo "<td>$quantidade</td>";
        echo "<td><a href='../telas/AlterarProduto.php?id=$id' > <i class='fa-regular fa-pen-to-square fa-xl' style='color: #000000;'></i> </a></td>";
        echo "<td><a href='../telas/InfoProduto.php?id=$id' > <i class='fa-regular fa-eye fa-xl' style='color: #000000;'></i> </a></td>";
        echo "</tr>";
        $idProduto = $id; 
    }
} else {
    echo "<tr><td colspan='5'>Nenhum Produto registrado.</td></tr>";
}


?>
