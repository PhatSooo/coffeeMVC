<?php
include 'inc/header.php';
?>

<section class="home-slider owl-carousel">
	<div class="slider-item" style="background-image: url(images/bg_3.jpg);" data-stellar-background-ratio="0.5">
		<div class="overlay"></div>
		<div class="container">
			<div class="row slider-text justify-content-center align-items-center">

				<div class="col-md-7 col-sm-12 text-center ftco-animate">
					<h1 class="mb-3 mt-5 bread">Order Online</h1>
					<p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span>Shop</span></p>
				</div>

			</div>
		</div>
	</div>
</section>


<section class="ftco-menu mb-5 pb-5">
	<div class="container">
		<div class="row d-md-flex">
			<div class="col-lg-12 ftco-animate p-md-5">
				<div class="row">
					<div class="col-md-12 nav-link-wrap mb-5">
						<div class="nav ftco-animate nav-pills justify-content-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">
							<a class="nav-link active" id="v-pills-0-tab" data-toggle="pill" href="#v-pills-0" role="tab" aria-controls="v-pills-0" aria-selected="true">Coffee</a>

							<a class="nav-link" id="v-pills-1-tab" data-toggle="pill" href="#v-pills-1" role="tab" aria-controls="v-pills-1" aria-selected="false">Main Dish</a>

							<a class="nav-link" id="v-pills-2-tab" data-toggle="pill" href="#v-pills-2" role="tab" aria-controls="v-pills-2" aria-selected="false">Drinks</a>

							<a class="nav-link" id="v-pills-3-tab" data-toggle="pill" href="#v-pills-3" role="tab" aria-controls="v-pills-3" aria-selected="false">Desserts</a>
						</div>
					</div>
					<div class="col-md-12 d-flex align-items-center">

						<div class="tab-content ftco-animate" id="v-pills-tabContent">

							<div class="tab-pane fade show active" id="v-pills-0" role="tabpanel" aria-labelledby="v-pills-0-tab">
								<div class="row">
									<?php
									$prod_list = $prod->show_product();
									while ($rs = $prod_list->fetch_array()) {
										if ($rs['cateId'] == 75) {
									?>
											<div class="col-md-3">
												<div class="menu-entry">
													<a href="#" class="img" style="background-image: url(admin/uploads/<?= $rs['productImage'] ?>);"></a>
													<div class="text text-center pt-4">
														<h3><a href="#"> <?= $rs['productName'] ?> </a></h3>
														<p><?= $rs['productDesc'] ?></p>
														<p class="price"><span>$<?= $rs['productPrice'] ?> </span></p>
														<p><a href="product-single.php?id=<?= $rs['productId'] ?>" class="btn btn-primary btn-outline-primary">Add to Cart</a></p>
													</div>
												</div>
											</div>
									<?php
										}
									}
									?>
								</div>
							</div>

							<div class="tab-pane fade" id="v-pills-1" role="tabpanel" aria-labelledby="v-pills-1-tab">
								<div class="row">
									<?php
									$prod_list = $prod->show_product();
									while ($rs = $prod_list->fetch_array()) {
										if ($rs['cateId'] == 2) {
									?>
											<div class="col-md-4 text-center">
												<div class="menu-wrap">
													<a href="#" class="menu-img img mb-4" style="background-image: url(admin/uploads/<?= $rs['productImage'] ?>);"></a>
													<div class="text text-center pt-4">
														<h3><a href="#"> <?= $rs['productName'] ?> </a></h3>
														<p><?= $rs['productDesc'] ?></p>
														<p class="price"><span>$<?= $rs['productPrice'] ?> </span></p>
														<p><a href="product-single.php?id=<?= $rs['productId'] ?>" class="btn btn-primary btn-outline-primary">Add to Cart</a></p>
													</div>
												</div>
											</div>
									<?php
										}
									}
									?>
								</div>
							</div>

							<div class="tab-pane fade" id="v-pills-2" role="tabpanel" aria-labelledby="v-pills-2-tab">
								<div class="row">
									<?php
									$prod_list = $prod->show_product();
									while ($rs = $prod_list->fetch_array()) {
										if ($rs['cateId'] == 3) {
									?>
											<div class="col-md-4 text-center">
												<div class="menu-wrap">
													<a href="#" class="menu-img img mb-4" style="background-image: url(admin/uploads/<?= $rs['productImage'] ?>);"></a>
													<div class="text text-center pt-4">
														<h3><a href="#"> <?= $rs['productName'] ?> </a></h3>
														<p><?= $rs['productDesc'] ?></p>
														<p class="price"><span>$<?= $rs['productPrice'] ?> </span></p>
														<p><a href="product-single.php?id=<?= $rs['productId'] ?>" class="btn btn-primary btn-outline-primary">Add to Cart</a></p>
													</div>
												</div>
											</div>
									<?php
										}
									}
									?>
								</div>
							</div>

							<div class="tab-pane fade" id="v-pills-3" role="tabpanel" aria-labelledby="v-pills-3-tab">
								<div class="row">
								<?php
									$prod_list = $prod->show_product();
									while ($rs = $prod_list->fetch_array()) {
										if ($rs['cateId'] == 9) {
									?>
											<div class="col-md-4 text-center">
												<div class="menu-wrap">
													<a href="#" class="menu-img img mb-4" style="background-image: url(admin/uploads/<?= $rs['productImage'] ?>);"></a>
													<div class="text text-center pt-4">
														<h3><a href="#"> <?= $rs['productName'] ?> </a></h3>
														<p><?= $rs['productDesc'] ?></p>
														<p class="price"><span>$<?= $rs['productPrice'] ?> </span></p>
														<p><a href="product-single.php?id=<?= $rs['productId'] ?>" class="btn btn-primary btn-outline-primary">Add to Cart</a></p>
													</div>
												</div>
											</div>
									<?php
										}
									}
									?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<?php
include 'inc/footer.php';
?>