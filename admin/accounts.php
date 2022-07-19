<?php
include '../lib/session.php';
session_start();
// Session::checkSession();
?>
<?php include 'inc/header.php'; ?>
<?php
include '../classes/admin.php';
$admin = new Admin();
include '../classes/user.php';
$user = new User();
?>

<?php
#del admin account
if (isset($_GET['delAd'])) {
    $res = $admin->del_acc($_GET['delAd']);
    if ($res)
        echo '<script>window.location = "../admin/accounts.php?page=0"</script>';
}
#del customer account
if (isset($_GET['delCus'])) {
    $res = $user->del_acc($_GET['delCus']);
    if ($res)
        echo '<script>window.location = "../admin/accounts.php?page=1"</script>';
}
?>

<div class="page-header">
    <h3 class="page-title"> Manage Accounts Page </h3>
</div>

<div class="container" style="padding-left: 10%">
    <div class="row">
        <div class="col-sm">
            <p style="padding-left:90%">Sort by:</p>
        </div>
        <div class="col-sm">
            <a href="?page=0" class="btn btn-outline-light" style="margin-left: 10px">Admin Accounts</a>
            <a href="?page=1" class="btn btn-outline-light" style="margin-left: 10px">Customer Accounts</a>
            <a href="?page=2" class="btn btn-outline-light" style="margin-left: 10px">Shipper Accounts</a>
            <a href="accounts.php" class="btn btn-outline-light" style="margin-left: 10px">Clear</a>
        </div>
    </div>
</div>

<?php
if (isset($_GET['page'])) {
    if ($_GET['page'] == 0) {
        $list = $admin->list_all();
        $i = 0;
?>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Admin Accounts Table</h4>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Item#</th>
                                        <th>Name</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Remove</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while ($res = $list->fetch_array()) {
                                        if ($res['isAdmin'] == 1) {
                                            $i++;
                                    ?>

                                            <tr>
                                                <td><?= $i ?></td>
                                                <td><?= $res['adminName'] ?></td>
                                                <td><?= $res['adminUser'] ?></td>
                                                <td><?= $res['adminEmail'] ?></td>
                                                <td>
                                                    <?php
                                                    if ($res['status'])
                                                        echo '<a href="../classes/status.php?id=' . $res['adminId'] . '&status=1&page=accountsAD" class="btn btn-success">Active</a>';
                                                    else echo '<a href="../classes/status.php?id=' . $res['adminId'] . '&status=0&page=accountsAD" class="btn btn-danger">Inactive</a>'
                                                    ?>
                                                </td>
                                                <td><a onclick="return confirm('Are you sure to delete this item?')" href="?delAd=<?= $res['adminId'] ?>" class="btn btn-info">Remove</a></td>
                                            </tr>


                                    <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    } elseif ($_GET['page'] == 1) {
        $list = $user->list_all();
        $i = 0;
    ?>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Customer Accounts Table</h4>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Item#</th>
                                        <th>Name</th>
                                        <th>Username</th>
                                        <th>Address</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Remove</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while ($res = $list->fetch_array()) {
                                        $i++;
                                    ?>

                                        <tr>
                                            <td><?= $i ?></td>
                                            <td><?= $res['name'] ?></td>
                                            <td><?= $res['username'] ?></td>
                                            <td><?= $res['address'] ?></td>
                                            <td><?= $res['phone'] ?></td>
                                            <td><?= $res['email'] ?></td>
                                            <td>
                                                <?php
                                                if ($res['status'])
                                                    echo '<a href="../classes/status.php?id=' . $res['id'] . '&status=1&page=accountsCUS" class="btn btn-success">Active</a>';
                                                else echo '<a href="../classes/status.php?id=' . $res['id'] . '&status=0&page=accountsCUS" class="btn btn-danger">Inactive</a>'
                                                ?>
                                            </td>
                                            <td><a onclick="return confirm('Are you sure to delete this item?')" href="?delCus=<?= $res['id'] ?>" class="btn btn-info">Remove</a></td>
                                        </tr>

                                    <?php
                                    }
                                    ?>
                                </tbody>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    } elseif ($_GET['page'] == 2) {
        $list = $admin->list_all();
        $i = 0;
    ?>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Shipper Accounts Table</h4>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Item#</th>
                                        <th>Name</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Remove</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while ($res = $list->fetch_array()) {
                                        if ($res['isAdmin'] == 0) {
                                            $i++;
                                    ?>

                                            <tr>
                                                <td><?= $i ?></td>
                                                <td><?= $res['adminName'] ?></td>
                                                <td><?= $res['adminUser'] ?></td>
                                                <td><?= $res['adminEmail'] ?></td>
                                                <td>
                                                    <?php
                                                    if ($res['status'])
                                                        echo '<a href="../classes/status.php?id=' . $res['adminId'] . '&status=1&page=accountsAD" class="btn btn-success">Active</a>';
                                                    else echo '<a href="../classes/status.php?id=' . $res['adminId'] . '&status=0&page=accountsAD" class="btn btn-danger">Inactive</a>'
                                                    ?>
                                                </td>
                                                <td><a onclick="return confirm('Are you sure to delete this item?')" href="?delAd=<?= $res['adminId'] ?>" class="btn btn-info">Remove</a></td>
                                            </tr>

                                    <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
    }
} else {
    echo '<br><h1 style="text-align:center;color: lawngreen">Choose 1 Accounts Type to View</h1>';
    include 'inc/footer.php';
}
?>