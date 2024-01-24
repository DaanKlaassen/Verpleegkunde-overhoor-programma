function filterWordLists() {
    // Get the user's input from the search input field
    var searchInput = document.getElementById("searchInput").value.toLowerCase();

    // Get all the word list boxes
    var wordListContainers = document.getElementsByClassName("testbox1");

    var hasResults = false; // Flag to track if there are any results

    // Loop through each word list box
    for (var i = 0; i < wordListContainers.length; i++) {
        // Get the title of the current word list box
        var title = wordListContainers[i].getElementsByClassName("listbox-title")[0].innerText.toLowerCase();

        // Show or hide the word list box based on the search input
        if (title.includes(searchInput)) {
            wordListContainers[i].style.display = "block";  // Show the word list box
            hasResults = true; // Set the flag to true
        } else {
            wordListContainers[i].style.display = "none";   // Hide the word list box
        }
    }

    // Display a message if there are no results
    if (!hasResults) {
        var noResultsMessage = document.createElement("div");
        noResultsMessage.className = "no-results-message";
        noResultsMessage.innerText = "Geen resultaten";
        
        // Append the message to the container
        document.getElementById("wordListContainer").appendChild(noResultsMessage);
    } else {
        // Remove any existing no results message
        var existingMessage = document.querySelector(".no-results-message");
        if (existingMessage) {
            existingMessage.remove();
        }
    }
}

// Move clearFilter outside of filterWordLists
function clearFilter() {
    // Clear the search input
    document.getElementById("searchInput").value = "";

    // Show all word list boxes
    var wordListContainers = document.getElementsByClassName("testbox1");
    for (var i = 0; i < wordListContainers.length; i++) {
        wordListContainers[i].style.display = "block";
    }

    // Remove any existing no results message
    var existingMessage = document.querySelector(".no-results-message");
    if (existingMessage) {
        existingMessage.remove();
    }
}
