<?php
session_start(); // Start the session
include '../connection/connection.php';

function login($username, $password, $conn) {
    // Hash the provided password
    $hashed_password = md5($password);
    // Query to fetch user details based on username and hashed password
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$hashed_password'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        // Account found, fetch user details
        $user = $result->fetch_assoc();
        // Set session variables
        $_SESSION['username'] = $user['username'];
        $_SESSION['user_type'] = $user['user_type'];
        if (strtolower($user['user_type']) == 'admin') {
            // Admin user, redirect to index.html
            header("Location: index.php");
            exit();
        } else {
            // Non-admin user, redirect to employee_index.html
            header("Location: employee_index.php");
            exit();
        }
    } else {
        // Account not found
        return false;
    }
}

// Check if the user is already logged in
if (isset($_SESSION['username']) && isset($_SESSION['user_type'])) {
    // Redirect to appropriate page based on user type
    if (strtolower($_SESSION['user_type']) == 'admin') {
        header("Location: index.php");
        exit();
    } else {
        header("Location: employee_index.php");
        exit();
    }
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $user = login($username, $password, $conn);
    if (!$user) {
        // Login failed, redirect to login page with an error message
        header("Location: login.php?error=1");
        exit();
    }
}
?>
