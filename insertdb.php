<?php
/**
 * Created by PhpStorm.
 * User: incals
 * Date: 6/9/2017
 * Time: 12:50 PM
 */
require("phpsqlajax_dbinfo.php");

$conn = new mysqli($servername, $username, $password, $database);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT * FROM markers WHERE 1";
$res = mysqli_query($conn,$sql);

if($res === FALSE) {
    die('Not connected : ' . mysqli_error()); // TODO: better error handling
}
else {

    $lat2=   $_POST["txtlat"];
    $lng2=   $_POST["txtlang"];
    $name=   $_POST["name"];
    $address= $_POST["address"];

    $sql = "INSERT INTO markers (lat, lng, name, address )
VALUES ('$lat2', '$lng2','$name','$address');";

    if ($conn->multi_query($sql) === TRUE) {
        echo "New records created successfully";
    }
    else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}

?>


