// Zoekfunctionaliteit bijwerken terwijl de gebruiker typt
const searchInput = document.getElementById('searchInput');
const searchResults = document.getElementById('searchResults');

searchInput.addEventListener('input', function () {
    const searchTerm = searchInput.value;

    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'search.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            searchResults.innerHTML = xhr.responseText;
        }
    };
    xhr.send('search=' + searchTerm);
});

// Formulier indienen wanneer op het icoontje wordt geklikt
const addIconLink = document.querySelector('.main-menu a');
const nieuweTabelForm = document.querySelector('.new-table');

addIconLink.addEventListener('click', function (event) {
    event.preventDefault();
    nieuweTabelForm.submit();
});

// Functie om foutmeldingen weer te geven
function showErrorMessage(message) {
    alert(message);
}
