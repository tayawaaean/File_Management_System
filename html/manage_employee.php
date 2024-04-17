<?php
include '../connection/connection.php';

if (isset($_POST['delete_user'])) {
    $id = $_POST['id'];

    // Retrieve user details to get the name
    $stmt = $conn->prepare("SELECT name FROM users WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($name);
    $stmt->fetch();
    $stmt->close();

    if ($name) { // If user name is retrieved successfully
        // Find and move the corresponding folder
        $folderName = $name;
        $sourceFolder = "../Employee Files/$folderName";
        $destinationFolder = "../Deleted Employee Files/$folderName";

        if (file_exists($sourceFolder)) {
            if (!file_exists($destinationFolder)) {
                // Create the destination folder if it doesn't exist
                mkdir($destinationFolder, 0777, true);
            }
            // Move the folder to the destination
            if (rename($sourceFolder, $destinationFolder)) {
                // Delete the user from the database
                $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
                $stmt->bind_param("i", $id);
                if ($stmt->execute()) { // Execute the query
                    header("location: user.php");
                } else {
                    echo "<script>alert('Failed to delete user.');</script>";
                }
                $stmt->close();
            } else {
                echo "<script>alert('Failed to move user folder.');</script>";
            }
        } else {
            echo "<script>alert('User folder not found.');</script>";
        }
    } else {
        echo "<script>alert('User not found.');</script>";
    }
}
?>
