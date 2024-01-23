<?php 
session_start();

include "source/includes/DBlogin.php"; // Make sure this path is correct

$selected_table = isset($_GET['selected_table']) ? $_GET['selected_table'] : null;

if ($selected_table === null) {
    die("No table selected");
}

// Fetch words and definitions from the database
$query = "SELECT woord, betekenis FROM `$selected_table`";
$result = $conn->query($query);

$words = [];
while ($row = $result->fetch_assoc()) {
    $words[] = $row;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GildeDevOps</title>

    <link rel="stylesheet" href="source/css/flitskaarten.css"> 

    <?php include "source/includes/snav.php"?>
    <link rel="stylesheet" href="source/css/nav.css"> 


</head>

<body>

<div class="main-menu"> 
</div>

<div class="mainbody">

<a href="index.php"><ion-icon name="arrow-back-outline"class="back-button"></ion-icon></a>

<div class="flip-card">
  <div class="flip-card-inner">
    <div class="flip-card-front">
      <h2 id="wordTitle">WoordPlaceholder</h2>
    </div>
    <div class="flip-card-back">
      <p id="wordDefinition">DefinitiePlaceholder</p>
    </div>
  </div>
</div>

<div class="mainbuttons">
<button onclick="changeWord(-1)">Vorige</button>
<button onclick="changeWord(1)">Volgende</button>
</div>

<script>
var words = <?php echo json_encode($words); ?>;
var currentIndex = 0;

function changeWord(direction) {
    currentIndex += direction;
    if (currentIndex < 0) currentIndex = words.length - 1;
    if (currentIndex >= words.length) currentIndex = 0;

    document.getElementById('wordTitle').textContent = words[currentIndex].woord;
    document.getElementById('wordDefinition').textContent = words[currentIndex].betekenis;
}

// Initialize first word
changeWord(0);
</script>

</body>
</html>