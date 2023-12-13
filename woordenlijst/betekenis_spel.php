<?php
include "DBlogin.php";

// Functie om het aantal woorden in de database te tellen
function countWoordenInDatabase($conn) {
    $countSql = "SELECT COUNT(*) as count FROM test";
    $countResult = $conn->query($countSql);

    if ($countResult->num_rows > 0) {
        $countRow = $countResult->fetch_assoc();
        return $countRow['count'];
    }

    return 0;
}

// Start de sessie
session_start();

// Controleer of de lijst met gebruikte woorden in de sessie bestaat en initialiseer deze indien nodig
if (!isset($_SESSION['gebruikte_woorden'])) {
    $_SESSION['gebruikte_woorden'] = [];
}

// Initialisatie van de tellers, maar alleen als ze nog niet zijn ingesteld
if (!isset($_SESSION['correcte_woorden'])) {
    $_SESSION['correcte_woorden'] = 0;
}
if (!isset($_SESSION['foutieve_woorden'])) {
    $_SESSION['foutieve_woorden'] = 0;
}

// Controleer of er nog ongebruikte woorden zijn
if (!empty($_SESSION['gebruikte_woorden']) && count($_SESSION['gebruikte_woorden']) >= countWoordenInDatabase($conn)) {
    echo "Geen nieuwe woorden beschikbaar. Je hebt alle woorden gehad.";

    // Toon het resultaat
    echo "<p>Correcte woorden: {$_SESSION['correcte_woorden']}</p>";
    echo "<p>Foutieve woorden: {$_SESSION['foutieve_woorden']}</p>";

    // Reset de gebruikte woordenlijst en tellers
    $_SESSION['gebruikte_woorden'] = [];
    $_SESSION['correcte_woorden'] = 0;
    $_SESSION['foutieve_woorden'] = 0;
}
else {
    // Haal een willekeurig woord uit de database dat nog niet is gebruikt
    $sql = "SELECT * FROM test WHERE woord NOT IN ('" . implode("','", $_SESSION['gebruikte_woorden']) . "') ORDER BY RAND() LIMIT 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $zinVoor = $row["zin_voor"];
        $woord = $row["woord"];
        $zinAchter = $row["zin_achter"];

        // Voeg het gebruikte woord toe aan de lijst
        $_SESSION['gebruikte_woorden'][] = $woord;

        // Update de sessie-variabele voor gebruikte woorden
        $_SESSION['gebruikte_woorden'][] = $woord;
    } else {
        echo "Geen nieuwe woorden beschikbaar. Je hebt alle woorden gehad.";

        // Toon het resultaat
        echo "<p>Correcte woorden: {$_SESSION['correcte_woorden']}</p>";
        echo "<p>Foutieve woorden: {$_SESSION['foutieve_woorden']}</p>";

        // Reset de gebruikte woordenlijst en tellers
        $_SESSION['gebruikte_woorden'] = [];
        $_SESSION['correcte_woorden'] = 0;
        $_SESSION['foutieve_woorden'] = 0;
    }

    // Sluit de databaseverbinding
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Woordspel</title>
</head>
<body>

<h2>Woordspel</h2>
<p>Vul het ontbrekende woord in:</p>
<p><?php echo $zinVoor; ?> _______ <?php echo $zinAchter; ?></p>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label for="woord">Jouw antwoord:</label>
    <input type="text" name="woord" required>
    <input type="submit" value="Controleer">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["woord"])) {
    $ingevoerdWoord = strtolower($_POST["woord"]);
    $woordInDatabase = strtolower($woord);
    
    // Controleer of het ingevoerde woord overeenkomt met het woord in de database
    if ($ingevoerdWoord == $woordInDatabase) {
        echo "<p>Correct! Het juiste woord is '$woord'.</p>";
        $_SESSION['correcte_woorden']++;
    } else {
        echo "<p>Helaas, het ingevoerde woord is niet correct. Probeer opnieuw.</p>";
        $_SESSION['foutieve_woorden']++;
    }

    // Update de sessie-variabele voor gebruikte woorden
    $_SESSION['gebruikte_woorden'][] = $woord;
}
?>

<!-- Knop om het spel opnieuw te starten -->
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <input type="submit" name="reset" value="Opnieuw starten">
</form>

</body>
</html>
