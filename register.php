<?php
require_once('db/config.php');

$nameErr = $emailErr = $passwordErr = $confirm_passwordErr = "";
$name = $email = $password = $confirm_password = $user_type = "";
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_type = $_POST['user_type'];
    if(empty($_POST['name'])) {
        $nameErr = "<strong class='alert alert-danger'>Name is required</strong>";
    } else {
        $name = sanitize_input($_POST['name']);
    }

    if(empty($_POST['email'])) {
        $emailErr = "<p class='alert alert-danger'>Email Address is required</p>";
    } else {
        $email = sanitize_input($_POST['email']);
    }

    if(empty($_POST['password'])) {
        $passwordErr = "<p class='alert alert-danger'>Password is required</p>";
    } else {

        $password = sanitize_input($_POST['password']);
        $hashFormat = "$2y$10$";
        $salt = "iusesomecrazystrings22";
        $hashF_and_salt = $hashFormat . $salt;
        $password = crypt($password, $hashF_and_salt); 
    }

    if(empty($_POST['confirm_password'])) {
        $confirm_passwordErr = "<p class='alert alert-danger'>Re-enter your password</p>";
    } else {
        $confirm_password = sanitize_input($_POST['confirm_password']);
    }

    if($password != $confirm_password) {
        echo "<p class='alert alert-danger'>Passwords do not match</p>";
    }

    //check if email address already exists
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $query = mysqli_query($connection, $sql);
    if(mysqli_num_rows($query) > 0) {
        echo "<p class='alert alert-danger'>An Account with this Email Address Already Exists.</p>";
    } else {
        $qry = "INSERT INTO users(name, email, password, user_type) VALUES('$name', '$email', '$password', '$user_type')";
        //$register = mysqli_query($connection, $qry);
        if($connection->query($qry) === TRUE) {
            $_SESSION['success'] = "<p class='alert alert-success'>You have successfully registered.</p>";
            header('location: login.php');
            exit();
        } else {
            echo "<p class='alert alert-danger'>An error occurred, please try later.</p>" . $qry . "<br>" . $connection->error;
        }
    }
}

?>
<!DOCTYPE html>
<html dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../../assets/images/favicon.png">
    <title>Orbs Registration</title>
    <!-- Custom CSS -->
    <link href="dist/css/style.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
    <div class="main-wrapper">
        <!-- ============================================================== -->
        
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center bg-dark">
            <div class="auth-box bg-dark border-top border-secondary">
                <div>
                    <div class="text-center p-t-20 p-b-20">
                        <h1 class="db">ORBS</h1>
                    </div>
                    <?php echo $nameErr;?>
                    <?php echo $emailErr;?>
                    <?php echo $passwordErr;?>
                    <?php echo $confirm_passwordErr;?>
                    <!-- Form -->
                    <form class="form-horizontal m-t-20" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                        <div class="row p-b-30">
                            <div class="col-12">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-success text-white" id="basic-addon1"><i class="ti-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control form-control-lg" placeholder="Name" aria-label="Full Name" name="name" aria-describedby="basic-addon1">
                                    <p></p>
                                    
                                </div>
                                <!-- email -->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-danger text-white" id="basic-addon1"><i class="ti-email"></i></span>
                                    </div>
                                    <input type="email" class="form-control form-control-lg" placeholder="Email Address" aria-label="Username" name="email" aria-describedby="basic-addon1">
                                    <p></p><br>
                                     
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-warning text-white" id="basic-addon2"><i class="ti-pencil"></i></span>
                                    </div>
                                    <input type="password" class="form-control form-control-lg" placeholder="Password" aria-label="Password" name="password" aria-describedby="basic-addon1">
                                    <p></p>
                                     
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-info text-white" id="basic-addon2"><i class="ti-pencil"></i></span>
                                    </div>
                                    <input type="password" class="form-control form-control-lg" placeholder=" Confirm Password" aria-label="Password" name="confirm_password" aria-describedby="basic-addon1"><p></p>
                                     
                                    <input type="hidden" name="user_type" value="2">
                                </div>
                            </div>
                        </div>
                        <div class="row border-top border-secondary">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="p-t-20">
                                        <button class="btn btn-block btn-lg btn-info" name="submit" type="submit">Sign Up</button>
                                    </div>
                                </div>
                                <p>Already a Member? Login <a href="login.php">here</a></p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper scss in scafholding.scss -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper scss in scafholding.scss -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Right Sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Right Sidebar -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- All Required js -->
    <!-- ============================================================== -->
    <script src="assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- ============================================================== -->
    <!-- This page plugin js -->
    <!-- ============================================================== -->
    <script>
    $('[data-toggle="tooltip"]').tooltip();
    $(".preloader").fadeOut();
    </script>
</body>

</html>