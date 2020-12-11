<?php
    session_start();
    $user = $_SESSION['name'];
    $id = $_SESSION['user_type'];
?>

<!--::header part start::-->
    <header class="main_menu home_menu">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <a class="navbar-brand" href="index.php"> ORBS </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse main-menu-item justify-content-end"
                            id="navbarSupportedContent">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="index.php">Home</a>
                                </li>
                                <?php
                                    if(!empty($_SESSION['shopping_cart'])) {
                                        $count = count(array_keys($_SESSION['shopping_cart']));
                                        ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="cart.php">Cart <i class="">(<?php echo $count; ?>)</i></a>
                                </li> 
                                <?php 
                                    }
                                ?>
                                
                                <?php 
                                if($_SESSION['user']) {
                                 echo 
                                        "<li class='nav-item dropdown'>
                                            <a class='nav-link dropdown-toggle' href='blog.html' id='navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                                ".$_SESSION['user']."
                                            </a>
                                            <div class='dropdown-menu' aria-labelledby='navbarDropdown'>
                                                <a class='dropdown-item' href=''>Cart</a>
                                                <a class='dropdown-item' href=''>Reservations</a>
                                                <a class='dropdown-item' href='logout.php'>Logout</a>
                                            </div>
                                        </li>";
                                } 

                                else { 
                                    echo "<li class='nav-item'>
                                        <a class='nav-link' href='login.php'>Login</a>
                                    </li>";
                                }
                                if($_SESSION['user_type'] == 1) {
                                    echo "<li class='nav-item'>
                                            <a class='nav-link' href='orbs_admin/'>Dashboard</a>
                                        </li>";
                                } else {
                                    echo "";
                                }
                                
                                ?>
                            </ul>
                        </div>
                        <div class="menu_btn">
                            <a href="reserve.php" class="btn_1 d-none d-sm-block">book a table</a>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- Header part end-->