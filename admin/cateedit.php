<?php
    include '../classes/category.php';
    $cate = new Category();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $cateName = $_POST['editCateName'];
        $id = $_POST['editCateId'];
        $update_cate = $cate->update_category($cateName, $id);
    }

    if (isset($update_cate)) {
        header('Location:categories.php');
    }
