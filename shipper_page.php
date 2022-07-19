<?php include 'inc/header.php'; ?>

<section class="home-slider owl-carousel">

    <div class="slider-item" style="background-image: url(images/bg_3.jpg);" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row slider-text justify-content-center align-items-center">
                <div class="col-md-7 col-sm-12 text-center ftco-animate">
                    <h1 class="mb-3 mt-5 bread">Shipper Page</h1>
                    <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span>Shipper</span></p>
                </div>

            </div>
        </div>
    </div>
</section>

<section class="ftco-section">
    <div class="container">
        <div class="row">
            <h1 style="text-align: center; color: aquamarine;">HERE IS ALL ORDERS YOU CAN RECEIVE</h1>
            <br>
            <table class="table">
                <thead style="background-color: beige ;">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Product</th>
                        <th scope="col">Image</th>
                        <th scope="col">Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Order Time</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $cus_id = Session::get('customer_id');
                    $get_order = $order->list_order($cus_id);
                    if ($get_order != true) {
                        echo '<h4 style="text-align:center;">You Has No Ordered</h4>';
                        echo '<a href="index.php" id="hover" style="color: lawngreen">Go to Order</a>';
                    } else {
                        $i = 0;
                        while ($res = $get_order->fetch_array()) {
                            $i++;
                    ?>
                            <tr>
                                <td>
                                    <p style="font-weight: bold;"><?= $i ?></p>
                                </td>
                                <td><?= $res['productName'] ?></td>
                                <td><img width="100" height="100" src="admin/uploads/<?= $res['image'] ?>"></td>
                                <td><?= $res['price'] ?></td>
                                <td><?= $res['quantity'] ?></td>
                                <td><?= $res['dateOrder'] ?></td>
                                <td>
                                    <?php
                                    if ($res['status'] == 0) echo '<span class="btn btn-warning">Pending</span>';
                                    else if ($res['status'] == 2) echo '<span class="btn btn-danger">Denied</span>';
                                    else if ($res['status'] == 3) echo '<span class="btn btn-info">Shipping</span>';
                                    else if ($res['status'] == 4) echo '<span class="btn btn-light">Completed</span>';
                                    else echo '<span class="btn btn-success">Accepted</span>';
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if ($res['status'] != 0) echo 'N/A';
                                    else {
                                    ?>
                                        <a onclick="return confirm('Do you want to delete?');" href="?ID=<?= $res['id'] ?>">Delete</a>
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
    </div>
</section>

<?php include 'inc/footer.php'; ?>