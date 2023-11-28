<?php
// Verbind met de database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "VOP";
$conn = new mysqli($servername, $username, $password, $dbname);

// Controleer de verbinding
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>