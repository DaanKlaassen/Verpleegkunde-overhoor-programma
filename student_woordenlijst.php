<?php
include "source/includes/DBlogin.php";


// Haal woordenlijst op
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["woordenlijst_naam"])) {
    $selectedNaam = $_POST["woordenlijst_naam"];
} elseif ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["woordenlijst_naam"])) {
    $selectedNaam = $_GET["woordenlijst_naam"];
} else {
    // Als er nog geen woordenlijst is gekozen, toon het formulier om er een te kiezen
    echo "<a href='list.php'>Kies eerst een woordenlijstnaam</a>";
}


// Functie om de woordenlijst als CSV-bestand te downloaden
function downloadWoordenlijstCSV($conn, $selectedNaam) {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="woordenlijst.csv"');

    $output = fopen('php://output', 'w');

    // Header toevoegen
    fputcsv($output, array('Woord;', 'Voorvoegsel;', 'Betekenis;', 'Zin voor;', 'Zin achter'));

    // Gegevens ophalen en schrijven naar CSV
    $sql = "SELECT * FROM $selectedNaam";
    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {
        fputcsv($output, array($row["woord"],";", $row["voor_achtervoegsel"],";", $row["betekenis"],";", $row["zin_voor"],";", $row["zin_achter"]));
    }

    fclose($output);
}

// Verwerk het downloaden van de woordenlijst als CSV
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["woordenlijst_naam"]) && isset($_POST["download_csv"])) {
    // Haal de geselecteerde naam op uit het formulier
    $selectedNaam = $_POST["woordenlijst_naam"];

    // Roep de functie aan met de juiste parameter
    downloadWoordenlijstCSV($conn, $selectedNaam);
    exit();
}


// Toon woordenlijst
displayWoordenlijst($conn, $selectedNaam);


                // Woordenlijst weergeven
                function displayWoordenlijst($conn, $selectedNaam) {
                // Gegevens weergeven voor de gekozen woordenlijst
                $sql = "SELECT * FROM $selectedNaam";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                echo "<h2>Woordenlijst voor $selectedNaam</h2>";
                echo "<table border='1' class=tabel>
                    <tr>
                        <th>Woord</th>
                        <th>Voorvoegsel</th>
                        <th>Betekenis</th>
                        <th>Zin<br>Voor</th>
                        <th>Zin<br>Achter</th>
                    </tr>";

                    while ($row = $result->fetch_assoc()) {
                    echo "
                    <tr>
                        <td>".$row["woord"]."</td>
                        <td>".$row["voor_achtervoegsel"]."</td>
                        <td>".$row["betekenis"]."</td>
                        <td>".$row["zin_voor"]."</td>
                        <td>".$row["zin_achter"]."</td>
                    </tr>";
                    }

                    echo "
                </table>";
                } else {
                echo "<br>(Nog) geen resultaten gevonden voor woordenlijst: $selectedNaam";
                }
                }


        // Knop om de woordenlijst als CSV te downloaden
        echo "<form method='post' action='".$_SERVER['PHP_SELF']."'><br>";
        echo "<input type='hidden' name='woordenlijst_naam' value='$selectedNaam'>";
        echo "<input type='submit' name='download_csv' value='&nbsp Download Woordenlijst &nbsp.CSV '>";
        echo "
        </form>";





               
                // Sluit de verbinding
                $conn->close();
                ?>

                <!DOCTYPE html>
                <html>
                <head>
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Woordenlijst beheer</title>
                    <link rel="stylesheet" href="source/css/liststudent.css">
                </head>
                <body>

                    <br><br><a href="list_student.php" class=terug>Terug naar woordenlijsten</a>
                </body>
            </html>