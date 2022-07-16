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
        $query = "SELECT * FROM tbl_order WHERE id IN ( SELECT id FROM tbl_order GROUP BY id ) AND customerId = $cus_id";
        return $this->db->select($query);
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

    public function getBy_id_cusid($id, $cus_id)
    {
        $query = "SELECT productId,productName,quantity,price,image,dateOrder,payments,status FROM tbl_order WHERE id IN ( SELECT id FROM tbl_order GROUP BY id ) AND customerId = $cus_id AND id = '$id'";
        return $this->db->select($query);
    }
}
