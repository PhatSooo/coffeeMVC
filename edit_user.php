<?php include 'inc/header.php'; ?>

<?php
if (!Session::get('customer_login')) {
    header('Location:login.php');
}

$cus_id = Session::get('customer_id');
$get_cus = $user->get_user($cus_id);
if (isset($_POST['submit'])) {
    $update = $user->update_cus($_POST, Session::get('customer_id'));
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
        <h1 style="text-align: center;">Edit Your Information</h1>
        <?php
        if (isset($update)) {
            echo '<h4 style="text-align: center;">' . $update . '</h4>';
        }
        ?>
        <form method="POST">
            <div class="form-group">
                <label for="usr">Name:</label>
                <input name="name" type="text" value="<?= isset($_POST['submit']) ? $_POST['name'] : $get_cus['name'] ?>" class="form-control" id="usr">
            </div>
            <div class="form-group">
                <label for="usr">Address:</label>
                <input name="address" type="text" value="<?= isset($_POST['submit']) ? $_POST['address'] : $get_cus['address'] ?>" class="form-control" id="usr">
            </div>
            <div class="form-group">
                <label for="usr">Phone:</label>
                <input name="phone" type="text" value="<?= isset($_POST['submit']) ? $_POST['phone'] : $get_cus['phone'] ?>" class="form-control" id="usr">
            </div>
            <div class="form-group">
                <label for="usr">Email:</label>
                <input name="email" type="text" value="<?= isset($_POST['submit']) ? $_POST['email'] : $get_cus['email'] ?>" class="form-control" id="usr">
            </div>
            <div style="text-align: center;" class="form-group">
                <button name="submit" style="height: 60px; width: 250px;" class="btn btn-primary" type="submit"><span style="font-size: 30px;">Save Changes</span></button>
            </div>
        </form>
    </div>
</section>

<?php include 'inc/footer.php'; ?>