<?php

$id = $_POST["id"];
$username1 = $_POST["username"];
$email = $_POST["email"];
$country = $_POST["country"];
$bod = $_POST["bod"];
$gender = $_POST["gender"];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "register";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "UPDATE users2 SET username='{$username1}',email='{$email}',country='{$country}',bod='{$bod}',gender='{$gender}' WHERE id='{$id}' ";



if (mysqli_query($conn, $sql)) {
    $updated_data = "Updated successfully";
    echo $updated_data;
} else {
    echo "Not updated";
}

mysqli_close($conn);
