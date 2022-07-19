<?php
include '../lib/session.php';
Session::checkSession();
?>

<?php
include 'inc/header.php';
include '../classes/order.php';
$order = new Order();
?>

<div class="page-header">
    <h3 class="page-title"> Manage Orders Page </h3>
</div>

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Ordered Table</h4>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Item#</th>
                                <th>OrderId</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Order Time</th>
                                <th>Total</th>
                                <th>Get Order</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 0;
                            $total = 0;
                            $get_order = $order->list_orderDetails();
                            while ($row = $get_order->fetch_assoc()) {
                                if ($row['status'] == 1) {
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
                                                    <th scope="col">Order Time</th>
                                                </tr>
                                                <?php
                                                $getBy_id = $order->getBy_id($row['orderId']);
                                                while ($res = $getBy_id->fetch_array()) {
                                                ?>
                                                    <tr>
                                                        <td><?= $res['productName'] ?></td>
                                                        <td><img src="uploads/<?= $res['image'] ?>" width="100" height="100"></td>
                                                        <td><?= $res['price'] ?></td>
                                                        <td><?= $res['quantity'] ?></td>
                                                    </tr>
                                                <?php
                                                $total +=  $res['price'] * $res['quantity'];
                                                }
                                                ?>
                                            </table>
                                        </td>
                                        <td><?= $row['dateOrder'] ?></td>
                                        <td><?= $total ?></td>
                                        <td>
                                            <?php
                                            if ($row['status'] == 0) echo '<span class="btn btn-warning">Pending</span>';
                                            else if ($row['status'] == 2) echo '<span class="btn btn-danger">Denied</span>';
                                            else if ($row['status'] == 3) echo '<span class="btn btn-info">Shipping</span>';
                                            else if ($row['status'] == 4) echo '<span class="btn btn-light">Completed</span>';
                                            else echo '<span class="btn btn-success">Accepted</span>';
                                            ?></td>
                                        <td>
                                            <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#viewDetails<?= $row['index'] ?>">View Details</a>
                                        </td>
                                    </tr>
                                    <!-- Modal -->
                                    <form method="POST">
                                        <div class="modal fade" id="viewDetails<?= $row['index'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <?php
                                                    $result = $order->list_all_orderDetails_by_orderId($row['orderId'])->fetch_array();
                                                    ?>
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">View Order Details</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <label>Customer Name: </label>
                                                        <input style="color: red;" disabled value="<?= $result['customerName'] ?>" type="text" class="form-control mb-2 mr-sm-2">

                                                        <label>Address Reciever: </label>
                                                        <input style="color: red;" disabled value="<?= $result['addressReceiver'] ?>" type="text" class="form-control mb-2 mr-sm-2">

                                                        <label>Customer Phone: </label>
                                                        <input style="color: red;" disabled value="<?= $result['phone'] ?>" type="text" class="form-control mb-2 mr-sm-2">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a href="../classes/status.php?page=ship&status=null&id=<?= $row['orderId'] ?>" type="submit" class="btn btn-info">Ship</a>
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="closebtn">Close</button>
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

<?php include 'inc/footer.php'; ?>