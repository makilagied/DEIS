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
    
    // Perform exact search in the users table
    $sqlSearch = "SELECT id, surname, regnumber FROM users WHERE surname = ? OR regnumber = ?";
    $stmt = $conn->prepare($sqlSearch);
    $stmt->bind_param("ss", $searchInput, $searchInput);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $users = array();

    while ($row = $result->fetch_assoc()) {
        $users[] = array(
            'id' => $row["id"],
            'surname' => $row["surname"],
            'regnumber' => $row["regnumber"]
        );
    }
    
    // Return user information as JSON
    echo json_encode($users);
    
    $stmt->close();
}

$conn->close();
?>
