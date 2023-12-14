<!DOCTYPE html>
<html lang="en">
<head>
  <meta content="width=device-width">
  <link rel="stylesheet" href="../CSS/list.css">
  <link rel="stylesheet" href="../CSS/nav.css">
  <link rel="icon" type="image/x-icon" href="../img/icon.ico">
  <title>GildeDEVops</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<?php
include "../cfg/nav/snav.php";
include "DBlogin.php";

// Maak nieuwe tabel (woordenlijst)
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["nieuwe_tabel_naam"])) {
    $nieuweTabelNaam = $_POST["nieuwe_tabel_naam"];
    createTable($conn, $nieuweTabelNaam);
}

function createTable($conn, $tableName) {
    // Controleer of de tabel al bestaat
    $checkTableSql = "SHOW TABLES LIKE '$tableName'";
    $checkTableResult = $conn->query($checkTableSql);

    if ($checkTableResult->num_rows == 0) {
        // De tabel bestaat nog niet, maak de tabel aan
        $createTableSql = "CREATE TABLE $tableName (
                            id INT(255) AUTO_INCREMENT PRIMARY KEY,
                            woord VARCHAR(30) NOT NULL,
                            voor_achtervoegsel VARCHAR(30),
                            betekenis VARCHAR(50),
                            zin_voor VARCHAR(100),
                            zin_achter VARCHAR(100)
                        )";

        if ($conn->query($createTableSql) === TRUE) {
            // Stuur de gebruiker door naar woordenlijst.php met de gemaakte tabelnaam
            header("Location: woordenlijst.php?woordenlijst_naam=" . $tableName);
            exit();
        } else {
            echo "Error creating table: " . $conn->error;
        }
    }
}

// Haal bestaande tabellen op
$showTablesSql = "SHOW TABLES";
$tablesResult = $conn->query($showTablesSql);

// Handle search functionality
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["search"])) {
    $searchTerm = $_POST["search"];
    $showTablesSql = "SHOW TABLES LIKE '%$searchTerm%'";
    $tablesResult = $conn->query($showTablesSql);
}
?>

<body>
  <section>
    <!-- Main menu line on top of the site -->
    <div class="main-menu">
<<<<<<< Updated upstream
      <a href=""><ion-icon name="add-circle-outline" class= "add"></ion-icon></a>
=======
      <a href=""><ion-icon name="add-circle-outline" class="add"></ion-icon></a>
>>>>>>> Stashed changes
    </div>

    <!-- Nieuwe tabelnaam input -->
<form action="" method="post" class="new-table">
    <input type="text" name="nieuwe_tabel_naam" id="" class="search" placeholder="Nieuwe tabelnaam">
</form>


    <!-- Site code -->
    <div class="bgTheamas">
      <form action="" method="post" class="search-form">
        <input type="text" name="search" class="search" placeholder="Zoek tabel">
        <button type="submit"><ion-icon name="search-outline" class="submit"></ion-icon></button>
      </form>

      <div class="Table">
        <?php
        // Toon de bestaande tabellen in een lijst
        while ($row = $tablesResult->fetch_row()) {
          $tableName = $row[0];
          $countRowsSql = "SELECT COUNT(*) as count FROM $tableName";
          $countRowsResult = $conn->query($countRowsSql);
          $rowCount = $countRowsResult->fetch_assoc()['count'];

          // Voeg een link toe rondom de tabelrij
          echo "<a href='woordenlijst.php?woordenlijst_naam=$tableName'><li class='bg'>$tableName<br> $rowCount definities </li></a>";
        }
        ?>
      </div>
    </div>
  </section>

  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>
