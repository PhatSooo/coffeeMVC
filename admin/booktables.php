<?php
include '../lib/session.php';
Session::checkSession();
include_once '../helper/format.php';

include 'inc/header.php';
include '../classes/booktable.php';
include '../classes/table.php';
$fm = new Format();
$bt = new Booktable();
$tb = new Table();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
}
?>

<div class="page-header">
    <h3 class="page-title"> Manage Tables Page </h3>
    </nav>
</div>

<!-- <div class="container" style="padding-left: 10%">
    <div class="row">
        <div class="col-sm">
            <p style="padding-left:90%">Sort by:</p>
        </div>
        <div class="col-sm">

            <a href="products.php" class="btn btn-outline-light" style="margin-left: 10px">Clear</a>
        </div>
    </div>
</div> -->

<!-- view prods -->
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">View Tables</h4>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Item#</th>
                                <th>Cus' Name</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Phone</th>
                                <th>Message</th>
                                <th>Isset</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $list_table = $bt->show_all();
                            if ($list_table) {
                                $i = 0;
                                while ($rs = $list_table->fetch_array()) {
                                    $i++;
                            ?>
                                    <tr>
                                        <td><?php echo $i ?></td>
                                        <td><?php echo $rs['booktbName'] ?></td>
                                        <td><?php echo $rs['booktbDate'] ?></td>
                                        <td><?php echo $rs['booktbTime'] ?></td>
                                        <td><?php echo $rs['booktbPhone'] ?></td>
                                        <td><?php echo $fm->textShorten($rs['booktbMess'], 70)  ?></td>
                                        <td><?php
                                            switch ($rs['booktbIsset']) {
                                                case 0:
                                                    echo ('<button disabled class="btn btn-danger">Not Set</button>');
                                                    break;
                                                case 1;
                                                    echo ('<button disabled class="btn btn-success">Set</button>');
                                                    break;
                                            }
                                            ?></td>
                                        <td><button id="viewDetails" data-bs-toggle="modal" data-bs-target="#viewDetails<?php echo $rs['booktbId'] ?>" class="btn btn-inverse-primary">ViewDetails</button>
                                    </tr>
                                    <!-- Modal -->
                                    <form method="POST">
                                        <div class="modal fade" id="viewDetails<?php echo $rs['booktbId'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">View Book Table Order</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <input type="hidden" name="viewBTId" value="<?php echo $rs['booktbId'] ?>">
                                                        <div class="row">
                                                            <div class="col-sm">
                                                                <label for="exampleInputUsername1">Cus' Name</label>
                                                            </div>
                                                            <div class="col-9">
                                                                <input style="color: black;" name="viewBTname" value="<?php echo $rs['booktbName'] ?>" type="text" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" disabled>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm">
                                                                <label for="exampleInputUsername1">Date</label>
                                                            </div>
                                                            <div class="col-9">
                                                                <input style="color: black;" name="viewBTdate" value="<?php echo $rs['booktbDate'] ?>" type="text" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" disabled>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm">
                                                                <label for="exampleInputUsername1">Time</label>
                                                            </div>
                                                            <div class="col-9">
                                                                <input style="color: black;" name="viewBTtime" value="<?php echo $rs['booktbTime'] ?>" type="text" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" disabled>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm">
                                                                <label for="exampleInputUsername1">Phone</label>
                                                            </div>
                                                            <div class="col-9">
                                                                <input style="color: black;" name="viewBTphone" value="<?php echo $rs['booktbPhone'] ?>" type="text" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" disabled>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm">
                                                                <label for="exampleInputUsername1">Message</label>
                                                            </div>
                                                            <div class="col-9">
                                                                <textarea style="color: black; height: 150px" name="viewBTmess" type="text" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" disabled><?php echo $rs['booktbMess'] ?></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="container">
                                                            <div class="row justify-content-md-center">
                                                                <div class="col-xl" style="margin-left: 50px;">
                                                                    <div class="col-xl">
                                                                        <label style="padding-left: 35px;" for="exampleInputUsername1">Is Set?</label>
                                                                    </div>
                                                                    <div class="col-xl">
                                                                        <?php
                                                                        switch ($rs['booktbIsset']) {
                                                                            case 0:
                                                                                echo ('<a href="../classes/status.php?id=' . $rs['booktbId'] . '&status=0&page=btable" class="btn btn-danger btn-lg">Not Set</a>');
                                                                                break;
                                                                            case 1;
                                                                                echo ('<a href="../classes/status.php?id=' . $rs['booktbId'] . '&status=1&page=btable" class="btn btn-success btn-lg">Set</a>');
                                                                                break;
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl">
                                                                    <div class="col-xl">
                                                                        <label for="exampleInputUsername1">Choose Table</label>
                                                                    </div>
                                                                    <div class="col-xl">
                                                                        <select id="select" name="viewBTlist" class="js-example-basic-single">
                                                                            <?php
                                                                            $tablelist = $tb->show_all();
                                                                            if (isset($tablelist)) {
                                                                                while ($rs2 = $tablelist->fetch_array()) {
                                                                                    if ($rs2['tableStatus']) {
                                                                            ?>
                                                                                        <option style="zoom: 1.5;" <?php

                                                                                                echo 'value="' . $rs2['tableId'] . '">' . $rs2['tableName'];
                                                                                            }
                                                                                                ?></option>
                                                                                    <?php
                                                                                }
                                                                            }
                                                                                    ?>

                                                                        </select>
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
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'inc/footer.php'; ?>