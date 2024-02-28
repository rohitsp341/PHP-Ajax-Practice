<?php

$hostName = "localhost";
$dbUser = "rohit";
$dbPassword = "rohit";
$dbName = "ajax-test";
$conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName,3307);
if (!$conn) {
    die("Database not connected");
}

$sql="SELECT * FROM user";
$result=mysqli_query($conn,$sql) or die("SQL Query Failed");


$output="";
if(mysqli_num_rows($result)>0){
    $output='<table class="table table-hover">
        <thead class="table-primary">
            <tr>
                <th scope="col">SINO</th>
                <th scope="col">First_name</th>
                <th scope="col">Last_name</th>
            
            </tr>
        </thead>
        ';
        while($row=mysqli_fetch_assoc($result)){
            $output.="<tbody><tr>
                                <td>{$row["id"]}</td>
                                <td>{$row["First_name"]}</td>
                                <td>{$row["Last_name"]}</td>
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
