<?php
if (!isset($_GET['id'])) {
	header('Location:index.php');
}
include 'inc/header.php';
include $_SERVER['DOCUMENT_ROOT'] . '/CoffeeMVC/classes/product.php';

$id = $_GET['id'];
$prod = new Product();
$prod_byId = $prod->show_product_byProdId($id);
$rs = $prod_byId->fetch_array();
?>

<section class="home-slider owl-carousel">

	<div class="slider-item" style="background-image: url(images/bg_3.jpg);" data-stellar-background-ratio="0.5">
		<div class="overlay"></div>
		<div class="container">
			<div class="row slider-text justify-content-center align-items-center">

				<div class="col-md-7 col-sm-12 text-center ftco-animate">
					<h1 class="mb-3 mt-5 bread">Product Detail</h1>
					<p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span>Product Detail</span></p>
				</div>

			</div>
		</div>
	</div>
</section>

<section class="ftco-section">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 mb-5 ftco-animate">
				<a href="admin/uploads/<?= $rs['productImage'] ?>" class="image-popup"><img src="admin/uploads/<?= $rs['productImage'] ?>" class="img-fluid" alt="Colorlib Template"></a>
			</div>
			<div class="col-lg-6 product-details pl-md-5 ftco-animate">
				<h3><?= $rs['productName'] ?></h3>
				<p class="price"><span><?= $rs['productPrice'] ?></span></p>
				<p><?= $rs['productDesc'] ?></p>
				<p>On her way she met a copy. The copy warned the Little Blind Text, that where it came from it would have been rewritten a thousand times and everything that was left from its origin would be the word "and" and the Little Blind Text should turn around and return to its own, safe country. But nothing the copy said could convince her and so it didn’t take long until a few insidious Copy Writers ambushed her, made her drunk with Longe and Parole and dragged her into their agency, where they abused her for their.
				</p>
				<div class="row mt-4">
					<div class="col-md-6">
						<div class="form-group d-flex">
							<div class="select-wrap">
								<div class="icon"><span class="ion-ios-arrow-down"></span></div>
								<select name="" id="" class="form-control">
									<option value="">Small</option>
									<option value="">Medium</option>
									<option value="">Large</option>
									<option value="">Extra Large</option>
								</select>
							</div>
						</div>
					</div>
					<div class="w-100"></div>
					<div class="input-group col-md-6 d-flex mb-3">
						<span class="input-group-btn mr-2">
							<button type="button" class="quantity-left-minus btn" data-type="minus" data-field="">
								<i class="icon-minus"></i>
							</button>
						</span>
						<input type="text" id="quantity" name="quantity" class="form-control input-number" value="1" min="1" max="100">
						<span class="input-group-btn ml-2">
							<button type="button" class="quantity-right-plus btn" data-type="plus" data-field="">
								<i class="icon-plus"></i>
							</button>
						</span>
					</div>
				</div>
				<p><a href="cart.php" class="btn btn-primary py-3 px-5">Add to Cart</a></p>
			</div>
		</div>
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
			$prod = new Product();
			$prod_list = $prod->show_product();
			$i = 0;
			while ($result = $prod_list->fetch_array()) {
				if ($result['cateId'] == $rs['cateId']) {
			?>
					<div class="col-md-3">
						<div class="menu-entry">
							<a href="product-single.php?id=<?= $result['productId'] ?>" class="img" style="background-image: url(admin/uploads/<?= $result['productImage'] ?>);"></a>
							<div class="text text-center pt-4">
								<h3><a href="#"> <?= $result['productName'] ?> </a></h3>
								<p><?= $rs['productDesc'] ?></p>
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
	$(document).ready(function() {

		var quantitiy = 0;
		$('.quantity-right-plus').click(function(e) {

			// Stop acting like a button
			e.preventDefault();
			// Get the field name
			var quantity = parseInt($('#quantity').val());

			// If is not undefined

			$('#quantity').val(quantity + 1);


			// Increment

		});

		$('.quantity-left-minus').click(function(e) {
			// Stop acting like a button
			e.preventDefault();
			// Get the field name
			var quantity = parseInt($('#quantity').val());

			// If is not undefined

			// Increment
			if (quantity > 0) {
				$('#quantity').val(quantity - 1);
			}
		});

	});
</script>