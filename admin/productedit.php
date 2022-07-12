<?php
include '../classes/product.php';
$prod = new Product();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $update_prod = $prod->update_product($_POST,$_FILES);
}

if (isset($update_prod)) {
    header('Location:products.php');
}

?>
