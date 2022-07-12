<?php
include 'lib/session.php';
Session::init();

include_once 'lib/database.php';
include_once 'helper/format.php';

spl_autoload_register(function ($className) {
    include_once 'classes/' . $className . '.php';
});

$db = new Database();
$user = new User();
$cate = new Category();
$prod = new Product();
$cart = new Cart();
$bt = new Booktable();
$order = new Order();

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Coffee - Free Bootstrap 4 Template by Colorlib</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans:400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Great+Vibes" rel="stylesheet">

    <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">

    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">

    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/ionicons.min.css">

    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">


    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="css/style.css">

</head>

<?php $page = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'], "/") + 1); ?>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
        <div class="container">
            <a class="navbar-brand" href="index.php">Coffee<small>Blend</small></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="oi oi-menu"></span> Menu
            </button>
            <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item <?= $page == 'index.php' ? 'active' : '' ?>"><a href="index.php" class="nav-link">Home</a></li>
                    <li class="nav-item <?= $page == 'menu.php' ? 'active' : '' ?>"><a href="menu.php" class="nav-link">Menu</a></li>
                    <li class="nav-item <?= $page == 'shop.php' ? 'active' : '' ?>"><a href="shop.php" class="nav-link">Order Online</a></li>
                    <li class="nav-item <?= $page == 'services.php' ? 'active' : '' ?>"><a href="services.php" class="nav-link">Services</a></li>
                    <li class="nav-item <?= $page == 'blog.php' ? 'active' : '' ?>"><a href="blog.php" class="nav-link">Blog</a></li>
                    <li class="nav-item <?= $page == 'about.php' ? 'active' : '' ?>"><a href="about.php" class="nav-link">About</a></li>
                    <li class="nav-item <?= $page == 'contact.php' ? 'active' : '' ?>"><a href="contact.php" class="nav-link">Contact</a></li>
                    <li class="nav-item cart"><a href="cart.php" class="nav-link"><span class="icon icon-shopping_cart"></span><span class="bag d-flex justify-content-center align-items-center"><small><?= Session::get('qty') == 0 ? 0 : Session::get('qty') ?></small></span></a></li>
                    <?php
                    if (Session::get('customer_login') == null) {
                        echo '<li class="nav-item cart"><a href="login.php" class="nav-link"><span class="icon icon-user"></span></a></li>';
                    } else {
                    ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link" id="profileDropdown" href="#" data-bs-toggle="dropdown">
                                <div class="navbar-profile">
                                    <span class="icon icon-user"></span>
                                    <p class="mb-0 d-none d-sm-block navbar-profile-name"><?= Session::get('customer_name') ?></p>
                                </div>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="profileDropdown">
                                <a class="dropdown-item" href="edit_user.php">Edit Info</a>
                                <a class="dropdown-item" href="ordered.php">View Ordered</a>
                                <a class="dropdown-item" href="logout.php">Logout</a>
                            </div>
                        </li>
                    <?php
                    }
                    ?>

                </ul>
            </div>
        </div>
    </nav>