<?php
include_once  $_SERVER['DOCUMENT_ROOT'] . '/CoffeeMVC/lib/database.php';
include_once  $_SERVER['DOCUMENT_ROOT'] . '/CoffeeMVC/lib/session.php';
include_once  $_SERVER['DOCUMENT_ROOT'] . '/CoffeeMVC/helper/format.php';
?>
<?php

class User
{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function insertCus($data)
    {
        $name = mysqli_real_escape_string($this->db->link, $data['name']);
        $email = mysqli_real_escape_string($this->db->link, $data['email']);
        $username = mysqli_real_escape_string($this->db->link, $data['username']);
        $pass = mysqli_real_escape_string($this->db->link, $data['pass']);

        if ($name == "" || $email == "" || $username == "" || $pass == "") {
            $alert = "<script>alert('Your field must be not empty')</script>";
            return $alert;
        } else {
            $check_email = "SELECT * FROM tbl_customer WHERE email = '$email' LIMIT 1";
            $res_check = $this->db->select($check_email);
            if ($res_check) {
                $alert = "<script>alert('Your email is already existed')</script>";
                return $alert;
            } else {
                $pass = md5($pass);
                $query = "INSERT INTO tbl_customer(name,email,username,password) VALUE ('$name','$email','$username','$pass')";

                $res = $this->db->insert($query);

                if ($res) {
                    $alert = "<script>alert('Create Account Successfully')</script>";
                    return $alert;
                } else {
                    $alert = "<script>alert('Create Account Failed')</script>";
                    return $alert;
                }
            }
        }
    }

    public function login_customer($data)
    {
        $username = mysqli_real_escape_string($this->db->link, $data['username']);
        $pass = mysqli_real_escape_string($this->db->link, $data['your_pass']);

        if ($username == "" || $pass == "") {
            $alert = "<span style = 'color: red;'>Fields must be not empty</span>";
            return $alert;
        } else {
            $check_login = "SELECT * FROM tbl_customer WHERE username = '$username' AND password = '$pass'";
            $res = $this->db->select($check_login);

            if ($res != false) {
                $value = $res->fetch_array();
                if ($value['status'] == 1) {
                    Session::set('customer_login', true);
                    Session::set('customer_id', $value[0]);
                    Session::set('customer_name', $value[1]);
                    header('Location:index.php');
                } else {
                    $alert = "<span style = 'color: red;'>Your Account is banned, Please contact to Admin for details</span>";
                    return $alert;
                }
            } else {
                $alert = "<span style = 'color: red;'>Username or Password is incorrect</span>";
                return $alert;
            }
        }
    }

    public function get_user($id)
    {
        $query = "SELECT * FROM tbl_customer WHERE id = $id";
        $res = $this->db->select($query);
        return $res->fetch_array();
    }

    public function update_cus($data, $id)
    {
        $name = mysqli_real_escape_string($this->db->link, $data['name']);
        $email = mysqli_real_escape_string($this->db->link, $data['email']);
        $phone = mysqli_real_escape_string($this->db->link, $data['phone']);
        $address = mysqli_real_escape_string($this->db->link, $data['address']);

        if ($name == "" || $email == "") {
            $alert = "<span style='color:red;'>Your Name or Your Email must be not empty</span>";
            return $alert;
        } else {
            $query = "UPDATE tbl_customer SET name = '$name', email = '$email', phone = '$phone', address = '$address' WHERE id = $id";
            $result = $this->db->update($query);

            if ($result) {
                $alert = "<span style='color:green;'>You has updated your info successfully</span>";
                Session::set('customer_name', $name);
                return $alert;
            } else {
                $alert = "<span style='color:red;'>Your info has not been updated</span>";
                return $alert;
            }
        }
    }

    public function list_all()
    {
        $query = "SELECT * FROM tbl_customer";
        return $this->db->select($query);
    }

    public function del_acc($id)
    {
        $query = "DELETE FROM tbl_customer WHERE id = $id";
        return $this->db->delete($query);
    }
}
