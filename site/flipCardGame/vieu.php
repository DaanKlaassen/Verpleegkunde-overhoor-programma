<?php include "Controller.php"?>
<!DOCTYPE HTML>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Game</title>
  <link rel="stylesheet" href="Speel.css">
</head>
<body>
  <div class="contener">
  </div>
  <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <input class="buttons prievie" type="submit" name="decrement" value="back">
    <input class="buttons next" type="submit" name="increment" value="next">
  </form>
</body>
<footer>
  
</footer>
</html>