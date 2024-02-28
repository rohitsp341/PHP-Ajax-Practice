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

$sql="SELECT * FROM user WHERE id={$student_Id}";
$result=mysqli_query($conn,$sql) or die("SQL Query Failed");


$output="";
if(mysqli_num_rows($result)>0)
{
    $output='';
        while($row=mysqli_fetch_assoc($result)){
            $output.="
                <div class='mb-3 m-4'>

                    <input type='text' class='form-control' id='edit-id'  value='{$row["id"]}' hidden>
                </div>
                <div class='mb-3 m-4'>
                    <label for='First_name' class='form-label'>First Name</label>
                    <input type='text' class='form-control' id='edit-First_name' value='{$row["First_name"]}'>
                </div>
                <div class='mb-3 m-4'>
                    <label for='Last_name' class='form-label'>Last Name</label>
                    <input type='text' class='form-control' id='edit-Last_name' value='{$row["Last_name"]}'>
                </div>
                <div class='container m-2'>
                        <input type='submit' class='btn btn-success ' id='Edit-Submit-button' value='Save'>
                </div>
            ";

        }
    
        mysqli_close($conn);
        echo $output;

}
else{
    echo "Record Not Found";

}

?>