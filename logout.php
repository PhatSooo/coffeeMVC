<?php
include 'inc/header.php';

echo session_id();
$cart->del_all_data_cart();

session_destroy();
header('Location:index.php');

include 'inc/footer.php';