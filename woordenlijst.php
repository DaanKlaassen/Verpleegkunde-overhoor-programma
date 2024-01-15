<!DOCTYPE html>
<html>
<head>
    <title>bruh</title>
</head>
<body>

<?php
include "source/includes/DBlogin.php";

// Haal woordenlijst op
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["woordenlijst_naam"])) {
    $selectedNaam = $_POST["woordenlijst_naam"];
} elseif ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["woordenlijst_naam"])) {
    $selectedNaam = $_GET["woordenlijst_naam"];
} else {
    // Als er nog geen woordenlijst is gekozen, stuur terug naar select woordenlijst
    echo "<a href='select_woordenlijst.php'>Kies eerst een woordenlijstnaam</a>";
}

// Formulier om gegevens toe te voegen
echo "<h2>Voeg gegevens toe aan woordenlijst</h2>";
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
echo "</form>";


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

// Woordenlijst (Verplaatsbaar maar boven de $conn->close();)
displayWoordenlijst($conn, $selectedNaam);

// Woordenlijst weergeven
function displayWoordenlijst($conn, $selectedNaam) {
    // Gegevens weergeven voor de gekozen woordenlijst
    $sql = "SELECT * FROM $selectedNaam";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<h2>Woordenlijst voor $selectedNaam</h2>";
        echo "<table border='1'>
                <tr>
                    <th>Woord</th><th>Voorvoegsel</th>
                    <th>Betekenis</th>
                    <th>Zin Voor</th>
                    <th>Zin Achter</th>
                    <th>Actie</th>
                </tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>".$row["woord"]."</td>
                    <td>".$row["voor_achtervoegsel"]."</td>
                    <td>".$row["betekenis"]."</td>
                    <td>".$row["zin_voor"]."</td>
                    <td>".$row["zin_achter"]."</td>
                    <td><a href='".$_SERVER['PHP_SELF']."?delete=".$row["id"]."&woordenlijst_naam=$selectedNaam'>Verwijder</a></td>
                </tr>";
        }

        echo "</table>";
    } else {
        echo "<br>(Nog) geen resultaten gevonden voor woordenlijst: $selectedNaam";
    }
}


// Sluit de verbinding
$conn->close();
?>

<br><br><a href="select_woordenlijst.php">Terug</a>
</body>
</html>