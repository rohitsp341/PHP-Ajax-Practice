<?php

$search_value=$_POST["search"];


$hostName = "localhost";
$dbUser = "rohit";
$dbPassword = "rohit";
$dbName = "ajax-test";
$conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName,3307);
if (!$conn) {
    die("Database not connected");
}

$sql="SELECT * FROM user WHERE First_name LIKE '%{$search_value}%' OR Last_name LIKE '%{$search_value}%' ";
$result=mysqli_query($conn,$sql) or die("SQL Query Failed");


$output="";
if(mysqli_num_rows($result)>0){
    $output='<table class="table table-hover">
        <thead class="table-primary">
            <tr>
                <th scope="col">SINO</th>
                <th scope="col">First_name</th>
                <th scope="col">Last_name</th>
                <th scope="col">State</th>
                <th scope="col">Mobile</th>
                <th scope="col">Action</th>

            
            </tr>
        </thead>
        ';
        while($row=mysqli_fetch_assoc($result)){
            $output.="<tbody><tr>
                                <td>{$row["id"]}</td>
                                <td>{$row["First_name"]}</td>
                                <td>{$row["Last_name"]}</td>
                                <td>{$row["State"]}</td>
                                <td>{$row["mobile"]}</td>
                                <td>

                                <button type='button' class='btn btn-primary' id='Edit-btn' data-id='{$row["id"]}'>Edit</button>
                                <button type='button' class='btn btn-danger' id='delete-btn' data-id='{$row["id"]}'>Delete</button>
                                </td>
                            </tr>
                        </tbody>";

        }
        $output.="</table>"; // output. indicate concat
        mysqli_close($conn);
        echo $output;

}
else{
    echo "Record Not Found";

}

?>