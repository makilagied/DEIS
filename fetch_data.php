<?php
$servername = "localhost";
$username = "makilagied";
$password = "password";
$dbname = "DEIS";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the assessor_assessment table and join with contestant and users tables
$sql = "SELECT aa.registration_number, u.surname, c.contesting_role, aa.total_score 
        FROM assessor_assessment AS aa
        JOIN contestant AS c ON aa.registration_number = c.registration_number
        JOIN users AS u ON aa.registration_number = u.regnumber";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Initialize an empty array to store the data
    $data = array();

    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    // Send the data as JSON to the client-side JavaScript
    echo json_encode($data);
} else {
    echo "No data found";
}

// Close the database connection
$conn->close();
?>
