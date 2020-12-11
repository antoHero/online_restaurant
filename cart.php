<?php include('includes/header.php');?>
    <!-- Header part end-->
    
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>ORBS</title>
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
    
      
  <section class="about_part">
    <div class="container-fluid">
      <div class="text-center">
        
        <h2>Cart</h2>
        <p class="lead">Inspect Your Cart.</p>
        
      </div>
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


        if(isset($_GET['fid'])) {
          $fid = $_GET['fid'];
        }

        if(isset($_POST['action']) && $_POST['action'] == 'remove') {
          if(!empty($_SESSION['shopping_cart'])) {
            foreach($_SESSION['shopping_cart'] as $key => $value) {
              if($_POST['code'] == $key) {
                unset($_SESSION['shopping_cart'][$key]);
                echo "<p class='alert alert-danger text-center'>Food has been removed from your cart!</p>";
              } 
              if(empty($_SESSION['shopping_cart'])) 
                unset($_SESSION['shopping_cart']);
            }
          }
        }

        if(isset($_POST['action']) && $_POST['action'] == 'change') {
          foreach($_SESSION['shopping_cart'] as &$value) {
            if($value['code'] === $_POST['code']) {
              $value['quantity'] = $_POST['quantity'];
              break; //stop the loop when food is found
            }
          }
        }

        if(isset($_GET['action']) && $_GET['id'] !="") {
          if($_GET['action'] == "delete") {
            $item_to_remove = $_GET['id'];
            foreach($_SESSION['shopping_cart'] as $keys => $values) {
              if($values['id'] == $_GET['id']) {
                unset($_SESSION['shopping_cart'][$keys]);
                echo "<p class='alert alert-success text-center'>Item Removed</p>";
                header('location: cart.php');
              }
            }
          }
        }

        //empty cart
        if(isset($_GET['action'])) {
          if($_GET['action'] == "empty") {
            unset($_SESSION['shopping_cart']);
          }
        }
      ?>
      <br>
      <?php 
            if(!empty($_SESSION['shopping_cart'])) {


          ?>
          <?php echo $msg; ?>
          <a id="btnEmpty" href="cart.php?action=empty" align="right" type="submit" class="btn btn-danger">Empty Cart <br /></a> 
      <?php } else { echo ""; }?>
      <p></p>
        <br>
        <?php
          if(isset($_SESSION['shopping_cart'])) {
            $total_price = 0;
          
        ?>
        <table class="table table" style="padding-top: 15px;">
          <tbody>
            <tr>
              <td></td>
              <td>Name</td>
              <td>Quantity</td>
              <td>Unit Price</td>
              <td>Cost</td>
              <td>Action</td>
            </tr>
            <?php
            foreach($_SESSION['shopping_cart'] as $product) {
              $id = $product['id'];
              $result = mysqli_query($connection, "SELECT * FROM food WHERE id='$id'");
              while($row = mysqli_fetch_assoc($result)) {
                $foodname = $row['name'];
                $price = $row['cost'];
              }
            ?>
            <tr>
              <td><img src='orbs_admin/<?php echo $product['image'];?>' width="50" height="50"></td>
              <td><?php echo $product['name'];?><br/ >
                <form method="post" action="">
                  <input type="hidden" name="code" value="<?php echo $product['code']; ?>">
                  <input type="hidden" name="action" value="remove">
                  <button type="submit">Remove</button>
                </form>
              </td>
              <td>
                <form method="post" action="">
                  <input type="hidden" name="code" value="<?php echo $product['code']?>">
                  <input type="hidden" name="action" value="change">
                  <select name="quantity" class="form-group" onchange="this.form.submit()">
                    <option <?php if($product['quantity']==1) echo "selected";?> value="1">1</option>
                    <option <?php if($product['quantity']==2) echo "selected";?> value="2">2</option>
                    <option <?php if($product['quantity']==3) echo "selected";?> value="3">3</option>
                    <option <?php if($product['quantity']==4) echo "selected";?> value="4">4</option>
                    <option <?php if($product['quantity']==5) echo "selected";?> value="5">5</option>
                  </select>
                </form>
              </td>
              <td><?php echo "#" .$product['price'];?></td>
              <td><?php echo "#" .$product['price'] * $product['quantity'];?></td>
              <td><a href="cart.php?action=delete&id=<?php echo $product['id'];?>">Remove All With Same Code</a></td>
            </tr>
            <?php
              $total_price += ($product['price']*$product['quantity']);
              $_SESSION['total'] = $total_price;
            }
            ?>
            <tr>
              <td colspan="6" align="right">Total: <?php echo "#".$total_price;?></td>
            </tr>
          </tbody>
        </table>
        <?php
        } else {
          echo "<p class='alert alert-danger'>Your Cart is empty</p>";
        }
        ?>

        <form>

          <input type="hidden" name="hiden_total" value="<?php echo $total_price;?>">
          <input type="hidden" name="checkoutFood" value="<?php echo $product_id_array;?>">
          <input type="hidden" name="quantity" value="<?php echo $product['quantity'];?>">
          <?php 
            if(!empty($_SESSION['shopping_cart'])) {


          ?>
          <a href="checkout.php?order=<?php echo $id; ?>" type="submit" name="add_to_cart" class="genric-btn primary circle arrow">Checkout</a>
        <?php } else { echo ""; }?>
        </form>

      
        </div>
    </div>
        
  </section>

    <script>

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