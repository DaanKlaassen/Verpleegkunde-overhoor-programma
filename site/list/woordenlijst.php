<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Woordenlijst beheer</title>
    <link rel="stylesheet" href="list2.css">
    <script>
    function confirmDelete() {
            return confirm("Weet je zeker dat je de gehele tabel wilt verwijderen?");
        }
    </script>
<body>

<?php
include "DBlogin.php";

// Haal woordenlijst op
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["woordenlijst_naam"])) {
    $selectedNaam = $_POST["woordenlijst_naam"];
} elseif ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["woordenlijst_naam"])) {
    $selectedNaam = $_GET["woordenlijst_naam"];
} else {
    // Als er nog geen woordenlijst is gekozen, toon het formulier om er een te kiezen
    echo "<a href='list.php'>Kies eerst een woordenlijstnaam</a>";
}

// Formulier om gegevens toe te voegen
echo "<div class=foam><h3>Voeg gegevens toe aan woordenlijst</h3>";
echo "<form method='post' action='".$_SERVER['PHP_SELF']."'>";
echo "<input type='hidden' name='woordenlijst_naam' value='$selectedNaam'>";
echo "Woord: <input type='text' name='woord' required><br>";
echo "Voorvoegsel: ";
echo "<select name='voor_achtervoegsel'>";
echo "<option value=''>Nee</option>";
echo "<option value='Voorvoegsel'>Voorvoegsel</option>";
echo "<option value='Achtervoegsel'>Achtervoegsel</option>";
echo "</select><br>";
echo "Betekenis: <input type='text' name='betekenis' required><br>";
echo "Zin Voor: <input type='text' name='zin_voor'><br>";
echo "Zin Achter: <input type='text' name='zin_achter'><br>";
echo "<input type='submit' value='Voeg toe'>";
echo "</form></div>";

// Toon woordenlijst
displayWoordenlijst($conn, $selectedNaam);

// Gegevens toevoegen
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["woordenlijst_naam"]) && isset($_POST["woord"])) {
    $naam = $_POST["woordenlijst_naam"];
    $woord = $_POST["woord"];
    $voorvoegsel = $_POST["voor_achtervoegsel"];
    $betekenis = $_POST["betekenis"];
    $zinVoor = $_POST["zin_voor"];
    $zinAchter = $_POST["zin_achter"];

    // Voeg gegevens toe aan de tabel
    $insertSql = "INSERT INTO $naam (woord, voor_achtervoegsel, betekenis, zin_voor, zin_achter) VALUES ('$woord', '$voorvoegsel', '$betekenis', '$zinVoor', '$zinAchter')";

    if ($conn->query($insertSql) === TRUE) {
        echo "Nieuwe record toegevoegd!";
        
        // Na toevoeging, stuur de gebruiker naar een andere pagina om het formulier niet opnieuw te verzenden
        header("Location: ".$_SERVER['PHP_SELF']."?woordenlijst_naam=".$selectedNaam);
        exit();
    } else {
        echo "Error: " . $insertSql . "<br>" . $conn->error;
    }
}

// Gegevens verwijderen
if (isset($_GET["delete"])) {
    $deleteId = $_GET["delete"];
    $deleteSql = "DELETE FROM $selectedNaam WHERE id = $deleteId";

    if ($conn->query($deleteSql) === TRUE) {
        echo "Record verwijderd!";
        
        // Na verwijdering, stuur de gebruiker naar een andere pagina om het formulier niet opnieuw te verzenden
        header("Location: ".$_SERVER['PHP_SELF']."?woordenlijst_naam=".$selectedNaam);
        exit();
    } else {
        echo "Error: " . $deleteSql . "<br>" . $conn->error;
    }
}

// Woordenlijst weergeven
function displayWoordenlijst($conn, $selectedNaam) {
    // Gegevens weergeven voor de gekozen woordenlijst
    $sql = "SELECT * FROM $selectedNaam";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<h2>Woordenlijst voor $selectedNaam</h2>";
        echo "<table border='1' class=tabel>
                <tr>
                    <th>Woord</th><th>Voorvoegsel</th>
                    <th>Betekenis</th>
                    <th>Zin<br>Voor</th>
                    <th>Zin<br>Achter</th>
                    <th>Actie</th>
                </tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>".$row["woord"]."</td>
                    <td>".$row["voor_achtervoegsel"]."</td>
                    <td>".$row["betekenis"]."</td>
                    <td>".$row["zin_voor"]."</td>
                    <td>".$row["zin_achter"]."</td>
                    <td><a href='".$_SERVER['PHP_SELF']."?delete=".$row["id"]."&woordenlijst_naam=$selectedNaam' class=verwijder>Verwijder</a></td>
                </tr>";
        }

        echo "</table>";
    } else {
        echo "<br>(Nog) geen resultaten gevonden voor woordenlijst: $selectedNaam";
    }
}

/// Knop om de gehele tabel te verwijderen met bevestiging
echo "<form method='post' action='".$_SERVER['PHP_SELF']."' onsubmit='return confirmDelete()'>";
echo "<input type='hidden' name='woordenlijst_naam' value='$selectedNaam' class=table_delete>";
echo "<input type='submit' name='delete_whole_table' value='Verwijder gehele tabel' class=table_delete>";
echo "</form>";

// Gehele tabel verwijderen
if (isset($_POST["delete_whole_table"])) {
    $deleteWholeTableSql = "DROP TABLE $selectedNaam";

    if ($conn->query($deleteWholeTableSql) === TRUE) {
        echo "Gehele tabel verwijderd!";
        
        // Na verwijdering, stuur de gebruiker naar list.php
        header("Location: list.php");
        exit();
    } else {
        echo "Error: " . $deleteWholeTableSql . "<br>" . $conn->error;
    }
}


// Sluit de verbinding
$conn->close();
?>

<br><br><a href="list.php" class=terug>Terug naar woordenlijsten</a>
</body>
</html>