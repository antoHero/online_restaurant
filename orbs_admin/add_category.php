<?php include('includes/header.php');?>
<?php include('includes/sidebar.php');?>
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Add Meal Category</h4>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="span12">
                        <?php 

                            
    
                            define('DB_HOST', '127.0.0.1');
                            define('DB_USER', 'root');
                            define('DB_PASSWORD', 'secret');
                            define('DB_NAME', 'orbs');

                            $connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                            if(!$connection):
                                echo "Failed Connection!!! " . mysqli_connect_errno() ."<br> " . mysqli_connect_error();
                            endif;
                            


                            $nameErr = "";
                            $name = "";
                            function sanitize_data($data) {
                                $data = trim($data);
                                $data = stripslashes($data);
                                $data = htmlspecialchars($data);
                                return $data;
                            }
                             if($_SERVER["REQUEST_METHOD"] == "POST") {
                                 if(empty($_POST['name'])) {
                                     $nameErr =  "<strong style='color:red;'>Enter name of category</strong>";
                                     echo $nameErr;
                                 } else {
                                     $name = sanitize_data($_POST['name']);
                                 }
                                 //check if the name already exists
                                  $sql = "SELECT * FROM meal_type WHERE name='$name'";
                                    $result = mysqli_query($connection, $sql);
                                    if(mysqli_num_rows($result) == 1) {
                                      echo "<p class='alert alert-danger'>Name already exists.</p>";
                                    } else {
                                        $qry = "INSERT INTO meal_type(name) VALUES('$name')";
                                        $result = mysqli_query($connection, $qry);
                                        if($result) {
                                            echo "<p class='alert alert-success'>Name Added Successfully.</p>";
                                        } 
                                    }
                            }

                        ?>
                        <div class="widget-box">
                            <form class="" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                                <div class="form-group">
                                  <label for="exampleFormControlInput1"> Name </label>
                                  <input type="text" class="form-control" id="category_name" name="name" placeholder="Enter Meal Category Here">
                                </div>
                                <button class="btn btn-success" type="submit" name="submit">Add</button>
                              </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
<?php include('includes/footer.php');?>