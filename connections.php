<?php
function connection(){
    $host = "localhost";
    $user = "root";
    $password = "081100";
    $database = "digicomm";

    $conn = mysqli_connect($host, $user, $password, $database);

    if(mysqli_connect_errno()){
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit();
    }

    return $conn; // Important: Return the connection object
}
?>