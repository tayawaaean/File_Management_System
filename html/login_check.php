<?php
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
        // Check user type
        $user_type = $user['user_type'];
        if (strtolower($user_type) == 'admin') {
            // Admin user, redirect to index.html
            header("Location: index.html");
            exit();
        } else {
            // Non-admin user, redirect to employee_index.html
            header("Location: employee_index.html");
            exit();
        }
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
    if (!$user) {
        // Login failed, redirect to login page with an error message
        header("Location: login.html?error=1");
        exit();
    }
}
?>
