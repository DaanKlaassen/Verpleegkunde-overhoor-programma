<!DOCTYPE html>
<html lang="en">

<head>
    <meta content="width=device-width" name="viewport">
    <link rel="stylesheet" href="Source/CSS/index.css">
    <link rel="stylesheet" href="Source/CSS/nav.css">
    <link rel="icon" type="image/x-icon" href="Assets/Icons/icon.ico">

    <!-- javascript -->
    <script src="source/js/openwindow.js"></script>

    <!-- ionicons -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <?php include "source/includes/snav.php"?>

  <title>GildeDevOps</title>
  
</head>

<body>

<!-- topbar -->
<div class="main-menu"> 
</div>

<div class="topbody">
<h1> Welkom terug, Max</h1>
<h2> Er staan 4 Woordenlijsten voor je klaar</h2>
</div>

<div class="mainbody">

  <div class="testbox1">
    <span class="listbox-title">Cardiology IV</span>
    <br>
    <span class="listbox-progress">Niet gestart</span>
    <div class="listbox-line"></div>
    <span class="listbox-description">Een woordenlijst over de meerdere spiergroepen van het hart</span>
    <div class="listbox-line"></div>
    <span class="listbox-amount">12 woorden</span>
    <button class="listbox-startbutton" onclick="openPopup()">Start</button>   
  </div>


  <div class="popup" id="myPopup">
      <span class="popupclose" onclick="closePopup()">&times;</span>
      <!-- popup content -->
      <p>Hoe wil je oefenen?</p>

      <div class="gameselection">

        <div class="flitskaartbutton">
          <a href="#"> <img src="assets/images/flitskaarten.png" alt="flitskaarten"> </a>
          <p>Flitskaarten</p>
        </div>

        <div class="woordzoekerbutton">
          <a href="#"> <img src="assets/images/woordzoekericon.png" alt="woordzoeker"> </a>
          <p>Woordzoeker</p>
        </div>
        
      </div>
  </div>


</body>

</html>