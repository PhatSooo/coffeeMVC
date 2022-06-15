<?php
    include '../classes/product.php';

    $prod = new Product();
    // if(!isset($_GET('cateId')) || $_GET('cateId') == NULL){
    //     echo "<script>window.location = 'categories.php'</script>";
    // }
    $id = $_GET['productId'];
    $delprod = $prod->delete_product($id);
    
    header('Location:products.php');