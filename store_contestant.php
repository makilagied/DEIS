<?php
// Assuming you have a database connection established
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

// Get the JSON data sent from the JavaScript
$data = json_decode(file_get_contents("php://input"));

if (!empty($data->registrationNumber) && !empty($data->contestingRole)) {
    // Sanitize and insert the contestant information into your contestant table
    $registrationNumber = mysqli_real_escape_string($conn, $data->registrationNumber);
    $contestingRole = mysqli_real_escape_string($conn, $data->contestingRole);

    // Example query (please adjust according to your database schema)
    $insertQuery = "INSERT INTO contestant (registration_number, contesting_role) VALUES ('$registrationNumber', '$contestingRole')";
    
    if (mysqli_query($conn, $insertQuery)) {
        // Contestant information stored successfully
        echo "Contestant stored successfully";
    } else {
        // Failed to store contestant
        echo "Failed to store contestant";
    }
} else {
    echo "Invalid request";
}

// Close the database connection (remember to adjust this depending on your database connection method)
mysqli_close($conn);
?>
