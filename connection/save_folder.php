<?php
session_start();
date_default_timezone_set('Asia/Manila');

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect to login page or handle unauthorized access
    header("Location: login.php");
    exit();
}

// Include necessary files
include '../connection/connection.php';
include '../connection/login_checker.php';

// Get the username from the session
$username = $_SESSION['username'];

// Get the folder name from the form
$folderName = $_POST['folderName'];

// Construct the folder path using the username
$sourceFolderPath = "C:\\Users\\user\\Desktop\\File Management System\\Employee Files\\$username\\$folderName";

// Create the folder
if (!file_exists($sourceFolderPath)) {
    mkdir($sourceFolderPath, 0777, true);
    echo "Folder created successfully";

    // Insert folder details into the folders table
    $createdAt = date('Y-m-d H:i:s'); // Get current date and time
    $insertQuery = "INSERT INTO folders (folder_name, username, created_at) VALUES ('$folderName', '$username', '$createdAt')";
    $insertResult = mysqli_query($conn, $insertQuery);

    if ($insertResult) {
        echo "Folder details inserted into the database.";
        
        // Fetch author's name
        $authorQuery = "SELECT name FROM users WHERE username='$username'";
        $authorResult = mysqli_query($conn, $authorQuery);
        $authorRow = mysqli_fetch_assoc($authorResult);
        $author = ($authorRow) ? $authorRow['name'] : "Unknown";

        // Insert entry into activity_log table for folder creation
        $action = "Created A New Folder";
        $description = $folderName;

        $activityQuery = "INSERT INTO activity_log (author, job_title, DateTime, Action, description) VALUES ('$author', 'Employee', NOW(), '$action', '$description')";
        $activityResult = mysqli_query($conn, $activityQuery);

        if ($activityResult) {
            echo "Activity log entry created successfully";

            // Redirect back to the page after successful folder creation
            header("Location: ../html/my_files.php");
            exit();
        } else {
            echo "Error creating activity log entry: " . mysqli_error($conn);
        }
    } else {
        echo "Error inserting folder details into the database: " . mysqli_error($conn);
    }
} else {
    echo "Folder already exists";
}
?>
