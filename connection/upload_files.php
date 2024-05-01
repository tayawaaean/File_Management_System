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

// Get the selected destination folder
$folderName = $_POST['folderName'];

// If no folder is selected, set the destination folder to "Random Files"
if ($folderName === 'none') {
    $folderName = '';
}

// Check if a file is uploaded
if (isset($_FILES['fileInput'])) {
    // File details
    $fileName = $_FILES['fileInput']['name'];
    $fileSize = $_FILES['fileInput']['size'];
    $fileTmpName = $_FILES['fileInput']['tmp_name'];
    $fileType = $_FILES['fileInput']['type'];

    // Encode the file name and file size to binary
    $encodedFileName = base64_encode($fileName);
    $encodedFileSize = base64_encode($fileSize);

    // Move the file to the destination folder
    $destinationFolder = "C:\\Users\\user\\Desktop\\File Management System\\Employee Files\\$username\\$folderName\\$fileName";
    move_uploaded_file($fileTmpName, $destinationFolder);

    // Insert file details into the database
    $query = "INSERT INTO files (file_name, date_time, file_size, owner, folder_name) VALUES (?, NOW(), ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssss", $encodedFileName, $encodedFileSize, $username, $folderName);
    
    if ($stmt->execute()) {
        // Fetch author's name from users table
        $authorUsername = $username;
        $authorResult = $conn->query("SELECT name FROM users WHERE username='$authorUsername'");
        if ($authorResult && $authorResult->num_rows > 0) {
            $author = $authorResult->fetch_assoc()['name'];
        } else {
            $author = "Unknown";
        }

        // Insert entry into activity_log table
        $action = "Uploaded a new file";
        $description = "$folderName";
        $job_title = 'Employee'; // You need to fetch the job title from the users table

        $activityQuery = "INSERT INTO activity_log (Author, job_title, DateTime, Action, Description) VALUES (?, ?, NOW(), ?, ?)";
        $activityStmt = $conn->prepare($activityQuery);
        $activityStmt->bind_param("ssss", $author, $job_title, $action, $description);
        
        if ($activityStmt->execute()) {
            echo "File uploaded successfully";
        } else {
            echo "Error inserting activity log";
        }
    } else {
        echo "Error uploading file";
    }
} else {
    echo "No file uploaded";
}
?>
