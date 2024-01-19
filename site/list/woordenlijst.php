<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Woordenlijst beheer</title>
    <link rel="stylesheet" href="list2.css">
    <script src="list.js"></script>
</head>
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
echo "<input type='submit' name='add' value='Voeg toe'>";
echo "</form></div>";
echo "<a href=\"list.php\" class=\"terug\">Terug naar woordenlijsten</a>";

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
        echo '<script>window.onload = function() { window.location.href = "'.$_SERVER['PHP_SELF'].'?woordenlijst_naam='.$selectedNaam.'"; }</script>';
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
        echo '<script>window.onload = function() { window.location.href = "'.$_SERVER['PHP_SELF'].'?woordenlijst_naam='.$selectedNaam.'"; }</script>';
        exit();
    } else {
        echo "Error: " . $deleteSql . "<br>" . $conn->error;
    }
}


// Gegevens bewerken
if (isset($_GET["edit"])) {
    $editId = $_GET["edit"];
    $editSql = "SELECT * FROM $selectedNaam WHERE id = $editId";
    $editResult = $conn->query($editSql);

    if ($editResult->num_rows > 0) {
        $editRow = $editResult->fetch_assoc();
        echo "<div class=foamb><h3>Bewerk gegevens</h3>";
        echo "<form method='post' action='".$_SERVER['PHP_SELF']."#editForm'>";
        echo "<input type='hidden' name='woordenlijst_naam' value='$selectedNaam'>";
        echo "<input type='hidden' name='edit_id' value='$editId'>";
        echo "Woord: <input type='text' name='edit_woord' value='" . $editRow["woord"] . "' required><br>";
        echo "Voorvoegsel: ";
        echo "<select name='edit_voor_achtervoegsel'>";
        echo "<option value=''>Nee</option>";
        echo "<option value='Voorvoegsel' " . ($editRow["voor_achtervoegsel"] == 'Voorvoegsel' ? 'selected' : '') . ">Voorvoegsel</option>";
        echo "<option value='Achtervoegsel' " . ($editRow["voor_achtervoegsel"] == 'Achtervoegsel' ? 'selected' : '') . ">Achtervoegsel</option>";
        echo "</select><br>";
        echo "Betekenis: <input type='text' name='edit_betekenis' value='" . $editRow["betekenis"] . "' required><br>";
        echo "Zin Voor: <input type='text' name='edit_zin_voor' value='" . $editRow["zin_voor"] . "'><br>";
        echo "Zin Achter: <input type='text' name='edit_zin_achter' value='" . $editRow["zin_achter"] . "'><br>";
        echo "<input type='submit' name='update' value='Bijwerken'>";
        echo "<a name='editForm'></a>";
        echo "<input type='submit' name='cancel' value='Annuleren'>";
        echo "</form></div>";

        // JavaScript om naar de bodem van de pagina te scrollen
        echo "<script>window.scrollTo(0,document.body.scrollHeight);</script>";
    }
}


// Gegevens bijwerken
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["woordenlijst_naam"]) && isset($_POST["update"])) {
    $editId = $_POST["edit_id"];
    $editWoord = $_POST["edit_woord"];
    $editVoorvoegsel = $_POST["edit_voor_achtervoegsel"];
    $editBetekenis = $_POST["edit_betekenis"];
    $editZinVoor = $_POST["edit_zin_voor"];
    $editZinAchter = $_POST["edit_zin_achter"];

    // Gegevens bijwerken op basis van $editId
    $updateSql = "UPDATE $selectedNaam SET 
                    woord='$editWoord', 
                    voor_achtervoegsel='$editVoorvoegsel', 
                    betekenis='$editBetekenis', 
                    zin_voor='$editZinVoor', 
                    zin_achter='$editZinAchter' 
                  WHERE id=$editId";

    if ($conn->query($updateSql) === TRUE) {
        echo '<script>window.onload = function() { window.location.href = "'.$_SERVER['PHP_SELF'].'?woordenlijst_naam='.$selectedNaam.'"; }</script>';
        exit();
    } else {
        echo "Error: " . $updateSql . "<br>" . $conn->error;
    }
}


// Annuleren van bewerken
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["woordenlijst_naam"]) && isset($_POST["cancel"])) {
    echo '<script>window.location.href = "'.$_SERVER['PHP_SELF'].'?woordenlijst_naam='.$selectedNaam.'#editForm";</script>';
    exit();
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
                    <td><a href='".$_SERVER['PHP_SELF']."?edit=".$row["id"]."&woordenlijst_naam=$selectedNaam' class=verwijder>Bewerk</a> | <a href='".$_SERVER['PHP_SELF']."?delete=".$row["id"]."&woordenlijst_naam=$selectedNaam' class=verwijder onclick='return confirmDeleteRecord()'>Verwijder</a></td>
                </tr>";
        }

        echo "</table>";
    } else {
        echo "<br>(Nog) geen resultaten gevonden voor woordenlijst: $selectedNaam";
    }
}


// Knop om de gehele tabel te verwijderen met bevestiging
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

<div class="foam">
    <h3>Importeer gegevens uit Excel</h3>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
        <input type="hidden" name="woordenlijst_naam" value="<?php echo $selectedNaam; ?>">
        Selecteer Excel-bestand: <input type="file" name="excel_file" accept=".xlsx, .xls" required><br>
        <input type="submit" name="import_excel" value="Importeer">
    </form>
</div>

<br><br><a href="list.php" class=terug>Terug naar woordenlijsten</a>
</body>
</html>