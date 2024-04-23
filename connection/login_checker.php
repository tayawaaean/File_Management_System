<?php
// Start or resume the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect to the login page if not logged in
    header("Location: login.php");
    exit();
}

// Include your database connection file
include 'db_connection.php'; // Make sure to replace 'db_connection.php' with your actual file name

// Prepare and execute the query using a prepared statement
$stmt = $conn->prepare("SELECT * FROM users WHERE username=?");
$stmt->bind_param("s", $_SESSION['username']);
$stmt->execute();
$result = $stmt->get_result();

// Check if the user was found
if ($result->num_rows > 0) {
    // Fetch user details
    $user = $result->fetch_assoc();
} else {
    // User not found, handle accordingly (redirect or display error)
    $errorMessage = "User not found.";
}

// Pass the user data to JavaScript
echo '<script>';
echo 'const userData = ' . json_encode($user) . ';'; // Convert user data to JSON
echo '</script>';
?>
