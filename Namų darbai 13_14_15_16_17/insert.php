<?php
require_once 'db.php';

$conn = connectDB();

$sql = $conn->prepare("INSERT INTO auto (date, number, distance, time) VALUES(?, ?, ?, ?)");

$sql->bind_param("ssdd", $_REQUEST['date'], $_REQUEST['number'], $_REQUEST['distance'], $_REQUEST['time']);
 $sql->execute();
 echo "<h2>Įrašas pridėtas</h2>"

?>