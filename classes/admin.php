<?php
include_once  $_SERVER['DOCUMENT_ROOT'] . '/CoffeeMVC/lib/database.php';
include_once  $_SERVER['DOCUMENT_ROOT'] . '/CoffeeMVC/lib/session.php';
include_once  $_SERVER['DOCUMENT_ROOT'] . '/CoffeeMVC/helper/format.php';
?>
<?php

class Admin
{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function list_all()
    {
        $query = "SELECT * FROM tbl_admin";
        return $this->db->select($query);
    }

    public function del_acc($id)
    {
        $query = "DELETE FROM tbl_admin WHERE adminId = $id";
        return $this->db->delete($query);
    }
}
