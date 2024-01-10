<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "vop";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to sanitize and validate input
function clean_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Process the login form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = clean_input($_POST["username"]);
    $password = $_POST["password"];

    // Retrieve user data from the database
    $sql = "SELECT * FROM `inlog&register` WHERE username = ($username, password )";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verify password
        if (password_verify($password, $row["password"])) {
            echo "Login successful!";
            // You can redirect to another page or set a session variable for authentication.
        } else {
            echo "Incorrect password";
        }
    } else {
        echo "User not found";
    }
}

// Close the database connection
$conn->close();
?>
