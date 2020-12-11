<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>ORBS Checkout</title>
    <link rel="icon" href="img/favicon.png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- animate CSS -->
    <link rel="stylesheet" href="css/animate.css">
    <!-- owl carousel CSS -->
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <!-- themify CSS -->
    <link rel="stylesheet" href="css/themify-icons.css">
    <!-- flaticon CSS -->
    <link rel="stylesheet" href="css/flaticon.css">
    <!-- font awesome CSS -->
    <link rel="stylesheet" href="css/magnific-popup.css">
    <!-- swiper CSS -->
    <link rel="stylesheet" href="css/slick.css">
    <link rel="stylesheet" href="css/gijgo.min.css">
    <link rel="stylesheet" href="css/nice-select.css">
    <link rel="stylesheet" href="css/all.css">
    <!-- style CSS -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!--::header part start::-->
    <?php include('includes/header.php');?>
    <!-- Header part end-->
    <?php 
      define('DB_HOST', '127.0.0.1');
      define('DB_USER', 'root');
      define('DB_PASSWORD', 'secret');
      define('DB_NAME', 'orbs');

      $connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
      if(!$connection):
          echo "Failed Connection!!! " . mysqli_connect_errno() ."<br> " . mysqli_connect_error();
      endif;
      ?>
      <?php
        $user_id = $_SESSION['id'];
        $foods = $_SESSION['shopping_cart'];
        // echo $user_id;

        $total = $_SESSION['total'];
        // echo $total;
      ?>
      <?php



      ?>
  <section class="about_part">
    <div class="container-fluid">
        <div class="row-fluid">
          
            <div class="col-md-6">
              <table class="table">
                    <thead>
                      <tr>
                        <th>Food items</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>Total</th>

                      </tr>
                      </thead>
                      <tbody>
              <?php
                foreach ($_SESSION['shopping_cart'] as $foods) {
                  echo "
                      
                        <tr>
                          <td>".$foods['name']."</td>
                          <td>".$foods['quantity']."</td>
                          <td>".$foods['price']."</td>
                          <td>".$foods['price']*$foods['quantity']."</td>
                        </tr>
                      
                    
                  ";  

                  

                }
                

              ?>
              <tr>
                <td colspan="4" align="right"><?php if(isset($_SESSION['total'])){echo "Grand Total: " .$_SESSION['total'];} else {echo "nil";} ?>

                </td>
              </tr>
              </tbody>
              </table>
              <div class="py-5 text-center">
    
    <h2>Checkout your order</h2>
    <p class="lead">Fill the form below to complete your order.</p>
  </div>
  <div class="card">
    <div class="card-header">
      <h4 class="card-title">Place order</h4>
    </div>
    <div class="card-body">

      

    <div class="widget-box">
        <form class="" action="order_summary.php" method="POST">
            <div class="form-group">
              <label for="exampleFormControlInput1"> Name </label>
              <input type="text" class="form-control" id="category_name" name="user_name" placeholder="Enter Your Name">
              <label for="priceOfFood"> Email Address </label>
              <input type="email" class="form-control" id="" name="email" placeholder="Enter your email address">
              <label for="foodDescription">Enter Shipping Address</label>
              <textarea class="form-control" name="address" placeholder="Enter your Shipping address"></textarea>
              <label for="category_name">Phone Number</label>
              <input type="text" class="form-control" name="phone" placeholder="Enter your phone Number">
              <input type="hidden" name="items" value="<?php echo $foods['name'];?>">
              <input type="hidden" name="grand_total" value="<?php $_SESSION['total'];?>">
              <input type="hidden" name="user" value="<?php echo $user_id;?>">
            </div>
            <button class="btn btn-success form-control" type="submit" name="submit">Place Order</button>
          </form>
    </div>
    </div>
  </div>
                        
                    </div>
                </div>
            </div>
    </section>


  <?php include('includes/footer.php');?>