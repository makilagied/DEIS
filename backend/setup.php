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

// Create the database if it doesn't exist
$databaseName = "DEIS";
$sqlCreateDatabase = "CREATE DATABASE IF NOT EXISTS $databaseName";
if ($conn->query($sqlCreateDatabase) === TRUE) {
    echo "Database created successfully<br>";
} else {
    echo "Error creating database: " . $conn->error;
}

// Use the database
$conn->select_db($databaseName);

// Create the roles table if it doesn't exist
$sqlCreateRolesTable = "CREATE TABLE IF NOT EXISTS roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL
)";
if ($conn->query($sqlCreateRolesTable) === TRUE) {
    echo "Roles table created successfully<br>";
} else {
    echo "Error creating roles table: " . $conn->error;
}

// Insert default roles "student", "daruso", and "admin" into the roles table if they don't exist
$roles = ["student", "daruso", "admin"];
foreach ($roles as $role) {
    $sqlInsertRole = "INSERT IGNORE INTO roles (name) VALUES ('$role')";
    if ($conn->query($sqlInsertRole) === TRUE) {
        echo "Role '$role' inserted successfully<br>";
    } else {
        echo "Error inserting role '$role': " . $conn->error;
    }
}

// Use the default role "student" for new users
$defaultRoleName = "student";
$defaultRoleID = getRoleIDByName($defaultRoleName);

// Create the users table if it doesn't exist
$sqlCreateUsersTable = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    regnumber VARCHAR(13) NOT NULL,
    password VARCHAR(255) NOT NULL,
    surname VARCHAR(255) NOT NULL,
    role_id INT NOT NULL,
    FOREIGN KEY (role_id) REFERENCES roles(id)
)";
if ($conn->query($sqlCreateUsersTable) === TRUE) {
    echo "Users table created successfully<br>";
} else {
    echo "Error creating users table: " . $conn->error;
}

// Create the nominations table if it doesn't exist
$sqlCreateNominationsTable = "CREATE TABLE IF NOT EXISTS nominations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    candidate_name VARCHAR(255) NOT NULL,
    position VARCHAR(255) NOT NULL,
    user_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id)
)";
if ($conn->query($sqlCreateNominationsTable) === TRUE) {
    echo "Nominations table created successfully<br>";
} else {
    echo "Error creating nominations table: " . $conn->error;
}

// Create the assessments table if it doesn't exist
$sqlCreateAssessmentsTable = "CREATE TABLE IF NOT EXISTS assessments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    candidate_name VARCHAR(255) NOT NULL,
    position VARCHAR(255) NOT NULL,
    score INT NOT NULL,
    user_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id)
)";
if ($conn->query($sqlCreateAssessmentsTable) === TRUE) {
    echo "Assessments table created successfully<br>";
} else {
    echo "Error creating assessments table: " . $conn->error;
}

// ...

// Create the otp_requests table if it doesn't exist
$sqlCreateOTPTable = "CREATE TABLE IF NOT EXISTS otp_requests (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    request_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
)";
if ($conn->query($sqlCreateOTPTable) === TRUE) {
    echo "OTP requests table created successfully<br>";
} else {
    echo "Error creating OTP requests table: " . $conn->error;
}

// ...

// Populate the table with random data and default role "student"
$numberOfEntries = 100;
$randomSurnames = ["Smith", "Johnson", "Williams", "Jones", "Brown", "Davis", "Miller", "Wilson", "Moore", "Taylor"];

$existingRegNumbers = []; // To keep track of existing regnumbers

for ($i = 0; $i < $numberOfEntries; $i++) {
    do {
        $regNumber = generateRandomRegNumber();
    } while (in_array($regNumber, $existingRegNumbers)); // Check for duplicates
    
    // Add the new regnumber to the list of existing regnumbers
    $existingRegNumbers[] = $regNumber;
    
    $hashedPassword = md5("DEIS"); // Hash the default password
    $randomSurname = $randomSurnames[array_rand($randomSurnames)];

    $sqlInsertData = "INSERT INTO users (regnumber, password, surname, role_id) VALUES ('$regNumber', '$hashedPassword', '$randomSurname', '$defaultRoleID')";
    $conn->query($sqlInsertData);
}

// ...

echo "Data populated successfully<br>";

// Function to generate a random registration number
function generateRandomRegNumber() {
    $year = rand(2020, 2023);
    $level = str_pad(rand(1, 6), 2, "0", STR_PAD_LEFT);
    $sequence = str_pad(rand(0, 99999), 5, "0", STR_PAD_LEFT);
    return "$year-$level-$sequence";
}

// Function to get role ID by name
function getRoleIDByName($roleName) {
    global $conn;
    $sql = "SELECT id FROM roles WHERE name = '$roleName'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row["id"];
    } else {
        return null;
    }
}

$conn->close();
?>
