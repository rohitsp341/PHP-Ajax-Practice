<?php
$student_Id = $_POST["id"];

$hostName = "localhost";
$dbUser = "rohit";
$dbPassword = "rohit";
$dbName = "ajax-test";
$conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName, 3307);
if (!$conn) {
    die("Database not connected");
}

$sql = "SELECT * FROM user WHERE id={$student_Id}";
$result = mysqli_query($conn, $sql) or die("SQL Query Failed");

// $output = "";
if (mysqli_num_rows($result) > 0) {
    $output = '';
    
    while ($row = mysqli_fetch_assoc($result)) {
        $selectedKarnataka = ($row["State"] == 'Karnataka') ? 'selected' : '';
        $selectedMumbai = ($row["State"] == 'Mumbai') ? 'selected' : '';
        $selectedPune = ($row["State"] == 'Pune') ? 'selected' : '';
        $selectedHydrabad = ($row["State"] == 'Hydrabad') ? 'selected' : '';

        $output .= "
            <div class='mb-3 m-4'>
                <input type='text' class='form-control' id='edit-id'  value='{$row["id"]}' hidden>
            </div>
            <div class='mb-3 m-4'>
                <label for='edit-First_name' class='form-label'>First Name</label>
                <input type='text' class='form-control' id='edit-First_name' value='{$row["First_name"]}'>
            </div>
            <div class='mb-3 m-4'>
                <label for='edit-Last_name' class='form-label'>Last Name</label>
                <input type='text' class='form-control' id='edit-Last_name' value='{$row["Last_name"]}'>
            </div>
            <div class='mb-3 m-4'>
                <label>State</label>
                <select name='state' id='edit-state' class='form-control'>
                    <option value='Karnataka' {$selectedKarnataka}>Karnataka</option>
                    <option value='Mumbai' {$selectedMumbai}>Mumbai</option>
                    <option value='Pune' {$selectedPune}>Pune</option>
                    <option value='Hydrabad' {$selectedHydrabad}>Hydrabad</option>
                </select>
            </div>
            <div class='mb-3 m-4'>
                    <label for='text'>Mobile</label>
                    <input type='text' name='mobile' id='edit-mobile' placeholder='Enter Mobile Number' class='form-control' value='{$row["mobile"]}'>

            </div>
            <div class='container m-2'>

                <input type='submit' class='btn btn-success' id='Edit-Submit-button' value='Save'>
                <input type='submit' class='btn btn-danger' id='Close-btn' value='Close'>
                
               
                

            </div>
        ";
    }

    mysqli_close($conn);
    echo $output;
} else {
    echo "Record Not Found";
}
?>
 <!-- // <div class='btn btn-danger pl-3 red-btn' id='Close-btn'>Close</div> -->