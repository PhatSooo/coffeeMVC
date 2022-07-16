<?php
include_once  $_SERVER['DOCUMENT_ROOT'] . '/CoffeeMVC/lib/database.php';
include_once  $_SERVER['DOCUMENT_ROOT'] . '/CoffeeMVC/lib/session.php';
include_once  $_SERVER['DOCUMENT_ROOT'] . '/CoffeeMVC/helper/format.php';
?>

<?php
class Chart
{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function chart_calculate()
    {
        $query = "SELECT date_format(a.dateOrder, '%M') month,sum(a.price) total 
                    FROM tbl_order a INNER JOIN tbl_orderdetails b
                    ON a.id = b.orderId WHERE b.isPayment = 1 GROUP BY MONTH(a.dateOrder)";
        $res = $this->db->select($query);
        return $res;
    }
} 
?>