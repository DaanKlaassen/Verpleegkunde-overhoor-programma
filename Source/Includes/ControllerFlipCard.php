<?php
session_start();
$id = isset($_SESSION['id']) ? $_SESSION['id'] : 0;
$host = "localhost";
$dbname = "vop";
$username = "root";
$password = "";



try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection error: " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["increment"])) {
        $id++;
    } elseif (isset($_POST["decrement"])) {
        $id = max(1, $id - 1);
    }

    // Save the updated $id in the session
    $_SESSION['id'] = $id;
}
$query = "SELECT woord, betekenis FROM test1234 WHERE ID = $id";
$stmt = $pdo->query($query);

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    list($woord, $betekenis) = array_values($row);
    echo '<div class="contener">';
    echo '<div class="card">';
    echo '<div class="front">';
    echo '<h1>'.$betekenis.'</h1>';
    echo '</div>';
    echo '<div class="back">';
    echo '<h1>Anser</h1>';
    echo  '<br>';
    echo   '<p>'.$woord.'</p>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
}

$pdo = null;
?>