<?php
include_once  '../lib/database.php';
include_once  '../helper/format.php';
?>
<?php

class Category
{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function insert_category($cateName)
    {
        $cateName = $this->fm->validation($cateName);
        $cateName = mysqli_real_escape_string($this->db->link, $cateName);

        $checkExist = $this->db->select("SELECT * FROM tbl_category WHERE cateName = '$cateName'");
        if (empty($cateName)) {
            $alert = "<span class='link-danger'>Category Name must be not empty</span>";
            return $alert;
        } else if ($checkExist !== false && $checkExist->num_rows > 0) {
            $alert = "<span class='link-warning'>Category Name is already exist</span>";
            return $alert;
        } else {
            $getHigh = "SELECT * FROM tbl_category ORDER BY cateOrder DESC LIMIT 1";
            $getHigh = $this->db->select($getHigh)->fetch_array();
            $result = $getHigh['cateOrder'] + 1;

            $query = "INSERT INTO tbl_category(cateName,cateStatus,cateOrder) VALUE ('$cateName',2,'$result')";
            $rs = $this->db->insert($query);

            if ($rs) {
                $alert = "<span class='link-success'>Insert Category Successfully</span>";
                return $alert;
            } else {
                $alert = "<span class='link-danger'>Insert Category Not Success</span>";
                return $alert;
            }
        }
    }

    public function show_category()
    {
        $query = "SELECT * FROM tbl_category ORDER BY cateOrder";
        $rs = $this->db->select($query);
        return $rs;
    }

    public function update_category($cateName, $id)
    {
        $cateName = $this->fm->validation($cateName);
        $cateName = mysqli_real_escape_string($this->db->link, $cateName);

        $id = mysqli_real_escape_string($this->db->link, $id);

        if (empty($cateName)) {
            $alert = "<span class='link-warning'>Category Name must be not empty</span>";
            return $alert;
        } else {
            $query = "UPDATE tbl_category SET cateName = '$cateName'WHERE cateId = $id";
            
            $rs = $this->db->update($query);

            if ($rs) {
                $alert = "<span class='link-success'>Insert Category Successfully</span>";
                return $alert;
            } else {
                $alert = "<span class='link-danger'>Insert Category Not Success</span>";
                return $alert;
            }
        }
    }

    public function delete_category($id)
    {
        $query = "DELETE FROM tbl_category WHERE cateId = '$id'";
        $this->db->delete($query);
    }
}
