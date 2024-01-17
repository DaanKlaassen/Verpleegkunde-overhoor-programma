<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Woordspel</title>
  <link rel="stylesheet" href="betekenis_spel.css">
</head>
<body>
  <?php
    include "DBlogin.php"; // Zorg ervoor dat je de database-verbinding hebt

    $selectedTable = $_GET["selected_table"] ?? '';

    if (!empty($selectedTable)) {
      // Haal alle zinnen op uit de gekozen tabel
      $result = $conn->query("SELECT * FROM $selectedTable");

      // Plaats de vragen in een array
      $questions = [];
      while ($row = $result->fetch_assoc()) {
        $questions[] = $row;
      }

      // Willekeurig ordenen van de vragen
      shuffle($questions);

      // Houd bij hoeveel vragen correct en fout zijn
      $correctAnswers = 0;
      $wrongAnswers = 0;
      $wrongAnswersDetails = [];

      // Verwerk de antwoorden na het indienen
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        foreach ($_POST as $woord => $ingevoerdWoord) {
          // Controleer of het ingevoerde woord correct is
          if (strtolower($ingevoerdWoord) == strtolower($woord)) {
            $correctAnswers++;
          } else {
            $wrongAnswers++;
            // Onthoud het juiste antwoord bij foutieve antwoorden
            $wrongAnswersDetails[$woord] = $ingevoerdWoord;
          }
        }

        // Doorsturen naar de resultatenpagina
        header("Location: resultaten.php?correctAnswers=$correctAnswers&wrongAnswers=$wrongAnswers");
        exit(); // Zorg ervoor dat het script stopt na de doorverwijzing
      }

      // Toon het formulier voor het invoeren van woorden
      echo "<form action='' method='post'>";
      foreach ($questions as $question) {
        $zinVoor = $question['zin_voor'];
        $zinAchter = $question['zin_achter'];
        $juisteWoord = $question['woord'];

        // Vraag de gebruiker om het juiste woord in te vullen
        echo "<p>$zinVoor <input type='text' name='$juisteWoord' required> $zinAchter</p>";
      }
      echo "<input type='submit' value='Controleer antwoorden'>";
      echo "</form>";

    } else {
      echo "<p>Geen tabel geselecteerd.</p>";
    }
  ?>

  <br><br><a href="select_table.php" class="terug">Terug naar tabel selecteren</a>
</body>
</html>
