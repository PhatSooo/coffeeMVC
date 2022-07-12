<?php
include_once  $_SERVER['DOCUMENT_ROOT'] . '/CoffeeMVC/lib/database.php';
include_once  $_SERVER['DOCUMENT_ROOT'] . '/CoffeeMVC/helper/format.php';
?>

<?php

class Table
{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function show_all()
    {
        $query = "SELECT * FROM tbl_table";
        $rs = $this->db->select($query);
        return $rs;
    }
}
