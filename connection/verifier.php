<?php
session_start(); // Start the session

// Check if the session variables are not set
if (!isset($_SESSION['username']) || !isset($_SESSION['user_type'])) {
    // Redirect to login.php
    header("Location: login.php");
    exit(); // Make sure to exit after redirection
}

// If session is detected, continue with the rest of the index.php file
?>