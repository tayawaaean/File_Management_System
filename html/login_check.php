<?php
include '../connection/connection.php';

function login($username, $password, $conn) {
    global $database;
    // Hash the provided password
    $hashed_password = md5($password);
    // Query to fetch user details based on username and hashed password
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$hashed_password'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        // Account found, return account details
        return $result->fetch_assoc();
    } else {
        // Account not found
        return null;
    }
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $user = login($username, $password, $conn);
    if ($user) {
        // Login successful, redirect to index.html
        header("Location: index.html");
        exit();
    }
    // No redirect if login failed
}
?>