<?php
//start session

session_start();

//checking connection and connecting to the database
require_once('db/config.php');

if(isset($_POST['submit'])) {
	//sanitize values retrieved from the form to prevent SQL Injection
	function sanitize($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return mysqli_real_escape_string($connection, $str);
	}

	//Sanitize the post values
	$name = sanitize($_POST['name']);
	$email = sanitize($_POST['email']);
	$address = sanitize($_POST['address']);
	$password = sanitize($_POST['password']);
	$confirm_password = sanitize($_POST['confirm_password']);
	$user_type = sanitize($_POST['user_type']);

	//check if an account with email address already exists
	$sql = "SELECT * FROM users WHERE email = '$email'";
	$query = mysqli_query($connection, $sql);
	if(mysqli_num_rows($query) > 0) {
		echo "<p class='alert alert-danger'>An Account with this Email Address Already Exists.</p>";
	} else {
		//create insert query
		$query = "INSERT INTO users(username, email, password, address, user_type) VALUES('$name', '$email', '".md5($_POST['password'])"', '$address', '$user_type')";
		$result = mysqli_query($connection, $query);
		if($result) {
			$_SESSION['success'] = "<p class='alert alert-success'>Registration Successful. Login below</p>";
			header('location: login.php');
		} else {
			die("Something went wrong, please try again in a few minutes");
		}
	}
}


?>