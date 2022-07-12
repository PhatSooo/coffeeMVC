<?php
include 'inc/header.php';

if (!Session::get('customer_login')){
	header('Location:login.php');
}

if (isset($_GET['cartid'])) {
	$del_cart = $cart->del_cart($_GET['cartid']);
}

if (isset($_POST['quantity'])) {
	if ($_POST['quantity'] <= 0) {
		$del_cart = $cart->del_cart($_POST['cartid']);
	} else $change_quantity = $cart->change_quantity($_POST['cartid'], $_POST['quantity']);
}
?>

<section class="home-slider owl-carousel">
	<div class="slider-item" style="background-image: url(images/bg_3.jpg);" data-stellar-background-ratio="0.5">
		<div class="overlay"></div>
		<div class="container">
			<div class="row slider-text justify-content-center align-items-center">
				<div class="col-md-7 col-sm-12 text-center ftco-animate">
					<h1 class="mb-3 mt-5 bread">Cart</h1>
					<p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span>Cart</span></p>
				</div>

			</div>
		</div>
	</div>
</section>

<section class="ftco-section ftco-cart">
	<div class="container">
		<div class="row">
			<?php
			if (isset($del_cart)) {
				echo $del_cart;
			}
			?>
			<div class="col-md-12 ftco-animate">
				<div class="cart-list">
					<table class="table">
						<thead class="thead-primary">
							<tr class="text-center">
								<th>&nbsp;</th>
								<th>&nbsp;</th>
								<th>Product</th>
								<th>Price</th>
								<th>Quantity</th>
								<th>Size</th>
								<th>Total</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$get_cart_list = $cart->show_cart();
							$quantity = 0;
							if ($get_cart_list) {
								$subtotal = 0;
								$delivery = 0;
								$discount = 3;
								while ($rs = $get_cart_list->fetch_array()) {
							?>
									<tr class="text-center">
										<td class="product-remove"><a href="?cartid=<?= $rs['cartId'] ?>"><span class="icon-close"></span></a></td>

										<td class="image-prod">
											<div class="img" style="background-image:url(admin/uploads/<?= $rs['image'] ?>);"></div>
										</td>

										<td class="product-name">
											<h3><?= $rs['productName'] ?></h3>
											<p>Far far away, behind the word mountains, far from the countries</p>
										</td>

										<td class="price">$<?= $rs['price'] ?></td>

										<td class="quantity">
											<form method="POST">
												<input type="hidden" name="cartid" value="<?= $rs['cartId'] ?>">
												<div class="input-group mb-3">
													<input onchange="changeQuantity(this.value)" type="text" name="quantity" class="quantity form-control input-number" value="<?= $rs['quantity'] ?>" min="1" max="100">
												</div>
											</form>
										</td>
										<td class="price"><?= $rs['size'] ?></td>
										<td class="total">$
											<?php
											switch ($rs['size']) {
												case 'Small':
													echo $total = $rs['price'] * $rs['quantity'];
													break;
												case 'Medium':
													echo $total = $rs['price'] * $rs['quantity'] + 1;
													break;
												case 'Large':
													echo $total = $rs['price'] * $rs['quantity'] + 2;
													break;
												case 'ExtraLarge':
													echo $total = $rs['price'] * $rs['quantity'] + 3;
													break;
											}
											?></td>
									</tr><!-- END TR-->
							<?php
									$subtotal += $total;
									$quantity += $rs['quantity'];
								}
							}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<?php
		$check_cart = $cart->check_cart();
		if ($check_cart) {
		?>
			<div class="row justify-content-end">
				<div class="col col-lg-3 col-md-6 mt-5 cart-wrap ftco-animate">
					<div class="cart-total mb-3">
						<h3>Cart Totals</h3>
						<p class="d-flex">
							<span>Subtotal</span>
							<span>$<?= $subtotal ?></span>
						</p>
						<p class="d-flex">
							<span>Delivery</span>
							<span>$<?= $delivery ?></span>
						</p>
						<p class="d-flex">
							<span>Discount</span>
							<span>$<?= $discount ?></span>
						</p>
						<hr>
						<p class="d-flex total-price">
							<span>Total</span>
							<span>$<?= $total = $subtotal + $delivery - $discount ?></span>
						</p>
					</div>
					<p class="text-center"><a href="checkout.php" class="btn btn-primary py-3 px-4">Proceed to Checkout</a></p>
				</div>
			</div>
			<?= Session::set('qty', $quantity) ?>
			<?php 
				Session::set('subtotal',$subtotal);
				Session::set('delivery',$delivery);
				Session::set('discount',$discount);
				Session::set('total',$total);
			?>
		<?php
		} else {
			Session::set('qty', $quantity);
			echo '<span class="text-info">Your Cart is empty, please buy something and back here to see</span>';
		}
		?>

	</div>
</section>

<section class="ftco-section">
	<div class="container">
		<div class="row justify-content-center mb-5 pb-3">
			<div class="col-md-7 heading-section ftco-animate text-center">
				<span class="subheading">Discover</span>
				<h2 class="mb-4">Related products</h2>
				<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
			</div>
		</div>
		<div class="row">
			<?php
			$prod_list = $prod->show_product();
			$i = 0;
			while ($result = $prod_list->fetch_array()) {
				if ($result['cateId'] == 75) {
			?>
					<div class="col-md-3">
						<div class="menu-entry">
							<a href="product-single.php?id=<?= $result['productId'] ?>" class="img" style="background-image: url(admin/uploads/<?= $result['productImage'] ?>);"></a>
							<div class="text text-center pt-4">
								<h3><a href="#"> <?= $result['productName'] ?> </a></h3>
								<p><?= $result['productDesc'] ?></p>
								<p class="price"><span>$<?= $result['productPrice'] ?> </span></p>
								<p><a href="product-single.php?id=<?= $result['productId'] ?>" class="btn btn-primary btn-outline-primary">Add to Cart</a></p>
							</div>
						</div>
					</div>
			<?php
					$i++;
				}
				if ($i == 4) break;
			}
			?>
		</div>
	</div>
</section>

<?php
include 'inc/footer.php';
?>

<script>
	function changeQuantity(val) {
		$.ajax({
			url: 'cart.php',
			type: 'POST'
		});
	}
</script>