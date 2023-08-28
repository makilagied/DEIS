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

// Get the POST data
$data = json_decode(file_get_contents("php://input"));

$surname = $data->surname;
$regName = $data->regName;

// Check user existence in the database
$userExists = checkUserExistence($surname, $regName, $conn);

if ($userExists) {
    // Get the user ID based on surname and regnumber
    $user_id = getUserId($surname, $regName, $conn);
    
    // Check if the user has already requested an OTP
    if (hasRequestedOTP($user_id, $conn)) {
        $timestamp = getOTPRequestTimestamp($user_id, $conn);
        $response = array("exists" => true, "message" => "OTP already requested for this user on " . $timestamp);
    } else {
        // Generate OTP and store OTP request in the database
        $otp = generateOTP();

        // Store OTP request history
        $sqlInsertOTPRequest = "INSERT INTO otp_requests (user_id) VALUES (?)";
        $stmt = $conn->prepare($sqlInsertOTPRequest);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();

        $response = array("exists" => true, "otp" => $otp, "message" => "");
    }
} else {
    $response = array("exists" => false);
}

header("Content-Type: application/json");
echo json_encode($response);

// Check user existence in the database
function checkUserExistence($surname, $regName, $conn) {
    $sql = "SELECT COUNT(*) AS user_count FROM users WHERE surname = ? AND regnumber = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $surname, $regName);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $userCount = $row['user_count'];
    return $userCount > 0;
}

// Get user ID based on surname and regnumber
function getUserId($surname, $regName, $conn) {
    $sql = "SELECT id FROM users WHERE surname = ? AND regnumber = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $surname, $regName);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row['id'];
}

// Check if the user has already requested an OTP
function hasRequestedOTP($user_id, $conn) {
    $sql = "SELECT COUNT(*) AS request_count FROM otp_requests WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $requestCount = $row['request_count'];
    return $requestCount > 0;
}

// Get timestamp of the previous OTP request
function getOTPRequestTimestamp($user_id, $conn) {
    $sql = "SELECT request_time FROM otp_requests WHERE user_id = ? ORDER BY request_time DESC LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row['request_time'];
}


// Generate OTP
function generateOTP() {
    // Characters to choose from
    $lowercaseLetters = 'abcdefghijklmnopqrstuvwxyz';
    $uppercaseLetters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $digits = '0123456789';
    
    // Generate OTP
    $otp = '';
    
    // Add one character from lowercase letters set
    $otp .= $lowercaseLetters[mt_rand(0, strlen($lowercaseLetters) - 1)];
    
    // Add one character from uppercase letters set
    $otp .= $uppercaseLetters[mt_rand(0, strlen($uppercaseLetters) - 1)];
    
    // Add one character from digits set
    $otp .= $digits[mt_rand(0, strlen($digits) - 1)];
    
    // Add one extra character from either sets
    $extraCharacters = $lowercaseLetters . $uppercaseLetters . $digits;
    $otp .= $extraCharacters[mt_rand(0, strlen($extraCharacters) - 1)];
    
    return $otp;
}


function countCombinations($n, $r) {
    return factorial($n) / (factorial($r) * factorial($n - $r));
}

function factorial($n) {
    if ($n <= 1) {
        return 1;
    } else {
        return $n * factorial($n - 1);
    }
}

function generateRandomString($length, $charset) {
    $str = '';
    $charsetLength = strlen($charset);
    for ($i = 0; $i < $length; $i++) {
        $str .= $charset[mt_rand(0, $charsetLength - 1)];
    }
    return $str;
}

$conn->close();
?>
