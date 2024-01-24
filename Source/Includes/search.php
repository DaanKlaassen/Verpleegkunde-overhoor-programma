<?php
include "DBlogin.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["search"])) {
    $searchTerm = $_POST["search"];
    $showTablesSql = "SHOW TABLES LIKE '%$searchTerm%'";
    $tablesResult = $conn->query($showTablesSql);

    while ($row = $tablesResult->fetch_row()) {
        $tableName = $row[0];
        $countRowsSql = "SELECT COUNT(*) as count FROM $tableName";
        $countRowsResult = $conn->query($countRowsSql);
        $rowCount = $countRowsResult->fetch_assoc()['count'];

        // Output the search results
        echo "<a href='woordenlijst.php?woordenlijst_naam=$tableName'><li class='bg'>$tableName<br> $rowCount definities </li></a>";
    }
}
?>
