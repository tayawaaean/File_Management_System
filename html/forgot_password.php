<?php
include '../connection/connection.php'; // Include your database connection script

// Check if the form is submitted
if(isset($_POST['username'], $_POST['new_password'])) {
    // Retrieve form data
    $username = $_POST['username'];
    $new_password = $_POST['new_password']; // Assuming you're passing the new password directly
    
    // Validate the data (You might want to do more extensive validation)
    if(empty($username) || empty($new_password)) {
        echo "Please fill in all fields.";
        exit;
    }

    // Check if the user exists in the database
    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) > 0) {
        // User exists, update the password
        $hashed_password = md5($new_password); // Hash the new password
        $update_query = "UPDATE users SET password = '$hashed_password' WHERE username = '$username'";
        mysqli_query($conn, $update_query);
        echo "Password updated successfully!";
    } else {
        echo "User not found. Please check your username.";
    }
}
?>
