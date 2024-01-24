<!DOCTYPE html>
<html lang="en">
<meta content="width=device-width">

<head>
  <link rel="stylesheet" href="./Source/CSS/homepage.css">
  <link rel="icon" type="image/x-icon" href="./Assets/icons/icon.ico">
  <title>GildeDEVops</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
  <section>
    <!-- Main menu line on top of site -->
    <div class="main-menu">
      <a href="https://www.gildeopleidingen.nl"><img src="./Assets/Images/logo.jpg" alt="logo" class="logo"></a>
      <div class="Line"></div>
        <a href= "login.php"><button name='login' class='login'>Login</button></a>
        <a href="create-account.php"><button name='account' class='account'>Aanmelden</ion-icon></button></a>
    </div>
    <div>
        <h1>De beste manier om Medische termen te oefenen</h1>
        <h2>Creëer gratis een account!</h2>
        <form class="pos" action="./registreren.php" method= "POST">
            <input type="email" name="Email"placeholder="Voer email adres in"></input>
            <button type="submit" class= "submit" >Aanmelden</button>
        </form>
    </div>
    <img src="./Assets/Images/photo.png" alt="Photo.png" class= "hPhoto">
  </section>
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>