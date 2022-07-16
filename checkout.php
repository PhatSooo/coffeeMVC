<?php
include 'inc/header.php';
?>

<?php
$get_user_info = $user->get_user(Session::get('customer_id'));

if (isset($_POST['submit']) && $_POST['house'] == '') {
  echo '<script>alert("Please Input Your House Address Before Click CheckOut Button!!!")</script>';
} else if (isset($_POST['submit']) && $_POST['optradio'] == '') {
  echo '<script>alert("Please Choose Your Payment Method Before Click CheckOut Button!!!")</script>';
} else {
  if (isset($_POST['submit']) && $_POST['optradio'] == 'offline') {
    $cus_id = Session::get('customer_id');
    $method = $_POST['optradio'];
    $cart->insertOrder($_POST, $cus_id, $method);

    $cart->del_all_data_cart();
    header('Location:order_success.php');
  }
  elseif (isset($_POST['submit']) && $_POST['optradio'] != 'offline') {
    $cus_id = Session::get('customer_id');
    $method = $_POST['optradio'];
    $cart->insertOrder($_POST, $cus_id, $method);
    $cart->del_all_data_cart();
    header('Location:order_success.php');
  }
}
?>

<!-- Replace "test" with your own sandbox Business account app client ID -->
<script src="https://www.paypal.com/sdk/js?client-id=AXXrHkt_EDi_T33WTvpZljCuiWDgOBKKeqjSHEab_kQ-_QKSfrjov5U6B6td8GviEj5X00xnFYcuAyk_&currency=USD"></script>
<!-- Set up a container element for the button -->

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
    <div class="row">
      <form method="POST" class="col-xl-8 ftco-animate">
        <div class="billing-form ftco-bg-dark p-3 p-md-5">
          <h3 class="mb-4 billing-heading">Billing Details</h3>
          <div class="row align-items-end">
            <div class="col-md-12">
              <div class="form-group">
                <label for="firstname">Your Name</label>
                <input type="text" name="name" value="<?= $get_user_info['name'] ?>" class="form-control" placeholder="">
              </div>
            </div>

            <div class="w-100"></div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="streetaddress">Your Address</label>
                <input type="text" name="house" class="form-control" placeholder="House number and street name">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <input type="text" name="address" value="<?= $get_user_info['address'] ?>" class="form-control" placeholder="Province...">
              </div>
            </div>
            <div class="w-100"></div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" name="phone" value="<?= $get_user_info['phone'] ?>" class="form-control" placeholder="">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="emailaddress">Email Address</label>
                <input type="text" name="email" disabled value="<?= $get_user_info['email'] ?>" class="form-control" placeholder="">
              </div>
            </div>
            <div class="w-100"></div>
          </div>
        </div>

        <div class="row mt-5 pt-3 d-flex">
          <div class="col-md-6 d-flex">
            <div class="cart-detail cart-total ftco-bg-dark p-3 p-md-4">
              <h3 class="billing-heading mb-4">Cart Total</h3>
              <p class="d-flex">
                <span>Subtotal</span>
                <span>$<?= Session::get('subtotal') ?></span>
              </p>
              <p class="d-flex">
                <span>Delivery</span>
                <span>$<?= Session::get('delivery') ?></span>
              </p>
              <p class="d-flex">
                <span>Discount</span>
                <span>$<?= Session::get('discount') ?></span>
              </p>
              <hr>
              <p class="d-flex total-price">
                <span>Total</span>
                <span>$<?= Session::get('total') ?></span>
              </p>
            </div>
          </div>
          <div class="col-md-6">
            <div class="cart-detail ftco-bg-dark p-3 p-md-4">
              <h3 class="billing-heading mb-4">Payment Method</h3>
              <div class="form-group">
                <div class="col-md-12">
                  <div class="radio">
                    <label><input type="radio" name="optradio" value="bank" class="mr-2"> Direct Bank Tranfer</label>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-12">
                  <div class="radio">
                    <label><input type="radio" name="optradio" value="offline" class="mr-2"> Offline Payment</label>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-12">
                  <!-- Paypal button -->
                  <div id="paypal-button-container"><input type="hidden" name="optradio" value="paypal"></div>
                </div>
              </div>
              <p><button type="submit" id="paypal" name="submit" class="btn btn-primary py-3 px-4">Place an order</button></p>
            </div>
          </div>
        </div>
      </form> <!-- END -->
      <!-- .col-md-8 -->

      <div class="col-xl-4 sidebar ftco-animate">
        <div class="sidebar-box">
          <form action="#" class="search-form">
            <div class="form-group">
              <div class="icon">
                <span class="icon-search"></span>
              </div>
              <input type="text" class="form-control" placeholder="Search...">
            </div>
          </form>
        </div>
        <div class="sidebar-box ftco-animate">
          <div class="categories">
            <h3>Categories</h3>
            <li><a href="#">Tour <span>(12)</span></a></li>
            <li><a href="#">Hotel <span>(22)</span></a></li>
            <li><a href="#">Coffee <span>(37)</span></a></li>
            <li><a href="#">Drinks <span>(42)</span></a></li>
            <li><a href="#">Foods <span>(14)</span></a></li>
            <li><a href="#">Travel <span>(140)</span></a></li>
          </div>
        </div>

        <div class="sidebar-box ftco-animate">
          <h3>Recent Blog</h3>
          <div class="block-21 mb-4 d-flex">
            <a class="blog-img mr-4" style="background-image: url(images/image_1.jpg);"></a>
            <div class="text">
              <h3 class="heading"><a href="#">Even the all-powerful Pointing has no control about the blind texts</a></h3>
              <div class="meta">
                <div><a href="#"><span class="icon-calendar"></span> July 12, 2018</a></div>
                <div><a href="#"><span class="icon-person"></span> Admin</a></div>
                <div><a href="#"><span class="icon-chat"></span> 19</a></div>
              </div>
            </div>
          </div>
          <div class="block-21 mb-4 d-flex">
            <a class="blog-img mr-4" style="background-image: url(images/image_2.jpg);"></a>
            <div class="text">
              <h3 class="heading"><a href="#">Even the all-powerful Pointing has no control about the blind texts</a></h3>
              <div class="meta">
                <div><a href="#"><span class="icon-calendar"></span> July 12, 2018</a></div>
                <div><a href="#"><span class="icon-person"></span> Admin</a></div>
                <div><a href="#"><span class="icon-chat"></span> 19</a></div>
              </div>
            </div>
          </div>
          <div class="block-21 mb-4 d-flex">
            <a class="blog-img mr-4" style="background-image: url(images/image_3.jpg);"></a>
            <div class="text">
              <h3 class="heading"><a href="#">Even the all-powerful Pointing has no control about the blind texts</a></h3>
              <div class="meta">
                <div><a href="#"><span class="icon-calendar"></span> July 12, 2018</a></div>
                <div><a href="#"><span class="icon-person"></span> Admin</a></div>
                <div><a href="#"><span class="icon-chat"></span> 19</a></div>
              </div>
            </div>
          </div>
        </div>

        <div class="sidebar-box ftco-animate">
          <h3>Tag Cloud</h3>
          <div class="tagcloud">
            <a href="#" class="tag-cloud-link">dish</a>
            <a href="#" class="tag-cloud-link">menu</a>
            <a href="#" class="tag-cloud-link">food</a>
            <a href="#" class="tag-cloud-link">sweet</a>
            <a href="#" class="tag-cloud-link">tasty</a>
            <a href="#" class="tag-cloud-link">delicious</a>
            <a href="#" class="tag-cloud-link">desserts</a>
            <a href="#" class="tag-cloud-link">drinks</a>
          </div>
        </div>

        <div class="sidebar-box ftco-animate">
          <h3>Paragraph</h3>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus itaque, autem necessitatibus voluptate quod mollitia delectus aut, sunt placeat nam vero culpa sapiente consectetur similique, inventore eos fugit cupiditate numquam!</p>
        </div>
      </div>

    </div>
  </div>
</section> <!-- .section -->


<script>
  paypal.Buttons({
    // Sets up the transaction when a payment button is clicked
    createOrder: (data, actions) => {
      return actions.order.create({
        purchase_units: [{
          amount: {
            value: <?= Session::get('total') ?> // Can also reference a variable or function
          }
        }]
      });
    },
    // Finalize the transaction after payer approval
    onApprove: (data, actions) => {
      return actions.order.capture().then(function(orderData) {
        // Successful capture! For dev/demo purposes:
        console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
        const transaction = orderData.purchase_units[0].payments.captures[0];
        alert(`Transaction ${transaction.status}: ${transaction.id}\n\nSee console for all available details`);
        var button = document.getElementById('paypal');
        button.click();

        // When ready to go live, remove the alert and show a success message within this page. For example:
        // const element = document.getElementById('paypal-button-container');
        // element.innerHTML = '<h3>Thank you for your payment!</h3>';
        // Or go to another URL:  actions.redirect('thank_you.html');
      });
    }
  }).render('#paypal-button-container');
</script>

<?php
include 'inc/footer.php';
?>