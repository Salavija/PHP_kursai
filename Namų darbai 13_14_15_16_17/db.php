<?php

function connectDB() {
$servername = "localhost";
$username = "admin";
$password = "labaislaptas123";
$dbname = "radaras";


    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die('Nepavyko prisjungti: ' . $conn->connect_error);
    }
    
    return $conn;
}
?>