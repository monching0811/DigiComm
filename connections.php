<?php

$host = "localhost"; // Replace with your database host
$username = "root"; // Replace with your database username
$password = "081100"; // Replace with your database password
$database = "digicomm"; // Replace with your database name

function connection() {
    global $host, $username, $password, $database;
    $conn = mysqli_connect($host, $username, $password, $database);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    return $conn;
}

?>