<?php
// DB Configuration
$host = "localhost";
$dbname = "vop";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($host, $dbname, $username, $password);

// Controleer de verbinding
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>