<?php
    //Start session
    session_start();
    
    //Unset the variables stored in session
    unset($_SESSION['id']);
    unset($_SESSION['user']);
    unset($_SESSION['user_type']);
    header("location: index.php");
?>