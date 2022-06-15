<?php
    include '../classes/category.php';

    $cate = new Category();
    // if(!isset($_GET('cateId')) || $_GET('cateId') == NULL){
    //     echo "<script>window.location = 'categories.php'</script>";
    // }
    $id = $_GET['cateId'];
    
    $delcate = $cate->delete_category($id);
    header('Location:categories.php');