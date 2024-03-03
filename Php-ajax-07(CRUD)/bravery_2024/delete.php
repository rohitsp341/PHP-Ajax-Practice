<?php


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "register";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['delete_id'])) {
    $userId = $_POST['delete_id'];

    $sql = "DELETE FROM users2 WHERE id = $userId";
    $result = $conn->query($sql);

    if ($result) {

        $sql = "SELECT * FROM users2";
        $result = $conn->query($sql);
        $updatedTable = "";
        echo $updatedTable;
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

$conn->close();
