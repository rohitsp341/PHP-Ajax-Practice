<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "register";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    // echo "successful";


    $username = $_POST['username'];
    $email = $_POST['email'];
    $country = $_POST['country'];
    $bod = $_POST['bod'];
    $gender = $_POST['gender'];

    $sql = "INSERT INTO users2 (username, email, country, bod, gender) VALUES ('$username', '$email', '$country', '$bod', '$gender')";

    if ($conn->query($sql) === TRUE) {
        echo 'Record added successfully';
    } else {
        echo 'Error adding record: ' . $conn->error;
    }
}
$conn->close();
