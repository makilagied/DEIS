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
$sqlCreateContestantTable = "CREATE TABLE IF NOT EXISTS contestant (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    registration_number VARCHAR(255) NOT NULL,
    contesting_role VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY unique_registration_number (registration_number)
)";
if ($conn->query($sqlCreateContestantTable) === TRUE) {
    echo "Contestant table created successfully<br>";
} else {
    echo "Error creating contestant table: " . $conn->error;
}

// Create the nominations table if it doesn't exist
$sqlCreateNominationsTable = "CREATE TABLE IF NOT EXISTS nominations (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    registration_number VARCHAR(255) NOT NULL,
    contesting_role VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY unique_registration_number (registration_number)
)";

if ($conn->query($sqlCreateNominationsTable) === TRUE) {
    echo "Nominations table created successfully<br>";
} else {
    echo "Error creating nominations table: " . $conn->error;
}


// Create the assessor_assessment table
$sqlCreateAssessmentTable = "CREATE TABLE IF NOT EXISTS assessor_assessment (
    id INT AUTO_INCREMENT PRIMARY KEY,
    registration_number VARCHAR(13) NOT NULL,
    criteria1 INT NOT NULL,
    criteria2 INT NOT NULL,
    criteria3 INT NOT NULL,
    criteria4 INT NOT NULL,
    criteria5 INT NOT NULL,
    criteria6 INT NOT NULL,
    criteria7 INT NOT NULL,
    criteria8 INT NOT NULL,
    criteria9 INT NOT NULL,
    criteria10 INT NOT NULL,
    total_score INT GENERATED ALWAYS AS (criteria1 + criteria2 + criteria3 + criteria4 + criteria5 + criteria6 + criteria7 + criteria8 + criteria9 + criteria10) STORED,
    committee_member_signature VARCHAR(255) NOT NULL,
    assessment_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (registration_number) REFERENCES contestant(registration_number),
    UNIQUE KEY unique_assessment (registration_number, committee_member_signature)
)";
if ($conn->query($sqlCreateAssessmentTable) === TRUE) {
    echo "Assessments table created successfully<br>";
} else {
    echo "Error creating assessments table: " . $conn->error;
}

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
