<?php
// Include the database connection file
include "source/includes/DBlogin.php";

// Fetch all table names from the database
$result = $conn->query("SHOW TABLES");

// Initialize an empty array to store table names
$tables = [];

// Fetch each row and store the table name in the array
while ($row = $result->fetch_assoc()) {
    // Use the first value in the associative array (the table name)
    $tables[] = reset($row);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta content="width=device-width" name="viewport">
    <link rel="stylesheet" href="Source/CSS/index.css">
    <link rel="stylesheet" href="Source/CSS/nav.css">
    <link rel="icon" type="image/x-icon" href="Assets/Icons/icon.ico">

    <!-- javascript -->
    <script src="source/js/openwindow.js"></script>

    <!-- ionicons -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <?php include "source/includes/snav.php"?>
    <title>GildeDevOps</title>
  
</head>

<body>

<!-- topbar -->
<div class="main-menu"> 
</div>

<div class="topbody">
    <h1> Welkom terug, Max</h1>
    <h2> Er staan <?php echo count($tables); ?> Woordenlijsten voor je klaar</h2>
</div>

<div class="mainbody">

<?php
// Loop through each table and generate a box for each word list
foreach ($tables as $table) {
    // Fetch the number of rows in each table (number of words)
    $stmt = $conn->prepare("SELECT COUNT(*) FROM `$table`");
    $stmt->execute();
    $stmt->bind_result($wordCount);
    $stmt->fetch();
    
    // Close the result set before the next iteration
    $stmt->close();

    // Generate the HTML for each word list box
    echo "<div class='testbox1'>";
    echo "<span class='listbox-title'>$table</span><br>";
    echo "<span class='listbox-progress'>Niet gestart</span>";
    echo "<div class='listbox-line'></div>";
    echo "<span class='listbox-description'>Een woordenlijst over ...</span>";
    echo "<div class='listbox-line'></div>";
    echo "<span class='listbox-amount'>$wordCount woorden</span>";
    echo "<button class='listbox-startbutton' onclick='openPopup()'>Start</button>";
    echo "</div>";
}
?>

<div class="popup" id="myPopup">
    <span class="popupclose" onclick="closePopup()">&times;</span>
    <!-- popup content -->
    <p>Hoe wil je oefenen?</p>

    <div class="gameselection">
        <div class="flitskaartbutton">
            <a href="flipcard.php"> <img src="assets/images/flitskaarten.png" alt="flitskaarten"> </a>
            <p>Flitskaarten</p>
        </div>

        <div class="woordzoekerbutton">
            <a href="#"> <img src="assets/images/woordzoekericon.png" alt="woordzoeker"> </a>
            <p>Woordzoeker</p>
        </div>
    </div>
</div>

</body>

</html>
