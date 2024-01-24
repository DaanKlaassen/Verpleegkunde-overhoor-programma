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
    <link rel="stylesheet" href="source/css/index.css">
    <link rel="stylesheet" href="source/css/nav.css">
    <link rel="icon" type="image/x-icon" href="Assets/Icons/icon.ico">

    <!-- javascript -->
    <script src="source/js/openwindow.js"></script>
    <script src="source/js/search.js"></script>

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
    <h1> Welkom terug, Gebruiker</h1>
    <h2> Er staan <?php echo count($tables); ?> Woordenlijsten voor je klaar</h2>
</div>

<div class="search-container">
    <input type="text" id="searchInput" placeholder="Search...">
    <button onclick="filterWordLists()">Search</button>
    <button onclick="clearFilter()">Clear</button>
</div>

<div class="mainbody" id="wordListContainer">

<?php
foreach ($tables as $table) {
    $stmt = $conn->prepare("SELECT COUNT(*) FROM `$table`");
    $stmt->execute();
    $stmt->bind_result($wordCount);
    $stmt->fetch();
    
    $stmt->close();

    echo "<div class='testbox1'>";
    echo "<span class='listbox-title'>$table</span><br>";
    echo "<span class='listbox-progress'>Niet gestart</span>";
    echo "<div class='listbox-line'></div>";
    echo "<span class='listbox-description'>Een woordenlijst over ...</span>";
    echo "<div class='listbox-line'></div>";
    echo "<span class='listbox-amount'>$wordCount woorden</span>";
    echo "<button class='listbox-startbutton' onclick='openPopup(\"$table\")'>Start</button>";
    echo "</div>";
}
?>

<div class="popup" id="myPopup">
    <span class="popupclose" onclick="closePopup()">&times;</span>
    <!-- popup content -->
    <p>Hoe wil je oefenen?</p>

    <div class="gameselection">
        <div class="flitskaartbutton">
            <a id="flipcardLink" href="#"> <img src="assets/images/flitskaarten.png" alt="flitskaarten"> </a>
            <p>Flitskaarten</p>
        </div>

        <div class="zininvullenbutton">
            <a id="zinInvullenLink" href="#"> <img src="assets/images/woordzoekericon.png" alt="Zin invullen"> </a>
            <p>Zinnen Invullen</p>
        </div>
    </div>

</div>

</body>

</html>
