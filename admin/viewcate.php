<?php
include '../lib/session.php';
Session::checkSession();
?>
<?php
include 'inc/header.php';
include '../classes/category.php';
?>

<?php
$cate = new Category();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cateName = $_POST['cateName'];

    $insert_cate = $cate->insert_category($cateName);
}
?>

<div class="main-panel">
    <div class="content-wrapper">
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
                                        while ($rs = $show_cate->fetch_assoc()) {
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
                                                            echo ("<lable class='badge badge-danger'>Deactive</lable>");
                                                            break;
                                                        case 2:
                                                            echo ("<lable class='badge badge-warning'>Pending</lable>");
                                                            break;
                                                    }
                                                    ?></td>
                                                <td><a class="btn btn-inverse-primary" href="">Edit</a> || <a class="btn btn-inverse-info" href="">Delete</a></td>
                                            </tr>
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
                        <form class="form-inline" method="POST" action="viewcate.php">
                            <input name="cateName" type="text" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" placeholder="Input Category Name here....">
                            <button type="submit" class="btn btn-primary mb-2">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    include 'inc/footer.php';
    ?>