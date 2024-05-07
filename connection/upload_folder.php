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

$folderName = isset($_POST['folderName']) ? $_POST['folderName'] : '';

// If no folder is selected, set the destination folder to "Random"
if ($folderName === 'none') {
    $folderName = '';
}

// Check if files are uploaded
if (!empty($_FILES['folderInput']['name'][0])) {
    // Loop through each file
    foreach ($_FILES['folderInput']['name'] as $key => $value) {
        // File details
        $fileName = $_FILES['folderInput']['name'][$key];
        $fileSize = $_FILES['folderInput']['size'][$key];
        $fileTmpName = $_FILES['folderInput']['tmp_name'][$key];
        $fileType = $_FILES['folderInput']['type'][$key];

        // Convert file name and size to base64
        $encodedFileName = base64_encode($fileName);
        $encodedFileSize = base64_encode($fileSize);

        // Move the file to the destination folder
        $destinationFolder = "C:\\Users\\user\\Desktop\\File Management System\\Employee Files\\$username\\$folderName\\$fileName";
        move_uploaded_file($fileTmpName, $destinationFolder);

        // Insert file details into the database
        $query = "INSERT INTO files (file_name, date_time, file_size, owner, folder_name) VALUES (?, NOW(), ?, ?, ?)";
        $stmt = $conn->prepare($query);
        
        // Bind parameters
        $stmt->bind_param("ssss", $encodedFileName, $encodedFileSize, $username, $folderName);

        // Execute the statement
        if ($stmt->execute()) {
            echo "File uploaded successfully<br>";
        } else {
            echo "Error uploading file<br>";
        }
    }

    // Fetch author's name from users table
    $authorQuery = "SELECT name FROM users WHERE username=?";
    $authorStmt = $conn->prepare($authorQuery);
    $authorStmt->bind_param("s", $username);
    $authorStmt->execute();
    $authorResult = $authorStmt->get_result();

    if ($authorResult->num_rows > 0) {
        $author = $authorResult->fetch_assoc()['name'];
    } else {
        $author = "Unknown";
    }

    // Insert entry into activity_log table for file uploads
    $action = "Uploaded Multiple Files";
    $description = $folderName;

    // Prepare and bind parameters for activity log insertion
    $activityQuery = "INSERT INTO activity_log (author, job_title, DateTime, Action, description) VALUES (?, ?, NOW(), ?, ?)";
    $activityStmt = $conn->prepare($activityQuery);
    $job_title = 'Employee'; // Assuming job_title is an empty string for now
    $activityStmt->bind_param("ssss", $author, $job_title, $action, $description);

    // Execute the activity log statement
    if ($activityStmt->execute()) {
        echo "Activity log inserted successfully";
    } else {
        echo "Error inserting activity log";
    }

    // Redirect back to the page after successful file upload
    header("Location: ../html/my_files.php");
    exit();
} else {
    echo "No files uploaded";
}
?>
