<?php
include_once  $_SERVER['DOCUMENT_ROOT'].'/CoffeeMVC/lib/database.php';
include_once  $_SERVER['DOCUMENT_ROOT'].'/CoffeeMVC/helper/format.php';
?>

<?php
class Booktable
{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function create_appointment($data)
    {
        $btName = $data['fname'] . ' ' . $data['lname'];
        $btName = $this->fm->validation($btName);
        $btName = mysqli_real_escape_string($this->db->link, $btName);

        $btDate = date("y-m-d", strtotime($data['date']));

        $btTime = $this->fm->validation($data['time']);
        $btTime = mysqli_real_escape_string($this->db->link, $btTime);

        $btPhone = $this->fm->validation($data['phone']);
        $btPhone = mysqli_real_escape_string($this->db->link, $btPhone);

        $btMess = $this->fm->validation($data['mess']);
        $btMess = mysqli_real_escape_string($this->db->link, $btMess);

        if (!isset($btName) || !isset($btDate) || !isset($btTime) || !isset($btPhone) || !isset($btMess)) {
            $alert = "<span class='badge badge-pill badge-danger'>Please Input Your Info to let us book a table for u</span>";
            return $alert;
        } else {
            $query = "INSERT INTO tbl_booktable(booktbName,booktbDate,booktbTime,booktbPhone,booktbMess) VALUE ('$btName','$btDate','$btTime','$btPhone','$btMess')";
            $rs = $this->db->insert($query);
            if ($rs) {
                $alert = "<span class='badge badge-pill badge-success'>Your Appointment create Successfully</span>";
                return $alert;
            } else {
                $alert = "<span class='badge badge-pill badge-warning'>Your Appointment is fail when creating</span>";
                return $alert;
            }
        }
    }

    public function show_all()
    {
        $query = "SELECT * FROM tbl_booktable";
        $rs = $this->db->select($query);
        return $rs;
    }
}
