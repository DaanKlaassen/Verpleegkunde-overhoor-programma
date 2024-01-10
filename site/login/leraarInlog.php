<<<<<<<< HEAD:site/login/leraarInlog.php
<!DOCTYPE html>
<html>

<head>
  <title>Leraren Login</title>
  <link rel="stylesheet" type="text/css" href="../CSS/login.css">
</head>

<body>
<div class="main-menu">
    <a href="https://www.gildeopleidingen.nl"><img src="../photos/logo.jpg" alt="logo" class="logo"></a>
    <div class="Line"></div>
</div>
  <div class="login">
    <div class="container">
      <form class="form" method="POST" id="login">
        <h1 class="form__title">Leraren Login</h1>
        <div class="form__message form__message--error"></div>
        <div class="form__input-group">
          <input name="username" type="text" class="form__input" autofocus placeholder="Username" />
          <div class="form__input-error-message"></div>
        </div>
        <div class="form__input-group">
          <input name="password" type="password" class="form__input" placeholder="Password" />
          <div class="form__input-error-message"></div>
        </div>
        <button class="form__button" type="submit">Continue</button>
        <p class="form__text">
            <a class="form__link" href="login.php" id="linkCreateAccount">Student login</a>
        </p>
        <p class="form__text">
          <a class="form__link" href="lerarenCreate-account.php" id="linkCreateAccount">Don't have an account? Create
            account</a>
        </p>
      </form>
    </div>
  </div>
  <script src="src/client/js/main.js"></script>
</body>

</html>
========
<!DOCTYPE html>
<html>

<head>
  <title>Login</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
  <div class="login">
    <div class="container">
      <form class="form" method="POST" id="login">
        <h1 class="form__title">Login</h1>
        <div class="form__message form__message--error"></div>
        <div class="form__input-group">
          <input name="username" type="text" class="form__input" autofocus placeholder="Username" />
          <div class="form__input-error-message"></div>
        </div>
        <div class="form__input-group">
          <input name="password" type="password" class="form__input" placeholder="Password" />
          <div class="form__input-error-message"></div>
        </div>
        <button class="form__button" type="submit">Continue</button>
        <p class="form__text">
          <a href="#" class="form__link">Forgot your password?</a>
        </p>
        <p class="form__text">
          <a class="form__link" href="create-account.php" id="linkCreateAccount">Don't have an account? Create
            account</a>
        </p>
      </form>
    </div>
  </div>
  <script src="src/client/js/main.js"></script>
</body>

</html>
>>>>>>>> 9d4ae41c6ecffee81d9ad52bbd940734fae5a1e0:registreren/login.php
