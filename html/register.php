<?php
$name = $_POST['name'];
$email = $_POST['email'];
$username = $_POST['username'];
$password = md5($_POST['password']); // Encrypting the password using MD5 hash

// Database connection
$conn = new mysqli('localhost', 'root', '', 'file_management_system_bingao');
if ($conn->connect_error) {
    echo "$conn->connect_error";
    die("Connection Failed : " . $conn->connect_error);
} else {
    $stmt = $conn->prepare("INSERT INTO users (name, email, username, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $username, $password);
    $execval = $stmt->execute();
    $stmt->close();
    $conn->close();

    // Redirect to index.html if account creation is successful
    if ($execval) {
        header("Location: login.php");
        exit();
    } else {
        echo "Account creation failed!";
    }
}
?>
