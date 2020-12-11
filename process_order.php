<?php
	
	define('DB_HOST', '127.0.0.1');
    define('DB_USER', 'root');
    define('DB_PASSWORD', 'secret');
    define('DB_NAME', 'orbs');

    $connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
     if(!$connection):
        echo "Failed Connection!!! " . mysqli_connect_errno() ."<br> " . mysqli_connect_error();
     endif;


     if($_SERVER['REQUEST_METHOD'] == 'POST') {
     	if(isset($_POST['order_info'])) {
     		$values = "VALUES";

     		$name = preg_replace("#[^a-zA-Z]#", "", $_POST['name']);
     		$address = preg_replace("#[^a-zA-Z]#", "", $_POST['address']);
     		$phone = preg_replace("#[^a-zA-Z]#", "", $_POST['phone']);
     		$email = htmlentities($_POST['email'], ENT_QUOTES, 'UTF-8');
     	}
     }

?>