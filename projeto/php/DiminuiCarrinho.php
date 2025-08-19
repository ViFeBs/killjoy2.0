<?php
session_start();
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

$prod_id = $_GET['id'];
$max = sizeof($_SESSION['cart']);

for ($i = 0; $i < $max; $i++) {
    if ($prod_id == $_SESSION['cart'][$i]["product"]) {
        $_SESSION['cart'][$i]["quantity"] -= 1;
        
        if ($_SESSION['cart'][$i]["quantity"] == 0) {
            // Remover o item do carrinho
            unset($_SESSION['cart'][$i]);
            
            // Reorganizar os índices do array
            $_SESSION['cart'] = array_values($_SESSION['cart']);
        }
        
        header('Location: ../telas/Carrinho.php');
        exit();
    }
}
?>
