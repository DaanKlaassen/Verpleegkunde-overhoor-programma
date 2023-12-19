<!DOCTYPE html>
<html lang="en">
<meta content="width=device-width">

<head>
  <link rel="stylesheet" href="CSS/homepage.css">
  <link rel="icon" type="image/x-icon" href="../img/icon.ico">
  <title>GildeDEVops</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
  <section>
    <!-- Main menu line on top of site -->
    <div class="main-menu">
      <a href="https://www.gildeopleidingen.nl"><img src="photos/logo.jpg" alt="logo" class="logo"></a>
      <!-- Lang Change -->
      <form method="post" class='formlout'>
        <button name='login' class='login'>Login</button>
        <button name='account' class='account'>Aanmelden</ion-icon></button>
      </form>
    </div>
    <div>
        <h1>De beste manier om Medische termen te oefenen</h1>
        <h2>Creëer gratis een account!</h2>
        <form class="pos" action="/register.php" method= "POST">
            <input type="email" name="Email"placeholder="Voer email adres in"></input>
            <button type="submit" class= "submit" >Aanmelden</button>
        </form>
    </div>
    <img src="photos/photo.png" alt="Photo.png" class= "hPhoto">
  </section>
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>