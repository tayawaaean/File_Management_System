<?php include '../connection/connection.php';?>
<?php include '../html/forgot_password.php';?>
<?php
// Database connection credentials
$servername = "localhost";
$username = "root"; // Replace with your MySQL username
$password = ""; // Replace with your MySQL password
$database = "File_management_system_bingao";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function login($username, $password, $conn) {
    global $database;
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
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
    } else {
        // Login failed, display message
        echo "Invalid username or password. If you haven't signed up, please do so.";
    }
}

// Close connection
$conn->close();
?>
