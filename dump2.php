<?php
/**
 * Created by PhpStorm.
 * User: incals
 * Date: 6/8/2017
 * Time: 2:17 AM
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


    $xml = new XMLWriter();

    $xml->openURI("php://output");
    $xml->startDocument();
    $xml->setIndent(true);

    $xml->startElement('markers');

    while ($row = mysqli_fetch_assoc($res)) {
        $xml->startElement("marker");

        $xml->writeAttribute('id', $row['id']);
        $xml->writeAttribute("name", $row['name']);
        $xml->writeAttribute("address", $row['address']);
        $xml->writeAttribute("lat", $row['lat']);
        $xml->writeAttribute("lng", $row['lng']);
        $xml->writeAttribute("type", $row['type']);


        $xml->endElement();
    }

    $xml->endElement();

    header('Content-type: text/xml');
    $xml->flush();

}
?>