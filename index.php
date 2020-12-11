
<?php include('functions/functions.php');?>

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
    if(isset($_POST['code']) && $_POST['code'] != "") {
        $code = $_POST['code'];
        $result = mysqli_query($connection, "SELECT * FROM food WHERE `code`='$code'");
        $row = mysqli_fetch_assoc($result);
        $id = $row['id'];
        $name = $row['name_of_food'];
        $code = $row['code'];
        $price = $row['cost'];
        $image = $row['image'];

        $cartArray = array(
            $code = array(
                'id'=>$id,
                'name'=>$name,
                'code'=>$code,
                'price'=>$price,
                'image'=>$image,
                'quantity'=>1
            )
        );

    if(empty($_SESSION["shopping_cart"])) {
        $_SESSION["shopping_cart"] = $cartArray;
        echo "<script>window.open('Food has been added to your cart')</script>";
    }else{
        $array_keys = array_keys($_SESSION["shopping_cart"]);
        if(in_array($code, $array_keys)) {
            echo "<script>window.open('Food is already in your cart')</script>"; 
        } else {
            $_SESSION["shopping_cart"] = array_merge($_SESSION["shopping_cart"],$cartArray);
            echo "<script>window.open('Food is being added to your cart')</script>";
        }

    }
}

?>
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
    <?php include('includes/header.php');?>

    <!-- banner part start-->
    <section class="banner_part">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="banner_text">
                        <div class="banner_text_iner">
                            <h5>Expensive but the best</h5>
                            <h1>Deliciousness jumping into the mouth</h1>
                            <p>Together creeping heaven upon third dominion be upon won't darkness rule land
                                behold it created good saw after she'd Our set living. Signs midst dominion
                                creepeth morning</p>
                            <div class="banner_btn">
                                <div class="banner_btn_iner">
                                    <a href="reserve.php" class="btn_2">Reservation <img src="img/icon/left_1.svg" alt=""></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- banner part start-->

    <!--::exclusive_item_part start::-->
    <section class="exclusive_item_part blog_item_section">
        
    </section>
    <!--::exclusive_item_part end::-->

    <!-- food_menu part end-->    
    <div class="container">
        <div class="col-lg-5">
            <div class="section_tittle">
                <p>Popular Menu</p>
                <h2>Delicious Food Menu</h2>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="row">
                <div class="col-sm-6 col-lg-6">
                    <?php
                        $result = mysqli_query($connection, "SELECT * FROM `food`");
                        while($row = mysqli_fetch_assoc($result)) {
                                echo "
                                    <form method='post' action=''>
                                        <input type='hidden' name='code' value=".$row['code']." />
                                        <div class='single_food_item media' style='padding-top: 20px;'>
                                          <img src='orbs_admin/".$row['image']."' class='mr-3' alt='".$row['name']."' width='160px' height='160px'>

                                      
                                          <div class='media-body align-self-center'>
                                              <h3>".$row['name_of_food']."</h3>
                                              <p>".substr($row['description'], 0, 50)." ...<p>
                                              <h5>#".$row['cost']."</h5>
                                              <a href='details.php?fid=".$row['id']."'>Read More <img src='img/icon/left_2.svg'></a>
                                              <button type='submit' class='btn btn-warning'>Add To Cart </button>
                                          </div>
                                          <a href='#' style='background: green; color: #fff; margin: 10px; padding: 10px;'>".$row['category']."</a>
                                        </div>
                                    </form> <br />";
                            
                        }
                        mysqli_close($connection);
                    ?>
                    
                </div>
            </div>
        </div>
    </div>
    <!-- footer part start-->
    <footer class="footer-area">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-sm-6 col-md-3 col-lg-3">
                    <div class="single-footer-widget footer_1">
                        <h4>About Us</h4>
                        <p>Orbss is the number one online restaurant that guarantees deliciousness in your mouth.</p>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-md-3 col-lg-3">
                    <div class="single-footer-widget footer_2">
                        <h4>Contact us</h4>
                        <div class="contact_info">
                            <p><span> Address :</span>Kaduna, Nigeria </p>
                            <p><span> Phone :</span> +2 34 800 (08060)</p>
                            <p><span> Email : </span>info@orbss.com </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-md-4 col-lg-3">
                    <div class="single-footer-widget footer_3">
                        <h4>Newsletter</h4>
                        <p>Subscribe for our newsletters</p>
                        <form action="#">
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder='Email Address'
                                        onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email Address'">
                                    <div class="input-group-append">
                                        <button class="btn" type="button"><i class="fas fa-paper-plane"></i></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="copyright_part_text">
                <div class="row">
                    <div class="col-lg-8">
                        <p class="footer-text m-0"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="ti-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                    </div>
                    <div class="col-lg-4">
                        <div class="copyright_social_icon text-right">
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="ti-dribbble"></i></a>
                            <a href="#"><i class="fab fa-behance"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer part end-->

    <!-- jquery plugins here-->
    <!-- jquery -->
    <script src="js/jquery-1.12.1.min.js"></script>
    <!-- popper js -->
    <script src="js/popper.min.js"></script>
    <!-- bootstrap js -->
    <script src="js/bootstrap.min.js"></script>
    <!-- easing js -->
    <script src="js/jquery.magnific-popup.js"></script>
    <!-- swiper js -->
    <script src="js/swiper.min.js"></script>
    <!-- swiper js -->
    <script src="js/masonry.pkgd.js"></script>
    <!-- particles js -->
    <script src="js/owl.carousel.min.js"></script>
    <!-- swiper js -->
    <script src="js/slick.min.js"></script>
    <script src="js/gijgo.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <!-- custom js -->
    <script src="js/custom.js"></script>
</body>

</html>