<?php
include '../connection/connection.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = md5($_POST['password']); // Encrypting the password using MD5 hash

    // Prepare and execute SQL statement to insert new user as pending request
    $stmt = $conn->prepare("INSERT INTO pending_requests (name, email, username, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $username, $password);
    $execval = $stmt->execute();

    // Close statement
    $stmt->close();

    // Redirect to login.php after displaying the confirmation message
    header("Location: login.php");
    exit; // Make sure to exit after redirection to prevent further execution
}
?>
