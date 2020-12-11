
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
    <style type="text/css">
      #btnEmpty {
        background-color: #ffffff;
        border: #d00000 1px solid;
        padding: 5px 10px;
        color: #d00000;
        float: right;
        text-decoration: none;
        border-radius: 3px;
        margin: 10px 0px;
      }
    </style>
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

          $name = "";
          $description = "";
          $price = "";
          $category = "";
          $id = "";
          $user_id = $_SESSION['id'];
          
          

          if($_SERVER['REQUEST_METHOD'] == 'GET') {

            if(isset($_GET['fid']) && preg_replace("#[^0-9]#", "", $_GET['fid']) != "") {

              $fid = preg_replace("#[^0-9]#", "", $_GET['fid']);
              $user_id = $_SESSION['id'];

              if($fid != "") {
                $qry = "SELECT * FROM food WHERE id='$fid' LIMIT 1";
                $result = mysqli_query($connection, $qry);
                if(mysqli_num_rows($result) == 1) {
                  // $cart = $_SESSION['shopping_cart'];
                  while($row = mysqli_fetch_assoc($result)) {
                    $id = $row['id'];
                    $name = $row['name_of_food'];
                    $price = $row['cost'];
                    $description = $row['description'];
                    $image = $row['image'];
                    $code = $row['code'];
                    $category = $row['category'];
                  }
                } else {
                  echo "string";
                  // header('location: index.php');
                }
              } 
            } else {
              echo "2 strings";
              // header('location: index.php');
            }
        }    

        if(isset($_POST['code']) && $_POST['code'] != "") {
          $code = $_POST['code'];
          $cartArray = array(
            $code = array(
              'name_of_food'=>$name,
              'code'=>$code,
              'cost'=>$price,
              'image'=>$image,
              'category'=>$category,
              'description'=>$description,
              'quantity'=>1
            )
          );

          if(empty($_SESSION['shopping_cart'])) {
            $_SESSION['shopping_cart'] = $cartArray;
            echo "<p class='alert alert-success'>Food Added To Cart!</p>"; 
          } else {
            $array_keys = array_keys($_SESSION['shopping_cart']);
            if(in_array($code, $array_keys)) {
              echo "<p class='alert alert-danger'>Food is already in your cart</p>";
            } else {
              $_SESSION['shopping_cart'] = array_merge($_SESSION['shopping_cart'], $cartArray);
              echo "<p class='alert alert-success'>Food added to your cart!</p>";
            }
          }
        }             
      ?>
    
      
  <section class="about_part">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-4 col-lg-5 offset-lg-1">
                    <div class="about_img">
                        <img src="orbs_admin/<?php echo $image; ?>" alt="<?php echo $name; ?>" width='400px' height='500px'>
                    </div>
                </div>
                <div class="col-sm-8 col-lg-4">
                    <div class="about_text">
                        
                        <form action="" method=POST>
                          <input type="hidden" name="code" value="<?php echo $code;?>">
                          <h5>Food Details</h5>
                          <h2><?php echo $user_id; ?>.</h2>
                          <h2><?php echo $name; ?>.</h2>
                          <p><?php echo $description; ?> </p>
                          <h4>Category: <?php echo $category; ?></h4>
                          <h4>Price: #<span id="price"><?php echo $price; ?></span></h4>
                          <!-- <p><span class="bold_desc">Quantity:</span></p>
                          <div class="input-group mb-3">
                          <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                            <div class="btn-group mr-2" role="group" aria-label="First group">
                              <button class="btn btn-danger" onclick="subtract_price()" type="button">-</button>
                            </div>
                            <div class="btn-group mr-2" role="group" aria-label="Second group">
                              <input type="text" name="amount" id="amount" cols="1" class="form-control text-center" readonly value="1">
                            </div>
                            <div class="btn-group" role="group" aria-label="Third group">
                              <button class="btn btn-primary" onclick="add_price()" type="button">+</button>
                            </div>
                          </div> -->

                        <p style="color: red;"><span>Total Price (#):</span> #<span id="total_price" name="total"><?php echo $price; ?></span></p>
                        <input type="hidden" name="total_price" id="total_price" value="<?php echo $price;?>">
                        <input type="hidden" name="hidden_name" value="<?php echo $name;?>">
                        <input type="hidden" name="hidden_price" value="<?php echo $price;?>">
                        <a href="index.php" type="button" class="btn btn-primary">Back</a>
                        <!-- <button type="submit">Buy Now</button> -->
                        <input type="hidden" name="">
                          <div class="button-group-area mt-40">
                            <input type="hidden" name="fid" value="<?php echo $id; ?>">
                            <br>
                            <div class="row">
                              <div class="col-lg-12">
                                
                              </div>
                            </div>
                          </div>
                        </form>
                        
                    </div>
                </div>
            </div>
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

      function subtract_price() {
        amount = $("#amount").val();
        toInt = parseInt(amount);
        if(toInt == 1) {
          
          toInt = 1;
          
        }else{
          
          toInt = toInt - 1;
          
        }
        
        $("#amount").val(toInt);
        price = $("#price").html();
        total_price = price * toInt;
        $("#total_price").html(total_price);
      }

    </script>

  <?php include('includes/footer.php');?>