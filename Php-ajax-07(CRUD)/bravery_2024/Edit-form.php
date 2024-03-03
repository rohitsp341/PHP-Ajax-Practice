<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "register";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$student_Id = $_POST["id"];
$sql = "SELECT * FROM users2 WHERE id={$student_Id}";
$result = mysqli_query($conn, $sql) or die("SQL Query Failed");


$output = "";
if (mysqli_num_rows($result) > 0) {


    while ($row = mysqli_fetch_assoc($result)) {
        $output .= "<div class='modal-body'>
                        <div class='form-group'>
                            <input type='hidden' name='edit_id' class='form-control' id='edit_id' value='{$row["id"]}'>
                        </div>
                        <div class='form-group'>
                            <label>User Name</label>
                            <input type='text' name='edit_username' class='form-control' id='edit_username' value='{$row["username"]}'>
                            <span class='error-msg' id='msg_edit_username'></span>
                        </div>
                        <div class='form-group'>
                            <label>Email</label>
                            <input type='text' name='edit_email' class='form-control' placeholder='YourEmail@email.com' id='edit_email' value='{$row["email"]}'>
                            <span class='error-msg' id='msg_edit_email'></span>
                        </div>
                        <div class='form-group'>
                            <label>Country</label>
                            <select class='custom-select' name='edit_country' id='edit_country'>
                                <option value=''>Choose...</option>
                                <option value='India' " . ($row["country"] == 'India' ? 'selected' : '') . ">India</option>
                                <option value='USA' " . ($row["country"] == 'USA' ? 'selected' : '') . ">USA</option>
                                <option value='Germany' " . ($row["country"] == 'Germany' ? 'selected' : '') . ">Germany</option>
                                <option value='UK' " . ($row["country"] == 'UK' ? 'selected' : '') . ">UK</option>
                            </select>
                            <span class='error-msg' id='msg_edit_country'></span>
                        </div>
                        <div class='form-group'>
                            <label>Birth Date</label>
                            <input type='date' name='edit_bod' class='form-control' id='edit_bod' value='{$row["bod"]}'>
                            <span class='error-msg' id='msg_edit_bod'></span>
                        </div>
                        <div class='form-group'>
                            <label class='mr-3'>Gender :- </label>
                            <div class='form-check form-check-inline'>
                                <input class='form-check-input' type='radio' id='edit_genderM' name='edit_gender' value='Male' " . ($row["gender"] == 'Male' ? 'checked' : '') . ">
                                <label class='form-check-label'>Male</label>
                            </div>
                            <div class='form-check form-check-inline'>
                                <input class='form-check-input' type='radio' id='edit_genderF' name='edit_gender' value='Female' " . ($row["gender"] == 'Female' ? 'checked' : '') . ">
                                <label class='form-check-label'>Female</label>
                            </div>
                            <span class='error-msg' id='msg_edit_gender'></span>
                        </div>
                        <div class='modal-footer'>
                            <input type='submit' class='btn btn-success' id='Update-btn' value='Update'></input>
                            <input type='submit' class='btn btn-danger' id='Cancel-btn'  value='Cancel'></input>
                        </div>
                    </div>";
    }


    echo $output;
    mysqli_close($conn);
} else {
    echo "Record Not Found";
}
