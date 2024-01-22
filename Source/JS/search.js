function filterWordLists() {
    // Get the user's input from the search input field
    var searchInput = document.getElementById("searchInput").value.toLowerCase();

    // Get all the word list boxes
    var wordListContainers = document.getElementsByClassName("testbox1");

    // Loop through each word list box
    for (var i = 0; i < wordListContainers.length; i++) {
        // Get the title of the current word list box
        var title = wordListContainers[i].getElementsByClassName("listbox-title")[0].innerText.toLowerCase();

        // Show or hide the word list box based on the search input
        if (title.includes(searchInput)) {
            wordListContainers[i].style.display = "block";  // Show the word list box
        } else {
            wordListContainers[i].style.display = "none";   // Hide the word list box
        }
    }

    function clearFilter() {
        // Clear the search input
        document.getElementById("searchInput").value = "";
    }
}
