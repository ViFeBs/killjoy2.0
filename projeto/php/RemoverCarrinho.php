<?php
session_start();

if (isset($_GET['index'])) {
    $index = $_GET['index'];
  
    if (isset($_SESSION['cart'][$index])) {
        // Remover o item do carrinho com base no índice
        unset($_SESSION['cart'][$index]);

        // Reorganizar os índices do array
        $_SESSION['cart'] = array_values($_SESSION['cart']);
    }
}

// Redirecionar de volta à página do carrinho
header("Location: ../telas/Carrinho.php");
exit();
?>