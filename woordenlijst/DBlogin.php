<?php
// DB Configuration
$servername = "62.72.37.103";
$username = "u556675066_root";
$password = "Jvw48roeb!";
$dbname = "u556675066_vop";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Controleer de verbinding
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);}

else print "Connection succeeded";

?>