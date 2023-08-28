<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start(); // Start the session

// Database connection parameters
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $regNumber = $_POST["regnumber"];
    $password = $_POST["password"];
    
    // Hash the password (consider using password_hash() function)
    $hashedPassword = md5($password); // Not recommended for production
    
    // SQL query to check user credentials
    $sql = "SELECT * FROM users WHERE regnumber = '$regNumber' AND password = '$hashedPassword'";
    $result = $conn->query($sql);
 
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['regnumber'] = $user['regnumber'];

        // Redirect user based on their role
        switch ($user["role_id"]) {
            case 1: // Students
                header("Location: ../user_dashboard.php");
                exit();
                break;
            case 2: // Daruso
                header("Location: ../dec_dashboard.php");
                exit();
                break;
            case 3: // Admin
                header("Location: ../admin_dashboard.php");
                exit();
                break;
            default:
                $loginError = "Invalid credentials!";
                break;
        }
    } else {
        $loginError = "Invalid credentials!";
    }
}

$conn->close();

// Redirect back to the login page with the error message
header("Location: ../login.php?error=" . urlencode($loginError));
exit();
?>
