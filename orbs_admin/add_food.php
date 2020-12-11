<?php include('includes/header.php');?>
<?php include('includes/sidebar.php');?>

<?php include('db/db.php');?>
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <div class="row-fluid">
                  
                    <div class="col-md-6">
                      <div class="card">
                        <div class="card-header">
                          <h4 class="card-title">Add Food</h4>
                        </div>
                        <div class="card-body">
                          <?php

                          $target_dir = "images/";
                          if($_SERVER['REQUEST_METHOD'] == "POST") {
                            $name = htmlentities($_POST['name'], ENT_QUOTES, 'UTF-8');
                            $price = htmlentities($_POST['price'], ENT_QUOTES, 'UTF-8');
                            $description = htmlentities($_POST['description'], ENT_QUOTES, 'UTF-8');
                            $category = htmlentities($_POST['category'], ENT_QUOTES, 'UTF-8');
                            $date = date('Y-m-d');
                            $image = $target_dir . basename($_FILES['image']['name']);
                            $uploadOk = 1;
                            $imageFileType = strtolower(pathinfo($image, PATHINFO_EXTENSION));

                            //check if fields are empty
                            if($name == '' || $description == '' || $price == '' || $category == '') {
                              echo "<p class='alert alert-danger'>Some Fields Are Missing.</p>";
                            }

                            //check file size
                            // else if($_FILES['image']['size'] > 500000) {
                            //   echo "<p class='alert alert-danger'>This image is too large.</p>";
                            //   $uploadOk = 0;
                            // }

                            //allow certain image types
                            // else if($imageFileType != 'jpg' && $imageFileType != 'png' && $imageFileType != 'jpeg' && $imageFileType != 'gif') {
                            //   echo "<p class='alert alert-danger'>Image type not allowed. Only JPEG, JPG, GIF and PNG are allowed.</p>";
                            //   $uploadOk = 0;
                            // }

                            //if uploadOk is set by an error
                            else if($uploadOk == 0) {
                              echo "<p class='alert alert-danger'>Sorry your file could not be uploaded.</p>";
                            }

                            //if everything is okay
                            else {
                              if(move_uploaded_file($_FILES['image']['tmp_name'], $image)) {
                                $insert = "INSERT INTO food(name, cost, description, image, category, date) ";
                                $insert .= "VALUES('$name', '$cost', '$description', '$image', '$category', '$date')";
                                $save = mysqli_query($connection, $insert);
                                if($save) {
                                  echo "<p class='alert alert-success'>Food has been added successfully.</p>";
                                } else {
                                  echo "<p class='alert alert-danger'>Sorry an error occured.</p>" . mysqli_error($connection);
                                }
                              } else {
                                echo "<p class='alert alert-danger'>Error Uploading Image.</p>" . mysqli_error();
                              }  
                            }

                          }

                        ?>
                        <div class="widget-box">
                            <form class="" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                  <label for="exampleFormControlInput1"> Name </label>
                                  <input type="text" class="form-control" id="category_name" name="name" placeholder="Enter Name of Food">
                                  <label for="priceOfFood"> Price (N) </label>
                                  <input type="text" class="form-control" id="" name="price" placeholder="Enter Price">
                                  <label for="foodDescription">Enter Description</label>
                                  <textarea class="form-control" name="description" placeholder="Add a Description"></textarea>
                                  <label for="category_name">Category</label>
                                  <select name="category" class="form-control">
                                      <option>Choose...</option>
                                      <option value="Breakfast">Breakfast</option>
                                      <option value="Lunch">Lunch</option>
                                      <option value="Dinner">Dinner</option>
                                      <option value="Dessert">Dessert</option>
                                      <option value="Snacks">Snacks</option>
                                      
                                  </select>
                                  <br>
                                  <label for="image">Upload Image</label>
                                  <input type="file" name="image" class="form-group">
                                </div>
                                <button class="btn btn-success form-control" type="submit" name="submit">Add</button>
                              </form>
                        </div>
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