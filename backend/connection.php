<?php

$host = "localhost";
$user = "root";
$password = "";
$database = "bms";


// Database Connection

$connection = mysqli_connect(
    $host,
    $user,
    $password,
    $database
);


// Check Connection

if(!$connection){

    die("Database Connection Failed : " . mysqli_connect_error());

}


?>