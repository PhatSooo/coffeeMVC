<?php
include '../lib/session.php';
Session::checkLogin();
include '../lib/database.php';
include '../helper/format.php';
?>

<?php
class Adminlogin
{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function login_admin($adminUser, $adminPass)
    {
        $adminUser = $this->fm->validation($adminUser);
        $adminPass = $this->fm->validation($adminPass);

        $adminUser = mysqli_real_escape_string($this->db->link, $adminUser);
        $adminPass = mysqli_real_escape_string($this->db->link, $adminPass);

        if (empty($adminUser) || empty($adminPass)) {
            $alert = 'User and Pass must be not empty!!';
            return $alert;
        } else {
            $query = "SELECT * FROM tbl_admin WHERE adminUser = '$adminUser' AND adminPass = '$adminPass' LIMIT 1";
            $rs = $this->db->select($query);

            if ($rs != false){
                $val = $rs->fetch_array();
                Session::set('adminlogin',true);
                Session::set('adminId',$val['adminId']);
                Session::set('adminUser',$val['adminUser']);
                Session::set('adminName',$val['adminName']);
                header('Location:main.php');
            }
            else {
                $alert = 'User and Pass not match!!';
                return $alert;
            }
        }
    }
}
