<?php
// Start the session
session_start();

// Unset all of the session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to login.php
header("Location: ../html/login.php");
exit(); // Make sure to exit after redirection
?>