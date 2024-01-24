function checkLogin() {
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;

    // Controleer de inloggegevens
    if (username === "leraar" && password === "Test123") {
        // Sla inlogstatus op
        localStorage.setItem("loggedIn", "true");

        // Wijzig de actie van het formulier na een succesvolle inlogpoging
        document.getElementById("loginForm").action = "list.php";

        alert("Inloggen gelukt!");
        return true; // Laat het formulier verzenden toe
    } else {
        alert("Ongeldige gebruikersnaam of wachtwoord.");
        return false; // Stop het formulier verzenden
    }
}
