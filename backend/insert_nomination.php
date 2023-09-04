<?php
$servername = "localhost";
$username = "makilagied";
$password = "password";

// Create a connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the request is a POST request
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Assuming you have established a database connection (as shown in your setup script)
    
    // Retrieve data from the POST request
    $candidateName = $_POST["candidateName"];
    $position = $_POST["position"];
    $candidateReg = $_POST["candidateReg"];

    // Perform validation as needed (e.g., check for empty fields)

    // Insert the nomination data into the "nominations" table
    $sqlInsertNomination = "INSERT INTO nominations (candidate_name, position) VALUES (?, ?)";
    
    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare($sqlInsertNomination);
    $stmt->bind_param("ss", $candidateName, $position);

    if ($stmt->execute()) {
        // Nomination data inserted successfully
        $response = ["success" => true];
    } else {
        // Error occurred during insertion
        $response = ["success" => false, "error" => "Error inserting nomination data: " . $conn->error];
    }

    // Close the prepared statement
    $stmt->close();

    // Return a JSON response to the client
    header("Content-type: application/json");
    echo json_encode($response);
} else {
    // Handle non-POST requests (e.g., redirect or show an error)
    echo "Invalid request method";
}
?>
