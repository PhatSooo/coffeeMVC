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

    public function list_order($cus_id)
    {
        $query = "SELECT * FROM tbl_order WHERE customerId = $cus_id";
        $list = $this->db->select($query);
        return $list;
    }

    public function del_order($orderId)
    {
        $query = "DELETE FROM tbl_order WHERE id = $orderId";
        $this->db->delete($query);

        // DELELE IN tbl_orderDetails
        $query = "DELETE FROM tbl_orderDetails WHERE orderId = $orderId";
        $this->db->delete($query);
    }
    
    public function list_all_order()
    {
        $query = "SELECT * FROM tbl_order";
        $list = $this->db->select($query);
        return $list;
    }

    public function list_all_orderDetails_by_orderId($orderId)
    {
        $query = "SELECT * FROM tbl_orderDetails WHERE orderId = $orderId";
        $list = $this->db->select($query);
        return $list;
    }
}
