<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Selecteer Tabel</title>
</head>
<body>
  <?php
    include "source/includes/DBlogin.php"; // Zorg ervoor dat je de database-verbinding hebt

    // Verwerk het formulier voor het selecteren van een tabel
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["select_table"])) {
      $selectedTable = $_POST["selected_table"];
      // Stuur door naar de woordspelpagina met de geselecteerde tabel
      header("Location: betekenis_spel.php?selected_table=$selectedTable");
      exit();
    }

    // Haal alle tabelnamen op
    $tableNamesResult = $conn->query("SHOW TABLES");
  ?>

  <form action="" method="post">
    <label for="selected_table">Selecteer een tabel:</label>
    <select name="selected_table">
      <?php
        while ($tableName = $tableNamesResult->fetch_row()[0]) {
          echo "<option value='$tableName'>$tableName</option>";
        }
      ?>
    </select>
    <input type="submit" name="select_table" value="Selecteer">
  </form>
</body>
</html>
