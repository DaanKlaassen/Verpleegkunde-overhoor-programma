<!DOCTYPE html>
<html lang="en">

<head>
  <title>Create Account</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <div class="login">
    <div class="container">
      <form class="form form--hidden" id="createAccount" action="register.php" method="post">
        <h1 class="form__title">Create Account</h1>
        <div class="form__message form__message--error"></div>
        <div class="form__input-group">
          <input type="text" class="form__input" id="signupUsername" name="username" autofocus placeholder="Username" />
          <div class="form__input-error-message"></div>
          <input type="text" class="form__input" id="signupEmail" name="email" autofocus placeholder="Email Address" />
          <div class="form__input-error-message"></div>
        </div>
        <div class="form__input-group">
          <input type="password" class="form__input" id="signupPassword" name="password" autofocus
            placeholder="Password" />
          <div class="form__input-error-message"></div>
          <div class="form__input-group">
            <input type="password" class="form__input" id="confirmPassword" name="confirmPassword" autofocus
              placeholder="Confirm password" />
            <div class="form__input-error-message"></div>
          </div>
        </div>
        <button class="form__button" type="submit">Continue</button>
        <p class="form__text">
          <a class="form__link" href="login.php" id="linkLogin">Already have an account? Sign in</a>
        </p>
      </form>
    </div>
  </div>
</body>

</html>

<?php

// Function to sanitize and validate input
function clean_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Process the registration form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = clean_input($_POST["username"]);
    $email = clean_input($_POST["email"]);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Hash the password for security

    // Insert user data into the database
    $sql = "INSERT INTO `inlog&register` (username, email, password) VALUES ('$username', '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
