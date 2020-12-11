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
    session_start();

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
        if(isset($_SESSION['id'])) {
          $user_id = $_SESSION['id'];
        }

        if(isset($_SESSION['total'])) {
          $total = $_SESSION['total'];
        }
      ?>
      <?php

        $status = 0;
      if($_SERVER['REQUEST_METHOD'] == "POST") {

        
        $name = htmlentities($_POST['user_name'], ENT_QUOTES, 'UTF-8');
        $email = htmlentities($_POST['email'], ENT_QUOTES, 'UTF-8');
        $address = htmlentities($_POST['address'], ENT_QUOTES, 'UTF-8');
        $phone = htmlentities($_POST['phone'], ENT_QUOTES, 'UTF-8');
        $items = htmlentities($_POST['food'], ENT_QUOTES, 'UTF-8');
        $date = date('Y-m-d');

        $ins_id = rand(10000, 99999);

        $qry = "INSERT INTO orders(user_id, name, email, address, phone, total, status, date) VALUES('$user_id', '$name', '$email', '$address', '$phone', '$total', 'pending', '$date')";
        $result = mysqli_query($connection, $qry);
        if($result) { 
          $_SESSION['code'] = "ORBS_".$ins_id;
          $_SESSION['name'] = $name;
          //get all the food(s) added to cart and insert in database
          foreach($_SESSION['shopping_cart'] as $foods) {
            $sql = "INSERT INTO cart(code, food, qty, user_id) VALUES('$ins_id', '{$foods['name']}', '{$foods['quantity']}', '$user_id')";

            $save = mysqli_query($connection, $sql);
            
          }
            $_SESSION['success'] = "Successful";
            header('location: order_summary.php');
        } else {
          $_SESSION['error'] = "An error occurred";
          echo "something went wrong" . mysqli_error($connection);
          // header('location: order_summary.php');
        }
        

      }

    ?>
      <?php
        $order_id = $_SESSION['order_code'];
        // $name = $_SESSION['name'];

        unset($_SESSION['order_code']);
  
        unset($_SESSION['name']);
        
        unset($_SESSION['shopping_cart']);

      ?>
  <section class="about_part">
    <div class="container-fluid">
        <div class="row-fluid">
          <?php
            $order_code = $_SESSION['code'];
            $user = $_SESSION['name'];

          ?>
          <p>Thank you for your patronage <?php echo $user; ?>. Your <span>order number</span> is: <?php echo $order_code; ?>. Please keep your order number safe.</p>
            
        </div>
    </div>
    </section>

    <script>
      
      function add_price() {
        amount = document.getElementById('amount');
        amount = $("#amount").val();
        toInt = parseInt(amount);
        toInt = toInt + 1;
        $("#amount").val(toInt);
        price = $("#price").html();
        total_price = price * toInt;
        $("#total_price").html(total_price);

      }

      function getTotalPrice() {
        qty = $("#qty").val();
        toInt = parseInt(qty);
        
        $("#qty").val(toInt);
        price = $("#price").html();
        total_price = price * toInt;
        $("#total_price").html(total_price);
      }

    </script>

  <?php include('includes/footer.php');?>