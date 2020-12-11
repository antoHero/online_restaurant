<?php 
  define('DB_HOST', '127.0.0.1');
  define('DB_USER', 'root');
  define('DB_PASSWORD', 'secret');
  define('DB_NAME', 'orbs');

  $connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  //var_dump($connection);
  if(!$connection):
      echo "Failed Connection!!! " . mysqli_connect_errno() ."<br> " . mysqli_connect_error();
  endif;

?>
<?php
  session_start();
  $user_id = $_SESSION['id'];

?>

<?php           
    
  function sanitize_data($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlentities($data);

    return $data;
  }
  $nameErr = "";

  if($_SERVER['REQUEST_METHOD'] == "POST") {
    if(isset($_POST['submit'])) {
      if(empty($_POST['name'])) {
        $msg = "<strong style='color: red;'>Name field cannot be empty</strong>";
      } else {
        $name = sanitize_data($_POST['name']);
      }

      if(empty($_POST['email'])) {
        $msg = "<strong style='color: red;'>Email field cannot be empty</strong>";
      } else {
        $email = sanitize_data($_POST['email']);
      }

      if(empty($_POST['no_of_persons'])) {
        $msg = "<strong style='color: red;'>How many people should we expect?</strong>";
      } else {
        $persons = sanitize_data($_POST['no_of_persons']);
      }

      if(empty($_POST['phone'])) {
        $msg = "<strong style='color: red;'>Enter Your Phone Number</strong>";
      } else {
        $phone = sanitize_data($_POST['phone']);
      }

      if(empty($_POST['time'])) {
        $msg = "<strong style='color: red;'>What time should we expect you?</strong>";
      } else {
        $time = sanitize_data($_POST['time']);
      }

      if(empty($_POST['message'])) {
        $msg = "<strong style='color: red;'>Enter a message. It's important to us</strong>";
      } else {
        $message = sanitize_data($_POST['message']);
      }

      if(empty($_POST['date'])) {
        $msg = "<strong style='color: red;'>Pick a date</strong>";
      } else {
        $date = sanitize_data($_POST['date']);
      }

      $qry = "INSERT INTO reserve(name, email, no_of_persons, phone, time, msg, date) VALUES('$name', '$email', '$persons', '$phone', '$time', '$message', '$date')";
      $result = mysqli_query($connection, $qry);
      if($result) {
        $ins_id = mysqli_insert_id($connection);
        $code = "ORBS_$ins_id".substr($phone, 3, 8);
        $msg = "<strong style='color: red;'>You have made a reservation with the following code: $code.</strong>";
      } else {
        $msg = "<strong style='color: red;'>An error occurred! </strong>" . mysqli_error($connection);
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

  <!-- ================ contact section start ================= -->
  <section class="contact-section section_padding">
    <div class="container">
      <div class="row">
        
        <div class="col-12">
          <h2 class="contact-title"><?php echo "<br/>".$msg; ?></h2>
        </div>
       
        

        <div class="col-lg-8">

          
            <div class="row">
              <div class="col-sm-12">
                <div class="col-xl-5">
                    <div class="section_tittle">
                        <p>Reservation</p>
                        <h2>Book A Table</h2>
                    </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-12">
                    <div class="regervation_part_iner">
                        <form class="form-contact contact_form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                  <label for="name">Name</label>
                                    <input type="text" class="form-control" name="name" id="inputEmail4" placeholder="Name *">
                                </div>
                                <div class="invalid-feedback">
                                  <?php echo "<br/>".$nameErr; ?>
                                </div>
                                <div class="form-group col-md-6">
                                  <label for="name">Email</label>
                                    <input type="email" class="form-control" name="email" id="inputPassword4" placeholder="Email address *">
                                </div>
                                <div class="form-group col-md-6">
                                  <label for="person">No. of Persons</label>
                                    <select class="form-control" id="Select" name="no_of_persons">
                                        <option selected="">Persons *</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                  <label for="phone">Phone</label>
                                    <input type="text" name="phone" class="form-control" id="pnone" placeholder="Phone number *">
                                </div>
                                <div class="form-group col-md-6">
                                  <label for="date">Date</label>
                                    <div class="input-group date">
                                        <div role="wrapper" class="gj-datepicker gj-datepicker-md gj-unselectable"><input id="datepicker" type="text" class="form-control gj-textbox-md" placeholder="Date *" name="date" data-type="datepicker" data-guid="179f4eec-83ec-a726-948c-d61a96cf0b74" data-datepicker="true" role="input"><i class="ti-calendar" role="right-icon"></i></div>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                  <label for="time">Time</label>
                                    <select class="form-control" name="time" id="Select2">
                                        <option value="" selected="">Time *</option>
                                        <option value="8AM TO 10AM">8 AM TO 10AM</option>
                                        <option value="10AM TO 12PM">10 AM TO 12PM</option>
                                        <option value="12PM TO 2PM">12PM TO 2PM</option>
                                        <option value="2PM TO 4PM">2PM TO 4PM</option>
                                        <option value="4PM TO 6PM">4PM TO 6PM</option>
                                        <option value="6PM TO 8PM">6PM TO 8PM</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-12">
                                  <label for="msg">Message</label>
                                    <textarea class="form-control" id="Textarea" name="message" rows="4" placeholder="Your Note *"></textarea>
                                </div>
                            </div>


                            <div class="regerv_btn">
                              <button type="submit" class="btn_4" name="submit"> Book A Table</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            </div>
        </div>
      </div>
    </div>
  </section>
  <!-- ================ contact section end ================= -->

 <?php include('includes/footer.php');?>