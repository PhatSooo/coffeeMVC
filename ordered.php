<?php
include 'inc/header.php';

if (!(Session::get('customer_login'))) {
    header('Location:login.php');
}

if (isset($_GET['ID']) && $_GET['ID'] != '') {
    $del_order = $order->del_order($_GET['ID']);
}
?>

<section class="home-slider owl-carousel">

    <div class="slider-item" style="background-image: url(images/bg_3.jpg);" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row slider-text justify-content-center align-items-center">

                <div class="col-md-7 col-sm-12 text-center ftco-animate">
                    <h1 class="mb-3 mt-5 bread">Checkout</h1>
                    <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span>Checout</span></p>
                </div>

            </div>
        </div>
    </div>
</section>

<section class="ftco-section">
    <div class="container">
        <h1 style="text-align: center; color: aquamarine;">HERE IS ALL YOUR ORDER</h1>
        <br>
        <table class="table">
            <thead style="background-color: beige ;">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Order ID</th>
                    <th scope="col">Details</th>
                    <th scope="col">Order Time</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $cus_id = Session::get('customer_id');
                $get_orderD = $order->list_orderDetails_byID($cus_id);
                if ($get_orderD != true) {
                    echo '<h4 style="text-align:center;">You Has No Ordered</h4>';
                    echo '<a href="index.php" id="hover" style="color: lawngreen">Go to Order</a>';
                } else {
                    $i = 0;
                    while ($row = $get_orderD->fetch_assoc()) {
                        $i++
                ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $row['orderId'] ?></td>
                            <td>
                                <table>
                                    <tr>
                                        <th scope="col">Product</th>
                                        <th scope="col">Image</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Quantity</th>
                                    </tr>
                                    <?php
                                    $getBy_id = $order->getBy_id($row['orderId']);
                                    while ($res = $getBy_id->fetch_array()) {
                                    ?>
                                        <tr>
                                            <td><?= $res['productName'] ?></td>
                                            <td><img src="admin/uploads/<?= $res['image'] ?>" width="100" height="100"></td>
                                            <td><?= $res['price'] ?></td>
                                            <td><?= $res['quantity'] ?></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </table>
                            </td>
                            <td><?= $row['dateOrder'] ?></td>
                            <td>
                                <?php
                                if ($row['status'] == 0) echo '<span class="btn btn-warning">Pending</span>';
                                else if ($row['status'] == 2) echo '<span class="btn btn-danger">Denied</span>';
                                else if ($row['status'] == 3) echo '<span class="btn btn-info">Shipping</span>';
                                else if ($row['status'] == 4) echo '<span class="btn btn-light">Completed</span>';
                                else echo '<span class="btn btn-success">Accepted</span>';
                                ?></td>
                            <td>
                                <?php
                                if ($row['status'] != 0) echo 'N/A';
                                else {
                                ?>
                                    <a onclick="return confirm('Do you want to delete?');" href="?ID=<?= $row['orderId'] ?>">Delete</a>
                                <?php
                                }
                                ?>
                            </td>
                        </tr>

                <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</section>

<?php
include 'inc/footer.php';
?>