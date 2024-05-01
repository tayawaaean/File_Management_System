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
    for ($i = 0; $i < count($_FILES['folderInput']['name']); $i++) {
        // File details
        $fileName = $_FILES['folderInput']['name'][$i];
        $fileSize = $_FILES['folderInput']['size'][$i];
        $fileTmpName = $_FILES['folderInput']['tmp_name'][$i];
        $fileType = $_FILES['folderInput']['type'][$i];

        // Convert file name and size to base64
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
            echo "File uploaded successfully";
        } else {
            echo "Error uploading file";
        }
    }
} else {
    echo "No files uploaded";
}
?>
