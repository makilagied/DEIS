<?php
// Include your database connection here
$servername = "localhost";
$username = "makilagied";
$password = "password";
$dbname = "DEIS";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["selected_users"])) {
    // Get the selected users array
    $selectedUsers = $_POST["selected_users"];
    
    // Get the new role ID
    $newRoleId = $_POST["new_role_id"]; // Make sure to add this to your AJAX data
    
    // Prepare and execute the update query for each user
    foreach ($selectedUsers as $userId) {
        $sqlUpdateRole = "UPDATE users SET role_id = ? WHERE id = ?";
        $stmtUpdateRole = $conn->prepare($sqlUpdateRole);
        $stmtUpdateRole->bind_param("ii", $newRoleId, $userId);
        $stmtUpdateRole->execute();
        $stmtUpdateRole->close();
    }

    echo "Role assigned successfully";
} else {
    echo "No users selected";
}

$conn->close();
?>
