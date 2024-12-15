<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "php_projects";


// Create a connection
$conn = mysqli_connect($servername, $username, $password, $database );

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
