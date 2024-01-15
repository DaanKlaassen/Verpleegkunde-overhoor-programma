<?php
include "source/includes/DBlogin.php";

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
?>

<!DOCTYPE html>
<html>
<head>
    <title>Maak of kies een woordenlijst</title>
</head>
<body>

<h2>Kies een bestaande woordenlijst</h2>
<form method="get" action="woordenlijst.php">
    <select name="woordenlijst_naam">
        <?php
        // Toon de bestaande tabellen in een dropdown-menu
        while ($row = $tablesResult->fetch_row()) {
            echo "<option value='".$row[0]."'>".$row[0]."</option>";
        }
        ?>
    </select>
    <input type="submit" value="Open">
</form>

<h2>Maak nieuwe woordenlijst</h2>
<form method="post" action="select_woordenlijst.php">
    Nieuwe woordenlijst naam: <input type="text" name="nieuwe_tabel_naam"><br>
    <input type="submit" value="Maak aan">
</form>


</body>
</html>