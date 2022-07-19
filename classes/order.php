<?php
include_once  $_SERVER['DOCUMENT_ROOT'] . '/CoffeeMVC/lib/database.php';
include_once  $_SERVER['DOCUMENT_ROOT'] . '/CoffeeMVC/helper/format.php';
?>
<?php

class Order
{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function list_orderDetails_byID($cus_id)
    {
        $query = "SELECT * FROM tbl_orderdetails WHERE customerId = $cus_id ORDER BY dateOrder DESC";
        $list = $this->db->select($query);
        return $list;
    }

    public function list_orderDetails()
    {
        $query = "SELECT * FROM tbl_orderdetails ORDER BY status, dateOrder DESC";
        return $this->db->delete($query);
    }

    public function list_order($cus_id)
    {
        $query = "SELECT a.*, b.orderId FROM tbl_order a RIGHT JOIN tbl_orderdetails b ON a.id = b.orderId WHERE b.customerId = $cus_id";
        $list = $this->db->select($query);
        return $list;
    }

    public function del_order($orderId)
    {
        // DELELE IN tbl_order
        $query = "DELETE FROM tbl_order WHERE id = '$orderId'";
        $this->db->delete($query);

        // DELELE IN tbl_orderDetails
        $query = "DELETE FROM tbl_orderdetails WHERE orderId = '$orderId'";
        $this->db->delete($query);
    }
    
    public function list_all_order()
    {
        $query = "SELECT a.*, b.* FROM tbl_order a INNER JOIN tbl_orderdetails b ON a.id = b.orderId";
        $list = $this->db->select($query);
        return $list;
    }

    public function list_all_orderDetails_by_orderId($orderId)
    {
        $query = "SELECT * FROM tbl_orderDetails WHERE orderId = '$orderId'";
        $list = $this->db->select($query);
        return $list;
    }

    public function getBy_id($id)
    {
        $query = "SELECT * FROM tbl_order WHERE id = '$id'";
        return $this->db->select($query);
    }
}
