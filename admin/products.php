<?php
include '../lib/session.php';
Session::checkSession();
?>
<?php
include 'inc/header.php';
include '../classes/category.php';
include '../classes/product.php';
include_once '../helper/format.php';
?>


<?php
$prod = new Product();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $insert_prod = $prod->insert_product($_POST, $_FILES);
}

$fm = new Format();

?>

<div class="page-header">
    <h3 class="page-title"> Manage Products Page </h3>
    <a class="nav-link btn btn-success create-new-button" href="#add">+ Create New Product</a>
    </nav>
</div>

<div class="container" style="padding-left: 10%">
    <div class="row">
        <?php
        echo '<div class="col-sm">';
        echo '<p style="padding-left:90%">Sort by:</p> </div>';

        $cate = new Category();
        $catelist = $cate->show_category();
        echo '<div class="col-sm">';
        while ($rs = $catelist->fetch_array()) {
            echo '<a href="?page=' . $rs['cateId'] . '"class="btn btn-outline-light" style="margin-left: 10px">' . $rs['cateName'] . '</a>';
        }
        echo '<a href="products.php" class="btn btn-outline-light" style="margin-left: 10px">Clear</a>';
        echo '</div>';
        ?>
    </div>
</div>
<!-- view prods -->
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Products Table</h4>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Item#</th>
                                <th>ProdName</th>
                                <th>CateName</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Image</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!isset($_GET['page'])) {
                                $show_prod = $prod->show_product();
                                if ($show_prod) {
                                    $i = 0;
                                    while ($rs = $show_prod->fetch_array()) {
                                        $i++;
                            ?>
                                        <tr>
                                            <td><?php echo $i ?></td>
                                            <td><?php echo $rs['productName'] ?></td>
                                            <td><?php echo $rs['cateName'] ?></td>
                                            <td><?php echo $fm->textShorten($rs['productDesc'], 70)  ?></td>
                                            <td><?php echo $rs['productPrice'] ?></td>
                                            <td>
                                                <img src="uploads/<?php echo $rs['productImage'] ?>">
                                            </td>
                                            <td><?php
                                                switch ($rs['productStatus']) {
                                                    case 0:
                                                        echo ('<a href="../classes/status.php?id=' . $rs['productId'] . '&status=0&page=product" class="btn btn-success">Active</a>');
                                                        break;
                                                    case 1;
                                                        echo ('<a href="../classes/status.php?id=' . $rs['productId'] . '&status=1&page=product" class="btn btn-danger">Inactive</a>');
                                                        break;
                                                    case 2:
                                                        echo ('<a href="../classes/status.php?id=' . $rs['productId'] . '&status=2&page=product" class="btn btn-warning">Pending</a>');
                                                        break;
                                                }
                                                ?></td>
                                            <td><button id="editbtn" data-bs-toggle="modal" data-bs-target="#editProd<?php echo $rs['productId'] ?>" class="btn btn-inverse-primary">Edit</button>
                                                ||
                                                <a onclick="return confirm('Are you sure to delete this item?')" href="productdel.php?productId=<?php echo $rs['productId'] ?>" class="btn btn-inverse-info">Delete</a>
                                            </td>
                                        </tr>

                                        <!-- Modal -->
                                        <form action="productedit.php" method="POST" enctype="multipart/form-data">
                                            <div class="modal fade" id="editProd<?php echo $rs['productId'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Editing Product</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <input type="hidden" name="editProdId" value="<?php echo $rs['productId'] ?>">
                                                            <input type="hidden" name="getOldImg" value="<?php echo $rs['productImage'] ?>">
                                                            <input name="editProdName" value="<?php echo $rs['productName'] ?>" type="text" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" placeholder="Input Product Name here....">
                                                            <textarea style="height: 150px" name="editProdDesc" type="text" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" placeholder="Input Product Description here...."><?php echo $rs['productDesc'] ?></textarea>
                                                            <input name="editProdPrice" value="<?php echo $rs['productPrice'] ?>" type="text" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" placeholder="Input Product Price here....">

                                                            <div class="form-group">
                                                                <select id="select" name="editCateId" class="js-example-basic-single" style="width:100%">
                                                                    <?php
                                                                    $cate = new Category();
                                                                    $catelist = $cate->show_category();
                                                                    if (isset($catelist)) {
                                                                        while ($rss = $catelist->fetch_array()) {
                                                                    ?>
                                                                            <option <?php
                                                                                    if ($rs['cateId'] == $rss['cateId']) {
                                                                                        echo 'selected';
                                                                                    }
                                                                                    ?> value="<?php echo $rss['cateId'] ?>"><?php echo $rss['cateName'] ?></option>
                                                                    <?php
                                                                        }
                                                                    }
                                                                    ?>

                                                                </select>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm">
                                                                    <img width="300px" height="300px" src="uploads/<?php echo $rs['productImage'] ?>">
                                                                </div>
                                                                <div class="col-sm">
                                                                    <div class="form-group" style="margin-top: 100%;">
                                                                        <input type="file" name="editProdImg" class="file-upload-default">
                                                                        <div class="input-group col-xs-12">
                                                                            <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                                                                            <span class="input-group-append">
                                                                                <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>


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
                            } else {
                                $show_prod = $prod->show_product_byCateId($_GET['page']);
                                if ($show_prod) {
                                    $i = 0;
                                    while ($rs = $show_prod->fetch_array()) {
                                        $i++;
                                    ?>
                                        <tr>
                                            <td><?php echo $i ?></td>
                                            <td><?php echo $rs['productName'] ?></td>
                                            <td><?php echo $rs['cateName'] ?></td>
                                            <td><?php echo $fm->textShorten($rs['productDesc'], 70)  ?></td>
                                            <td><?php echo $rs['productPrice'] ?></td>
                                            <td>
                                                <img src="uploads/<?php echo $rs['productImage'] ?>">
                                            </td>
                                            <td><?php
                                                switch ($rs['productStatus']) {
                                                    case 0:
                                                        echo ('<a href="../classes/status.php?id=' . $rs['productId'] . '&status=0&page=product" class="btn btn-success">Active</a>');
                                                        break;
                                                    case 1;
                                                        echo ('<a href="../classes/status.php?id=' . $rs['productId'] . '&status=1&page=product" class="btn btn-danger">Inactive</a>');
                                                        break;
                                                    case 2:
                                                        echo ('<a href="../classes/status.php?id=' . $rs['productId'] . '&status=2&page=product" class="btn btn-warning">Pending</a>');
                                                        break;
                                                }
                                                ?></td>
                                            <td><button id="editbtn" data-bs-toggle="modal" data-bs-target="#editProd<?php echo $rs['productId'] ?>" class="btn btn-inverse-primary">Edit</button>
                                                ||
                                                <a onclick="return confirm('Are you sure to delete this item?')" href="productdel.php?productId=<?php echo $rs['productId'] ?>" class="btn btn-inverse-info">Delete</a>
                                            </td>
                                        </tr>

                                        <!-- Modal -->
                                        <form action="productedit.php" method="POST" enctype="multipart/form-data">
                                            <div class="modal fade" id="editProd<?php echo $rs['productId'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Editing Product</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <input type="hidden" name="editProdId" value="<?php echo $rs['productId'] ?>">
                                                            <input type="hidden" name="getOldImg" value="<?php echo $rs['productImage'] ?>">
                                                            <input name="editProdName" value="<?php echo $rs['productName'] ?>" type="text" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" placeholder="Input Product Name here....">
                                                            <textarea style="height: 150px" name="editProdDesc" type="text" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" placeholder="Input Product Description here...."><?php echo $rs['productDesc'] ?></textarea>
                                                            <input name="editProdPrice" value="<?php echo $rs['productPrice'] ?>" type="text" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" placeholder="Input Product Price here....">

                                                            <div class="form-group">
                                                                <select id="select" name="editCateId" class="js-example-basic-single" style="width:100%">
                                                                    <?php
                                                                    $cate = new Category();
                                                                    $catelist = $cate->show_category();
                                                                    if (isset($catelist)) {
                                                                        while ($rss = $catelist->fetch_array()) {
                                                                    ?>
                                                                            <option <?php
                                                                                    if ($rs['cateId'] == $rss['cateId']) {
                                                                                        echo 'selected';
                                                                                    }
                                                                                    ?> value="<?php echo $rss['cateId'] ?>"><?php echo $rss['cateName'] ?></option>
                                                                    <?php
                                                                        }
                                                                    }
                                                                    ?>

                                                                </select>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm">
                                                                    <img width="300px" height="300px" src="uploads/<?php echo $rs['productImage'] ?>">
                                                                </div>
                                                                <div class="col-sm">
                                                                    <div class="form-group" style="margin-top: 100%;">
                                                                        <input type="file" name="editProdImg" class="file-upload-default">
                                                                        <div class="input-group col-xs-12">
                                                                            <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                                                                            <span class="input-group-append">
                                                                                <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>


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
                            }
                            ?>


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- add prod -->
<a name="add">
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Adding Product</h4>
                    <?php
                    if (isset($insert_prod)) {
                        echo $insert_prod;
                    }
                    ?>
                    <form class="forms-sample" action="products.php" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="exampleInputName1">Product Name</label>
                            <input type="text" class="form-control" name="productName" id="exampleInputName1" placeholder="Input Product Name here....">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword4">Product Price</label>
                            <input type="text" class="form-control" name="productPrice" id="exampleInputPassword4" placeholder="Input Product Price here....">
                        </div>
                        <div class="form-group">
                            <label>Select Product Category</label>
                            <select id="select" name="cateId" class="js-example-basic-single" style="width:100%">
                                <option>---Select Category---</option>
                                <?php
                                $cate = new Category();
                                $catelist = $cate->show_category();
                                if (isset($catelist)) {
                                    while ($rs = $catelist->fetch_array()) {
                                ?>
                                        <option value="<?php echo $rs['cateId'] ?>"><?php echo $rs['cateName'] ?></option>
                                <?php
                                    }
                                }
                                ?>

                            </select>
                        </div>
                        <div class="form-group">
                            <label>Product Image Upload</label>
                            <input type="file" name="productImg" class="file-upload-default">
                            <div class="input-group col-xs-12">
                                <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                                <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleTextarea1">Product Description</label>
                            <textarea name="productDesc" class="form-control" id="exampleTextarea1" style="height: 150px"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                        <button class="btn btn-dark">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</a>


<style>
    table td:hover img {
        transform: scale(5);
    }
</style>

<?php include 'inc/footer.php'; ?>