<?php
$student_Id=$_POST["id"];

$hostName = "localhost";
$dbUser = "rohit";
$dbPassword = "rohit";
$dbName = "ajax-test";
$conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName,3307);
if (!$conn) {
    die("Database not connected");
}
$sql="DELETE FROM user  WHERE id={$student_Id}";

if(mysqli_query($conn,$sql)){
    echo 1;
}
else{
    echo 0;
}

?>