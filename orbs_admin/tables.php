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
                        <h4 class="page-title">Dashboard</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Library</li>
                                </ol>
                            </nav>
                        </div>
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
                <!-- ============================================================== -->
                <!-- Sales Cards  -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                          <div class="card-header">
                            <h3 class="card-title">Reservations</h3>
                          </div>
                          <div class="card-body">
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
                                $per_page = 10;
                                $pagenum = "";
                                $result = "";


                                $qry = "SELECT * FROM reserve";
                                $count = mysqli_query($connection, $qry);
                                $pages = ceil((mysqli_num_rows($count)) / $per_page);
                                //echo $pages;

                                if(isset($_GET['page'])) {
                                    $page = $_GET['page'];
                                    //echo $page;
                                } else {
                                    $page = 1;
                                }

                                $start  = ($page - 1) * $per_page;
                                $get = "SELECT * FROM reserve LIMIT $start, $per_page";
                                $query = mysqli_query($connection, $get);
                                //var_dump($query);
                                if(mysqli_num_rows($query) > 0) {
                                    $result = "<table class='table table-striped'>
                                                <thead>
                                                    <th>S/N</th>
                                                    <th>Name of Customer</th>
                                                    <th>Email</th>
                                                    <th>No of persons</th>
                                                    <th>Phone</th>
                                                    <th>Time</th>
                                                    <th>Date</th>
                                                    <th>Suggestion</th>
                                                    <th>Delete</th>
                                                </thead>
                                                <tbody>";
                                    $x = 1;          

                                    while($row = mysqli_fetch_assoc($query)){
                                        $id = $row['id'];
                                        $name = $row['name'];
                                        $email = $row['email'];
                                        $persons = $row['no_of_person'];
                                        $phone = $row['phone'];
                                        $date = $row['date'];
                                        $time = $row['time'];
                                        $msg = $row['msg'];

                                        $result .= "<tr>
                                                        <td>$x</td>
                                                        <td>$name</td>
                                                        <td>$email</td>
                                                        <td>$persons</td>
                                                        <td>$phone</td>
                                                        <td>$time</td>
                                                        <td>$date</td>
                                                        <td>$msg</td>
                                                        <td><a class='btn btn-danger' href='tables.php?delete=".$id."' onclick='return check();'><i class='pe-7s-close-circle'></i>Delete</a></td>
                                                    </tr>";
                                        $x++;
                                    }

                                    $result .= "</tbody>
                                                </table>";

                                } else {
                                    $result = "<p style='color:red; padding: 10px; background: #ffeeee;'>No records available in the database yet</p>";
                                }

                                if(isset($_GET['delete()'])) {
                                    $delete = preg_replace("#[^0-9]#", "", $_GET['delete']);
                
                                    if($delete != "") {
                                        
                                        $sql = $db->query("DELETE FROM food WHERE id='".$delete."'");
                                    
                                        if($sql) {
                                            
                                            echo "<script>alert('Successfully deleted')</script>";
                                            
                                        }else{
                                            
                                            echo "<script>alert('Operation Unsuccessful. Please try again')</script>";
                                            
                                        }
                                        
                                    }
                                }

                            ?>
                    <?php echo $result; ?>
                    <p style="padding: 0px 20px;"><?php if($pages >= 1 && $page <= $pages) {
                        for($i = 1; $i <= $pages; $i++) {
                            echo ($i == $page) ? "<a href='food_list.php?page=".$i."' style='margin-left:5px; font-weight: bold; text-decoration: none; color: #FF5722;' >$i</a>  "  : " <a href='index.php?page=".$i."' class='btn'>$i</a> ";
                        }
                    } ?></p>
                    
                            <!-- <table class="table table-stripped">
                                <thead>
                                  <tr>
                                    <th>S/No</th>
                                    <th>Food</th>
                                    <th>Price</th>
                                    <th>Category</th>
                                    <th>Remove</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td>$x++</td>
                                    <td><?php echo $name;?></td>
                                    <td><?php echo $price;?></td>
                                    <td><?php echo $category;?></td>
                                    <td><button class="btn btn-danger" name="delete" type="submit">X</button></td>
                                  </tr>
                                
                                </tbody>
                            </table> -->
                          </div>
                        </div>
                        
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
<?php include('includes/footer.php');?>