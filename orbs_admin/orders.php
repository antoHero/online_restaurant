<?php include('includes/header.php');?>
<?php include('includes/sidebar.php');?>

<br />
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


    $result = "";
    $info = "";
    $items = "";
    $pagenum = "";
    $per_page = 5;

    $count = mysqli_query($connection, "SELECT * FROM orders");
    $pages = ceil((mysqli_num_rows($count)) / $per_page);

    if(isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 1;
    }

    $start = ($page - 1) * $per_page;

    $orders = mysqli_query($connection, "SELECT * FROM orders LIMIT $start, $per_page");
    if(mysqli_num_rows($orders) > 0) {
        $row = mysqli_fetch_assoc($orders);

    } else {
        echo "<p class='alert alert-danger'>No Order has been made</p>";
    }

?>

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

           <br />

            <div class="container">
                
                <div class="row">
                    <h5 class="text-center">Orders</h5>

                    
                    <div class="col-md-12">
                        <table class="table table-responsive">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Order Code</th>
                                    <th>Checkout Name</th>
                                    <th>Food</th>
                                    <th>Quantity</th>
                                    <th>User</th>
                                    <th>Total</th>
                                    <th>Checkout Address</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Status</th>
                                    <th>Stat</th>
                                </tr>
                            </thead>
                            <tbody>
                        <?php
                            $sql = "SELECT c.*, o.* FROM cart AS c LEFT JOIN orders AS o ON o.order_id = c.cart_id LIMIT $start, $per_page";
                            $query = mysqli_query($connection, $sql);
                            while($query_row = mysqli_fetch_assoc($query)) {
                                $ord_id = $query_row['order_id'];
                            
                        ?>
                                <tr>
                                    <td><?php echo $ord_id;?></td>
                                    <td><?php echo $query_row['code'];?></td>
                                    <td><?php echo $query_row['name'];?></td>
                                    <td><?php echo $query_row['food'];?></td>
                                    <td><?php echo $query_row['qty'];?></td>
                                    <td><?php echo $query_row['user_id'];?></td>
                                    <td><?php echo $query_row['total'];?></td>
                                    <td><?php echo $query_row['address'];?></td>
                                    <td><?php echo $query_row['email'];?></td>
                                    <td><?php echo $query_row['phone'];?></td>
                                    <td><?php echo $query_row['status'];?></td>
                                    <td> <?php 
                                         echo "<form action='orders.php' method='POST'>
                                         <input type='hidden' name='order_id' value='$ord_id'>
                                            <select name='update'>
                                                <option value='pending' selected>Pending</option>
                                                <option value='confirmed'>Confirmed</option>
                                                <option value='cancelled'>Cancelled</option>
                                            </select>
                                            <p></p>
                                            <button type='submit' class='btn btn-primary' name='change'> Done </button>
                                         </form>";

                                         ?>
                                        
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                        <?php
                            if(isset($_POST['change'])) {
                                $id = mysqli_real_escape_string($connection, $_POST['order_id']);
                                $update = mysqli_real_escape_string($connection, $_POST['update']);


                                $qry = mysqli_query($connection, "UPDATE orders SET status='$update' WHERE order_id='$id'");
                                if($qry) {
                                    echo "<p class='alert alert-success'>Status changed</p>";
                                } else {
                                    echo "<p class='alert alert-danger'>Status not changed</p>";
                                }
                            }
                        ?>
                        <div id="details_display">
                            
                        </div>
                        <ul class="pagination pagination-sm m-0 float-right">
                          <li class="page-item"><a class="page-link" href="#">«</a></li>
                          <li class="page-item"><a class="page-link" href="#">1</a></li>
                          <li class="page-item"><a class="page-link" href="#">2</a></li>
                          <li class="page-item"><a class="page-link" href="#">3</a></li>
                          <li class="page-item"><a class="page-link" href="#">»</a></li>
                        </ul>
                        <div class="content table-responsive table-full-width">
                            <p style="padding: 0px 20px;"><?php if($pages >=1 && $page <= $pages) {
                                for($i=1; $i<= $pages; $i++) {
                                    echo ($i == $page) ? "<a href='orders.php?page=".$i."' style='margin-left:5px; font-weight: bold; text-decoration: none; color: #FF5722;' >$i</a>  "  : " <a href='orders.php?page=".$i."' class='btn'>$i</a>";
                                }
                            }?></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->

<?php include('includes/footer.php');?>