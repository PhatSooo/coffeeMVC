<?php
include_once  $_SERVER['DOCUMENT_ROOT'] . '/CoffeeMVC/lib/database.php';
include_once  $_SERVER['DOCUMENT_ROOT'] . '/CoffeeMVC/helper/format.php';
?>
<?php

class Cart
{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function add_to_cart($id, $quantity, $size)
    {
        $quantity = $this->fm->validation($quantity);
        $quantity = mysqli_real_escape_string($this->db->link, $quantity);

        $size = $this->fm->validation($size);
        $size = mysqli_real_escape_string($this->db->link, $size);

        $id = mysqli_real_escape_string($this->db->link, $id);
        $sId = session_id();

        $check_cart = "SELECT * FROM tbl_cart WHERE productId = $id AND sId = '$sId'";
        $check_cart = $this->db->select($check_cart);
        if ($check_cart) {
            $msg = "<script>alert('You already added this product before');</script>";
            return $msg;
        } else {
            $query = "SELECT * FROM tbl_product WHERE productId = $id";
            $prod = $this->db->select($query)->fetch_array();

            $name = $prod['productName'];
            $price = $prod['productPrice'];
            $image = $prod['productImage'];

            $insert = "INSERT INTO tbl_cart(productId,sId,productName,price,quantity,size,image) VALUE ($id,'$sId','$name','$price',$quantity,'$size','$image')";
            $rs2 = $this->db->insert($insert);

            if ($rs2) {
                header('Location:cart.php');
            } else {
                header('Location:error-404.php');
            }
        }
    }

    public function show_cart()
    {
        $sId = session_id();
        $query = "SELECT * FROM tbl_cart WHERE sId = '$sId'";
        $cart = $this->db->select($query);
        return $cart;
    }

    public function change_quantity($id, $quantity)
    {
        $quantity = $this->fm->validation($quantity);
        $quantity = mysqli_real_escape_string($this->db->link, $quantity);

        $id = mysqli_real_escape_string($this->db->link, $id);

        $query = "UPDATE tbl_cart SET quantity = $quantity WHERE cartId = $id";
        // return $query;
        $rs = $this->db->update($query);
        if ($rs) {
            return header('Location:cart.php');
        }
    }

    public function del_cart($id)
    {
        $id = mysqli_real_escape_string($this->db->link, $id);

        $query = "DELETE FROM tbl_cart WHERE cartId = $id";
        $rs = $this->db->delete($query);

        if ($rs) {
            header('Location: cart.php');
        } else {
            $msg = "<span class='text-danger'>Delete Product Successfully</span>";
            return $msg;
        }
    }

    public function check_cart()
    {
        $sId = session_id();
        $query = "SELECT * FROM tbl_cart WHERE sId = '$sId'";
        $rs = $this->db->select($query);
        return $rs;
    }

    public function del_all_data_cart()
    {
        $sId = session_id();
        $query = "DELETE FROM tbl_cart WHERE sId = '$sId'";
        $this->db->select($query);
    }

    public function insertOrder($data, $cus_id, $method)
    {
        $sId = session_id();
        $query = "SELECT * FROM tbl_cart WHERE sId = '$sId'";
        $get_product = $this->db->select($query);

        if ($get_product) {
            $id = uniqid();
            while ($res = $get_product->fetch_array()) {
                $productId = $res['productId'];
                $productName = $res['productName'];
                $quantity = $res['quantity'];
                $price = $res['price'] * $quantity;
                $img = $res['image'];
                $customer_id = $cus_id;

                
                $query_order = "INSERT INTO tbl_order (id,productId,productName,quantity,price,image,customerId,payments)
                    VALUES ('$id',$productId,'$productName',$quantity,'$price','$img',$customer_id,'$method')";

                $this->db->insert($query_order);
                
            }
            $get_current = $id;
            $addressReceive = $data['house'] . ', ' . $data['address'];
            $name = $data['name'];
            $phone = $data['phone'];

            if ($method == 'offline') {
                $query_order_details = "INSERT INTO tbl_orderDetails (orderId,addressReceiver,customerName,phone) 
                    VALUES ('$get_current','$addressReceive','$name','$phone')";
            } else {
                $query_order_details = "INSERT INTO tbl_orderDetails (orderId,addressReceiver,customerName,phone,ispayment) 
                    VALUES ('$get_current','$addressReceive','$name','$phone',1)";
            }

            $this->db->insert($query_order_details);
        }
    }
}
