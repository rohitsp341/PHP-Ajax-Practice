<?php

$firstname=$_POST["firstname"];
$lastname=$_POST["lastname"];
$state=$_POST["state"];
$Mobile=$_POST["mobile"];


$hostName = "localhost";
$dbUser = "rohit";
$dbPassword = "rohit";
$dbName = "ajax-test";
$conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName,3307);
if (!$conn) {
    die("Database not connected");
}

$sql="INSERT INTO user(First_name,Last_name,State,mobile) VALUES ('{$firstname}','{$lastname}','{$state}','{$Mobile}')";
// $result=mysqli_query($conn,$sql) or die("SQL Query Failed");

if(mysqli_query($conn,$sql)){
    echo 1;
}else{
    echo 0;
}

?>