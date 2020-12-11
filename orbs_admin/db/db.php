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