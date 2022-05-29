<?php
include '../lib/session.php';
Session::checkSession();
?>
<?php
include 'inc/header.php';
?>

<?php
include '../classes/category.php';
$cate = new Category();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cateName = $_POST['cateName'];
    $insert_cate = $cate->insert_category($cateName);
}
?>

<div class="page-header">
    <h3 class="page-title"> Manage Categories Page </h3>
    </nav>
</div>
<!-- view cate -->
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Basic Table</h4>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>CateID</th>
                                <th>CateName</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $show_cate = $cate->show_category();
                            if ($show_cate) {
                                $i = 0;
                                while ($rs = $show_cate->fetch_array()) {
                                    $i++;
                            ?>
                                    <tr>
                                        <td><?php echo $rs['cateId'] ?></td>
                                        <td><?php echo $rs['cateName'] ?></td>
                                        <td><?php
                                            switch ($rs['cateStatus']) {
                                                case 0:
                                                    echo ("<lable class='badge badge-success'>Active</lable>");
                                                    break;
                                                case 1;
                                                    echo ("<lable class='badge badge-danger'>Inactive</lable>");
                                                    break;
                                                case 2:
                                                    echo ("<lable class='badge badge-warning'>Pending</lable>");
                                                    break;
                                            }
                                            ?></td>
                                        <td><button id="editbtn" data-bs-toggle="modal" data-bs-target="#editCate<?php echo $rs['cateId'] ?>" class="btn btn-inverse-primary">Edit</button>
                                            ||
                                            <a onclick="return confirm('Are you sure to delete this item?')" href="catedel.php?cateId=<?php echo $rs['cateId'] ?>" class="btn btn-inverse-info" href="">Delete</a>
                                        </td>
                                    </tr>

                                    <!-- Modal -->
                                    <form action="cateedit.php" method="POST">
                                        <div class="modal fade" id="editCate<?php echo $rs['cateId'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <input type="hidden" name="editCateId" value="<?php echo $rs['cateId'] ?>">
                                                        <input name="editCateName" value="<?php echo $rs['cateName'] ?>" type="text" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" placeholder="Input Category Name here....">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="closebtn">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                            <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- add cate -->
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Adding Category</h4>
                <?php
                if (isset($insert_cate)) {
                    echo $insert_cate;
                }
                ?>
                <form class="form-inline" method="POST" action="categories.php">
                    <input name="cateName" type="text" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" placeholder="Input Category Name here....">
                    <button type="submit" class="btn btn-primary mb-2">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>


<?php include 'inc/footer.php'; ?>