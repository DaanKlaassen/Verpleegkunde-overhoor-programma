<!DOCTYPE html>
<html lang="en">
<head>
  <meta content="width=device-width">
  <link rel="stylesheet" href="source/CSS/list.css">
  <link rel="stylesheet" href="source/CSS/nav.css">
  <link rel="icon" type="image/x-icon" href="../img/icon.ico">
  <title>GildeDEVops</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="list.js"></script>
</head>

<?php
include "source/includes/snav.php";
include "source/includes/DBlogin.php";


// Haal bestaande tabellen op
$showTablesSql = "SHOW TABLES";
$tablesResult = $conn->query($showTablesSql);

// Handle search functionality
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["search"])) {
    $searchTerm = $_POST["search"];
    $showTablesSql = "SHOW TABLES LIKE '%$searchTerm%'";
    $tablesResult = $conn->query($showTablesSql);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["search"])) {
    $searchTerm = $_POST["search"];
}
?>

<body>
  <section>
   <!-- Main menu line on top of the site -->
<div class="main-menu">
<a href="woordenlijstlogin.html" class="login">login</a>
</div>

    <!-- Site code -->
    <div class="bgTheamas">
      <form action="" method="post" class="search-form">
        <input type="text" name="search" id="searchInput" class="search" placeholder=" Zoek tabel">
        <button type="submit"><ion-icon name="search-outline" class="submit"></ion-icon></button>
      </form>

      <div id="searchResults" class="Table">
        <?php
        // Toon de bestaande tabellen in een lijst
        while ($row = $tablesResult->fetch_row()) {
          $tableName = $row[0];
          $countRowsSql = "SELECT COUNT(*) as count FROM $tableName";
          $countRowsResult = $conn->query($countRowsSql);
          $rowCount = $countRowsResult->fetch_assoc()['count'];

          // Voeg een link toe rondom de tabelrij
          echo "<a href='student_woordenlijst.php?woordenlijst_naam=$tableName'><li class='bg'> &nbsp; $tableName<br> &nbsp; $rowCount definities </li></a>";
        }
        ?>
      </div>
    </div>
  </section>

  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>