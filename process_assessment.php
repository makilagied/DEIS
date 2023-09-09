<?php
// Check if the registration_number, committee_member_signature, and other required fields are set
if (
    isset($_POST['registration_number']) &&
    isset($_POST['committee_member_signature']) &&
    isset($_POST['score1']) &&
    isset($_POST['score2']) &&
    isset($_POST['score3']) &&
    isset($_POST['score4']) &&
    isset($_POST['score5']) &&
    isset($_POST['score6']) &&
    isset($_POST['score7']) &&
    isset($_POST['score8']) &&
    isset($_POST['score9']) &&
    isset($_POST['score10'])
) {
    // Retrieve the data from POST
    $registrationNumber = $_POST['registration_number'];
    $committeeMemberSignature = $_POST['committee_member_signature'];
    $scores = array(
        $_POST['score1'],
        $_POST['score2'],
        $_POST['score3'],
        $_POST['score4'],
        $_POST['score5'],
        $_POST['score6'],
        $_POST['score7'],
        $_POST['score8'],
        $_POST['score9'],
        $_POST['score10']
    );

    // You can perform additional validation and sanitization on the received data if needed

    // Insert the data into the database
    // Connect to your database (replace with your database credentials)
    $servername = "localhost";
    $username = "makilagied";
    $password = "password";
    $dbname = "DEIS";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute the SQL query to insert the assessment data into the database
    $sql = "INSERT INTO assessor_assessment (registration_number, committee_member_signature, criteria1, criteria2, criteria3, criteria4, criteria5, criteria6, criteria7, criteria8, criteria9, criteria10)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Prepare the SQL statement
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Error preparing SQL statement: " . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param("ssiiiiiiiiii", $registrationNumber, $committeeMemberSignature, ...$scores);

    // Execute the prepared statement
    if ($stmt->execute()) {
        // Close the database connection
        $stmt->close();
        $conn->close();

        // Provide a response to the AJAX request
        echo "Assessment submitted successfully!";
    } else {
        // Handle the case where the database insert operation fails
        echo "Error inserting data: " . $stmt->error;
    }
} else {
    // Handle the case where the required POST data is missing or empty
    echo "Error: Missing or empty POST data.";
}
?>
