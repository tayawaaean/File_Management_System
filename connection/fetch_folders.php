<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect to login page or handle unauthorized access
    header("Location: login.php");
    exit();
}

// Include necessary files
include '../connection/connection.php';

// Get the username from the session
$username = $_SESSION['username'];

// Fetch folder names associated with the username from the database
$stmt = $pdo->prepare("SELECT folder_name FROM folders WHERE username = ?");
$stmt->execute([$username]);
$folders = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Return the folder names as JSON
echo json_encode($folders);
?>
