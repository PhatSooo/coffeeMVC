<?php
include_once  $_SERVER['DOCUMENT_ROOT'].'/CoffeeMVC/lib/database.php';
include_once  $_SERVER['DOCUMENT_ROOT'].'/CoffeeMVC/helper/format.php';
?>

<?php
class Product
{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function insert_product($data, $files)
    {
        $prodName = mysqli_real_escape_string($this->db->link, $data['productName']);
        $prodPrice = mysqli_real_escape_string($this->db->link, $data['productPrice']);
        $prodCate = mysqli_real_escape_string($this->db->link, $data['cateId']);
        $prodDesc = mysqli_real_escape_string($this->db->link, $data['productDesc']);

        $permited = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $_FILES['productImg']['name'];
        $file_size = $_FILES['productImg']['size'];
        $file_temp = $_FILES['productImg']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = "uploads/" . $unique_image;

        $checkExist = $this->db->select("SELECT * FROM tbl_product WHERE productName = '$prodName'");
        if ($prodName == "" || $prodPrice == "" || $prodCate == 0 || $prodDesc == "" || $file_name == "") {
            $alert = "<span class='link-danger'>Fields must be not empty</span>";
            return $alert;
        } else if ($checkExist !== false && $checkExist->num_rows > 0) {
            $alert = "<span class='link-warning'>Product Name is already exist</span>";
            return $alert;
        } else {
            move_uploaded_file($file_temp, $uploaded_image);

            $getHigh = "SELECT * FROM tbl_product WHERE cateId = '$prodCate' ORDER BY productOrder DESC LIMIT 1";
            $getHigh = $this->db->select($getHigh);
            if (!empty($getHigh->num_rows) && $getHigh->num_rows > 0) {
                $getHigh = $getHigh->fetch_array();
                $result = $getHigh['productOrder'] + 1;
                $query = "INSERT INTO tbl_product(productName,productPrice,cateId,productDesc,productImage,productStatus,productOrder) VALUE ('$prodName','$prodPrice','$prodCate','$prodDesc','$unique_image',2,$result)";
            }
            else {
                $query = "INSERT INTO tbl_product(productName,productPrice,cateId,productDesc,productImage,productStatus,productOrder) VALUE ('$prodName','$prodPrice','$prodCate','$prodDesc','$unique_image',2,0)";
            
            }
            $rs = $this->db->insert($query);

            if ($rs) {
                $alert = "<span class='link-success'>Insert Product Successfully</span>";
                return $alert;
            } else {
                $alert = "<span class='link-danger'>Insert Product Not Success</span>";
                return $alert;
            }
        }
    }

    public function show_product()
    {
        $query = "SELECT tbl_product.*, tbl_category.cateName FROM tbl_product INNER JOIN tbl_category 
        ON tbl_product.cateId = tbl_category.cateId
        ORDER BY tbl_product.productOrder";
        $rs = $this->db->select($query);
        return $rs;
    }

    public function show_product_byCateId($cateId)
    {
        $query = "SELECT tbl_product.*, tbl_category.cateName FROM tbl_product INNER JOIN tbl_category 
        ON tbl_product.cateId = tbl_category.cateId
        WHERE tbl_product.cateId = $cateId
        ORDER BY tbl_product.productOrder";
        $rs = $this->db->select($query);
        return $rs;
    }

    public function show_product_byProdId($prodId)
    {
        $query = "SELECT * FROM tbl_product WHERE productId = $prodId";
        $rs = $this->db->select($query);
        return $rs;
    }

    public function update_product($data, $files)
    {
        $prodName = $this->fm->validation($data['editProdName']);
        $prodName = mysqli_real_escape_string($this->db->link, $prodName);

        $cateId = $this->fm->validation($data['editCateId']);
        $cateId = mysqli_real_escape_string($this->db->link, $cateId);

        $prodDesc = $this->fm->validation($data['editProdDesc']);
        $prodDesc = mysqli_real_escape_string($this->db->link, $prodDesc);

        $prodPrice = $this->fm->validation($data['editProdPrice']);
        $prodPrice = mysqli_real_escape_string($this->db->link, $prodPrice);

        $oldImg = $this->fm->validation($data['getOldImg']);
        $oldImg = mysqli_real_escape_string($this->db->link, $oldImg);

        $id = mysqli_real_escape_string($this->db->link, $data['editProdId']);

        $permited = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $_FILES['editProdImg']['name'];
        $file_size = $_FILES['editProdImg']['size'];
        $file_temp = $_FILES['editProdImg']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = "uploads/" . $unique_image;

        if (empty($prodName) || empty($cateId) || empty($prodDesc) || empty($prodPrice)) {
            $alert = "<span class='link-warning'>Product Name must be not empty</span>";
            return $alert;
        } else {
            //Image Changed
            if (!empty($file_name)) {
                if ($file_size > 1048567) {
                    $alert = "<span class='link-danger'>loi vai</span>";
                    return $alert;
                } else if (in_array($file_ext, $permited) === false) {
                    $alert = "<span class='link-danger'>loi vai</span>";
                    return $alert;
                }
                move_uploaded_file($file_temp, $uploaded_image);
                unlink('uploads/' . $oldImg);
                $query = "UPDATE tbl_product SET 
                    productName = '$prodName', 
                    cateId = $cateId, 
                    productDesc = '$prodDesc', 
                    productPrice = '$prodPrice',
                    productImage = '$unique_image'
                WHERE productId = $id";

                $rs = $this->db->update($query);
            }

            //Image not change
            else {
                $query = "UPDATE tbl_product SET 
                    productName = '$prodName', 
                    cateId = $cateId, 
                    productDesc = '$prodDesc', 
                    productPrice = '$prodPrice' 
                WHERE productId = $id";

                $rs = $this->db->update($query);
            }

            if ($rs) {
                $alert = "<span class='link-success'>Insert Product Successfully</span>";
                return $alert;
            } else {
                $alert = "<span class='link-danger'>Insert Product Not Success</span>";
                return $alert;
            }
        }
    }

    public function delete_product($id)
    {
        $query = "DELETE FROM tbl_product WHERE productId = $id";
        $this->db->delete($query);
    }
}
