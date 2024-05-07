<?php
// Include necessary files and configurations
include '../connection/connection.php';

// Check if the file ID is provided in the query string
if (isset($_GET['file_id'])) {
    // Get the file ID from the query string
    $fileId = $_GET['file_id'];

    // Prepare and execute a query to fetch the file details from the database
    $query = "SELECT * FROM files WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $fileId);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the file exists in the database
    if ($result->num_rows === 1) {
        // Fetch the file details
        $file = $result->fetch_assoc();
        
        // File path in the folder
        $ownerFolder = empty($file['folder_name']) ? '' : $file['folder_name'] . "\\";
        $filePath = "C:\\Users\\user\\Desktop\\File Management System\\Employee Files\\" . $file['owner'] . "\\" . $ownerFolder . base64_decode($file['file_name']);

        // Delete the file from the folder
        if (file_exists($filePath)) {
            if (unlink($filePath)) {
                // File deletion successful, now delete the entry from the database
                $query = "DELETE FROM files WHERE id = ?";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("i", $fileId);

                // Check if the deletion from the database is successful
                if ($stmt->execute()) {
                    // File deleted successfully from both folder and database
                    header("Location: ../html/my_files.php");
                    exit();
                } else {
                    // If there's an error in database deletion, display an error message
                    echo "Error deleting file from database";
                }
            } else {
                // If there's an error in file deletion, display an error message
                echo "Error deleting file from folder";
            }
        } else {
            // If the file doesn't exist in the folder, display an error message
            echo "File not found in folder";
        }
    } else {
        // If the file doesn't exist in the database, display an error message
        echo "File not found in database";
    }
} else {
    // If the file ID is not provided in the query string, display an error message
    echo "File ID not provided";
}
?>
