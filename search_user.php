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

if (!empty($data->registrationNumber)) {
    // Sanitize and query your database to retrieve user information based on registration number
    $registrationNumber = mysqli_real_escape_string($conn, $data->registrationNumber);

    // Prepare a statement
    $stmt = $conn->prepare("SELECT * FROM users WHERE regnumber = ?");
    if ($stmt === false) {
        die("Database error. Please try again later.");
    }

    // Bind the parameter
    $stmt->bind_param("s", $registrationNumber);

    // Execute the statement
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        // Assuming you have a users table with columns: user_id, name, email, etc.
        $row = $result->fetch_assoc();
        
        // Create an associative array for the response
        $response = [
            // "user_id" => $row['id'],
            "Name" => $row['surname'],
            "Reg_Number" => $row['regnumber']
        ];

        // Send the JSON response
        header("Content-Type: application/json");
        echo json_encode($response);
    } else {
        echo json_encode(["error" => "User not found"]);
    }

    // Close the statement and the database connection
    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["error" => "Invalid request"]);
}
?>
