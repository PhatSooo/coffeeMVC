<?php
include_once  '../lib/database.php';

$db = new Database();
$id = $_GET['id'];
$status = $_GET['status'];
$page = $_GET['page'];

switch ($page) {
    case 'product':
        if ($status == 2 || $status == 1) {
            $query = "UPDATE tbl_product SET productStatus = 0 WHERE productId = $id";
        } else {
            $query = "UPDATE tbl_product SET productStatus = 1 WHERE productId = $id";
        }

        $db->update($query);
        header('Location:../admin/products.php');
        break;
    case 'category':
        if ($status == 2 || $status == 1) {
            $query = "UPDATE tbl_category SET cateStatus = 0 WHERE cateId = $id";
        } else {
            $query = "UPDATE tbl_category SET cateStatus = 1 WHERE cateId = $id";
        }

        $db->update($query);
        header('Location:../admin/categories.php');
        break;
    case 'btable':
        if ($status == 0) {
            $query = "UPDATE tbl_booktable SET booktbIsset = 1 WHERE booktbId = $id";
        } else {
            $query = "UPDATE tbl_booktable SET booktbIsset = 0 WHERE booktbId = $id";
        }
        $db->update($query);
        header('Location:../admin/booktables.php');
        break;
}
