<?php
// DB Configuration
$host = "localhost:3306";
$username = "voproot";
$password = "$4Ki7h4z5";
$database = "dylan_vop";

$conn = new mysqli($host, $username, $password, $database);

// Controleer de verbinding
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>