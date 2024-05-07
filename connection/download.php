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
    if ($result->num_rows > 0) {
        // Fetch the file details
        $file = $result->fetch_assoc();

        // File path on the server
        if ($file['folder_name'] == '') {
            $filePath = "C:\\Users\\user\\Desktop\\File Management System\\Employee Files\\" . $file['owner'] . "\\" . base64_decode($file['file_name']);
        } else {
            $filePath = "C:\\Users\\user\\Desktop\\File Management System\\Employee Files\\" . $file['owner'] . "\\" . $file['folder_name'] . "\\" . base64_decode($file['file_name']);
        }

        // Check if the file exists
        if (file_exists($filePath)) {
            // Set headers for file download
            header("Content-Type: application/octet-stream");
            header("Content-Disposition: attachment; filename=" . basename($filePath));
            header("Content-Length: " . filesize($filePath));

            // Read the file and output its contents
            readfile($filePath);
            exit();
        } else {
            // If the file does not exist, display an error message
            echo "File not found";
        }
    } else {
        // If the file ID is not found in the database, display an error message
        echo "File not found";
    }
} else {
    // If the file ID is not provided in the query string, display an error message
    echo "File ID not provided";
}
?>
