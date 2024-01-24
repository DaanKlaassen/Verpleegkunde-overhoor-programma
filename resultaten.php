<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Woordspel Resultaten</title>
  <link rel="stylesheet" href="betekenis_spel.css">
</head>
<body>
  <?php

  include "soruce/includes/DBlogin.php"; // Zorg ervoor dat je de database-verbinding hebt

    // Ontvang de resultaten van de vorige pagina
    $correctAnswers = $_GET['correctAnswers'] ?? 0;
    $wrongAnswers = $_GET['wrongAnswers'] ?? 0;
    $selectedTable = $_GET['selectedTable'] ?? ''; // Ontvang de geselecteerde tabelnaam

    // Toon de resultaten
    echo "<h2>Resultaten</h2>";
    echo "<p>Correcte antwoorden: $correctAnswers</p>";
    echo "<p>Foutieve antwoorden: $wrongAnswers</p>";
    echo $selectedTable;

    // Toon details van foutieve antwoorden
    if ($wrongAnswers > 0) {
      echo "<h3>Details foutieve antwoorden:</h3>";
      foreach ($_GET as $woord => $ingevoerdWoord) {
        // Controleer of de parameter een antwoord is
        if ($woord !== 'correctAnswers' && $woord !== 'wrongAnswers' && $woord !== 'selectedTable') {
          echo "<p>Woord: $woord, Jouw antwoord: $ingevoerdWoord</p>";
        }
      }
    }
  ?>

  <br><br><a href="select_table.php" class="terug">Terug naar tabel selecteren</a>
  <br><br><a href="betekenis_spel.php?selected_table=<?php echo $selectedTable; ?>" class="opnieuw">Opnieuw proberen</a>
</body>
</html>
