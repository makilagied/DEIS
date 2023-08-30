<?php
// Include your database connection here
$servername = "localhost";
$username = "makilagied";
$password = "password";
$dbname = "DEIS";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the search input
    $searchInput = $_POST["searchInput"];
    
    // Perform search in the users table based on both name and regnumber
    $sqlSearch = "SELECT id, surname, regnumber FROM users WHERE surname = ? OR regnumber = ?";
    $stmt = $conn->prepare($sqlSearch);
    $stmt->bind_param("ss", $searchInput, $searchInput);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $userResults = array();
    while ($row = $result->fetch_assoc()) {
        $userResults[] = $row;
    }
    
    if (!empty($userResults)) {
        // Users found, return the list of users as JSON
        echo json_encode($userResults);
    } else {
        // No users found
        echo "No users found";
    }
    
    $stmt->close();
}

$conn->close();
?>
