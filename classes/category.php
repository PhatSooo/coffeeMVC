<?php
include '../lib/database.php';
include '../helper/format.php';
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
        if (empty($cateName)) {
            $alert = "<span class='link-warning'>Category Name must be not empty</span>";
            return $alert;
        } else {
            $query = "INSERT INTO tbl_category(cateName,cateStatus) VALUE ('$cateName',2)";
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
}
