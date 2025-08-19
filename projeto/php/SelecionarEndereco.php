<?php
    session_start();
    $prod_id = $_GET['id'];
    $val = $_GET['va'];
    $_SESSION['enderecoEntrega'] = $prod_id;
    header("Location: ../telas/Pagamento.php?val=$val");
?>