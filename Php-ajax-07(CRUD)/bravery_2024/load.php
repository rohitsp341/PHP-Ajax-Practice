<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "register";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM users2";
$result = $conn->query($sql);

$res = "";
if ($result->num_rows > 0) {
    $res = '<table class="table table-bordered">
            <thead>
                <tr>
                    <th>User Name</th>
                    <th>Email</th>
                    <th>Country</th>
                    <th>Birth Date</th>
                    <th>Gender</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>';

    while ($row = $result->fetch_assoc()) {
        $res .= '<tr>
                <td>' . $row["username"] . '</td>
                <td>' . $row["email"] . '</td>
                <td>' . $row["country"] . '</td>
                <td>' . $row["bod"] . '</td>
                <td>' . $row["gender"] . '</td>
             
                <td>
                    <button type="button" class="btn btn-primary btn-edit" data-id-edit="' . $row["id"] . '">Edit</button>
                    <button type="button" class="btn btn-danger btn-delete" data-id="' . $row["id"] . '">Delete</button>
                </td>

              </tr>';
    }

    $res .= '</tbody></table>';
    mysqli_close($conn);
    echo $res;
} else {
    echo 'No data found';
}
