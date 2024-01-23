<?php
// DB Configuration
$host = "localhost";
$username = "root";
$password = "";
$database = "u556675066_vop";

$conn = new mysqli($host, $username, $password, $database);

// Controleer de verbinding
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>