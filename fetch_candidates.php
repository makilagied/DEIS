<?php
// Establish a database connection (modify these settings as per your database configuration)
$servername = "localhost";
$username = "makilagied";
$password = "password";
$dbname = "DEIS";
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the selected role from the POST request
$data = json_decode(file_get_contents("php://input"));

if (!empty($data->selectedRole)) {
    $selectedRole = mysqli_real_escape_string($conn, $data->selectedRole);

    // Query to fetch candidate names and registration numbers based on the selected role
    $query = "SELECT u.surname, u.regnumber
              FROM contestant c
              JOIN users u ON c.registration_number = u.regnumber
              WHERE c.contesting_role = '$selectedRole'";

    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $candidates = array();
        while ($row = $result->fetch_assoc()) {
            $candidates[] = array(
                "surname" => $row["surname"],
                "regnumber" => $row["regnumber"]
            );
        }

        // Send the candidate data as a JSON response
        echo json_encode($candidates);
    } else {
        // No candidates found for the selected role
        echo json_encode(array());
    }
} else {
    // Invalid request
    echo json_encode(array("error" => "Invalid request"));
}

// Close the database connection
$conn->close();
?>
