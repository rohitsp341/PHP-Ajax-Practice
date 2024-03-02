<?php

$id=$_POST["id"];
$First_name=$_POST["fname"];
$Last_name=$_POST["lname"];
$state=$_POST["state"];
$mobile=$_POST["Mobile"];


$hostName = "localhost";
$dbUser = "rohit";
$dbPassword = "rohit";
$dbName = "ajax-test";
$conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName,3307);
if (!$conn) {
    die("Database not connected");
}
$sql="UPDATE user SET First_name='{$First_name}',Last_name='{$Last_name}',State='{$state}',mobile='{$mobile}' WHERE id='{$id}' ";

if(mysqli_query($conn,$sql)){
    echo 1;
}
else{
    echo 0;
}

?>