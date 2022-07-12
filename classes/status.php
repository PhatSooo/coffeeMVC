<?php
include_once  '../lib/database.php';

$db = new Database();
$id = $_GET['id'];
$status = $_GET['status'];
$page = $_GET['page'];

switch ($page) {
    case 'product':
        if ($status == 2 || $status == 0) {
            $query = "UPDATE tbl_product SET productStatus = 1 WHERE productId = $id";
        } else {
            $query = "UPDATE tbl_product SET productStatus = 0 WHERE productId = $id";
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
    case 'orders':
        if ($status == 0) {
            $query = "UPDATE tbl_order SET status = 1 WHERE id = $id";
        } elseif ($status == 1) {
            $query = "UPDATE tbl_order SET status = 2 WHERE id = $id";
        } else {
            $query = "UPDATE tbl_order SET status = 1 WHERE id = $id";
        }
        $db->update($query);
        header('Location:../admin/orders.php');
        break;
    case 'ship':
        $query = "UPDATE tbl_order SET status = 3 WHERE id = $id";
        $db->update($query);
        header('Location:../admin/orders.php');
        break;
    case 'accountsAD':
        if ($status == 1) {
            $query = "UPDATE tbl_admin SET status = 0 WHERE adminId = $id";
        } else {
            $query = "UPDATE tbl_admin SET status = 1 WHERE adminId = $id";
        }
        $db->update($query);
        header('Location:../admin/accounts.php?page=0');
        break;
    case 'accountsCUS':
        if ($status == 1) {
            $query = "UPDATE tbl_customer SET status = 0 WHERE id = $id";
        } else {
            $query = "UPDATE tbl_customer SET status = 1 WHERE id = $id";
        }
        $db->update($query);
        header('Location:../admin/accounts.php?page=1');
        break;
    case 'accountsSHIP':
        if ($status == 1) {
            $query = "UPDATE tbl_shipper SET status = 0 WHERE id = $id";
        } else {
            $query = "UPDATE tbl_shipper SET status = 1 WHERE id = $id";
        }
        $db->update($query);
        header('Location:../admin/accounts.php?page=2');
        break;
}
