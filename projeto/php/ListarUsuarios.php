<?php
session_start();
include("conexao.php");

if(isset($_POST['filtrar'])) {
    $nome = mysqli_real_escape_string($mysqli, $_POST['nome']);
    $sql = "SELECT * FROM Usuario WHERE nmUsuario LIKE '%$nome%' ORDER BY nmUsuario ASC";
} else {
    $sql = "SELECT * FROM Usuario ORDER BY nmUsuario ASC";
}

$resultado = $mysqli->query($sql);

if ($resultado->num_rows > 0) {
    while ($linha = $resultado->fetch_assoc()) {
        $id = $linha['id_usuario'];
        $nome = $linha['nmUsuario'];
        $email = $linha['email'];
        $status = $linha['statusUsuario'];
        $grupo = $linha['permissao'];

        echo "<tr>";
        echo "<td>$nome</td>";
        echo "<td>$email</td>";
        echo "<td>$grupo</td>";
        echo "<td><a href='../telas/AlterarUsuario.php?id=$id' > <i class='fa-regular fa-pen-to-square fa-xl' style='color: #000000;'></i> </a></td>";
        if ($status) {
            echo "<td><a href='../php/AlterarStatus.php?id=$id&acao=Inativar'><i class='fa-solid fa-toggle-on fa-2xl' style='color: #6cb43c;'></i></a></td>";
        } else {
            echo "<td><a href='../php/AlterarStatus.php?id=$id&acao=Ativar'><i class='fa-solid fa-toggle-on fa-2xl fa-rotate-180' style='color: #ad1010;'></i></a></td>";
        }
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='5'>Nenhum usuário encontrado.</td></tr>";
}

$mysqli->close();
?>
