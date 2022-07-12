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
                                <th>Product Name</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Date Order</th>
                                <th>Status</th>
                                <th>Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $get_list = $order->list_all_order();
                            $i = 0;
                            while ($res = $get_list->fetch_array()) {
                                $i++;
                            ?>
                                <tr>
                                    <td><?php echo $i ?></td>
                                    <td><?php echo $res['productName'] ?></td>
                                    <td><?php echo $res['quantity'] ?></td>
                                    <td><?php echo $res['price'] ?></td>
                                    <td><?php echo $res['dateOrder'] ?></td>
                                    <td>
                                        <?php
                                        if ($res['status'] == 0)
                                            echo '<a href="../classes/status.php?page=orders&status=0&id=' . $res['id'] . '" class="btn btn-warning">Pending</a>';
                                        else if ($res['status'] == 2)
                                            echo '<a href="../classes/status.php?page=orders&status=2&id=' . $res['id'] . '" class="btn btn-danger">Deny</a>';
                                        else if ($res['status'] == 3)
                                            echo '<a class="btn btn-info">Shipping</a>';
                                        else if ($res['status'] == 4)
                                            echo '<a class="btn btn-light">Completed</a>';
                                        else echo '<a href="../classes/status.php?page=orders&status=1&id=' . $res['id'] . '" class="btn btn-success">Accepted</a>';
                                        ?>
                                    </td>
                                    <td><a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#viewDetails<?php echo $res['id'] ?>">View Details</a></td>
                                </tr>

                                <!-- Modal -->
                                <form action="cateedit.php" method="POST">
                                    <div class="modal fade" id="viewDetails<?php echo $res['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <?php
                                                $result = $order->list_all_orderDetails_by_orderId($res['id'])->fetch_array();
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
                                                    <a <?php if ($res['status'] != 1) echo 'style="pointer-events: none;"'; ?> href="../classes/status.php?page=ship&status=null&id=<?= $res['id'] ?>" type="submit" class="btn btn-info">Ship</a>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="closebtn">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            <?php
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