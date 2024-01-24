function openPopup(tableName) {
    var flipcardLink = document.getElementById('flipcardLink');
    var zinInvullenLink = document.getElementById('zinInvullenLink');

    flipcardLink.href = "flitskaarten.php?selected_table=" + encodeURIComponent(tableName);
    zinInvullenLink.href = "betekenis_spel.php?selected_table=" + encodeURIComponent(tableName);

    var popup = document.getElementById("myPopup");
    popup.style.display = "block";
}

function closePopup() {
    var popup = document.getElementById("myPopup");
    popup.style.display = "none";
}
