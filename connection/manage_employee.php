<?php
include '../connection/connection.php';

if (isset($_POST['delete_user'])) {
    $id = $_POST['id'];

    // Retrieve the user's name from the database
    $stmt = $conn->prepare("SELECT name FROM users WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($folderName);
    $stmt->fetch();
    $stmt->close();

    // Construct source and destination folder paths
    $sourceFolderPath = "C:\\Users\\user\\Desktop\\File Management System\\Employee Files\\$folderName";
    $destinationFolderPath = "C:\\Users\\user\\Desktop\\File Management System\\Deleted Employees\\$folderName";

    // Move the folder to the "Deleted Employees" directory
    if (rename($sourceFolderPath, $destinationFolderPath)) {
        // Delete the user from the database
        $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            // Delete the user's folder from the "Employee Files" directory
            if (is_dir($sourceFolderPath)) {
                // Use recursive directory removal to delete all files and subdirectories
                $success = rrmdir($sourceFolderPath);
                if (!$success) {
                    echo "<script>alert('Failed to delete user folder from Employee Files.');</script>";
                }
            }
            header("location: ../html/user.php");
        } else {
            echo "<script>alert('Failed to delete user.');</script>";
        }
        $stmt->close();
    } else {
        echo "<script>alert('Failed to move user folder to Deleted Employees.');</script>";
    }
}

// Function for recursively removing a directory and its contents
function rrmdir($dir) {
    foreach(glob($dir . '/*') as $file) {
        if(is_dir($file))
            rrmdir($file);
        else
            unlink($file);
    }
    return rmdir($dir);
}
?>
