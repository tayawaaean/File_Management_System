<?php
session_start();
include '../connection/connection.php'; // Assuming this file contains your database connection
include '../connection/login_checker.php'; // Assuming this file contains your login checking mechanism

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if file was uploaded without errors
    if (isset($_FILES["profile_picture"]) && $_FILES["profile_picture"]["error"] == 0) {
        $allowed_extensions = array("jpg", "jpeg", "png", "gif");
        $file_extension = pathinfo($_FILES["profile_picture"]["name"], PATHINFO_EXTENSION);

        // Check file extension
        if (in_array($file_extension, $allowed_extensions)) {
            // Generate a unique name for the file
            $new_filename = uniqid() . '.' . $file_extension;

            // Path to store uploaded files
            $upload_dir = "../profilepics/";

            // Move the uploaded file to the specified directory
            if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $upload_dir . $new_filename)) {
                // Update user's profile picture in the database
                $user_id = $_SESSION['user_id']; // Assuming you have stored user's ID in session
                $profile_pic_path = "../profilepics/" . $new_filename;

                $update_query = "UPDATE users SET profile_pic = :profile_pic WHERE id = :user_id";
                $stmt = $pdo->prepare($update_query);
                $stmt->execute(array(':profile_pic' => $profile_pic_path, ':user_id' => $user_id));

                // Redirect back to the page with a success message
                header("Location: personal_info.php?success=1");
                exit();
            } else {
                echo "Error uploading file.";
            }
        } else {
            echo "Invalid file format. Allowed formats: JPG, JPEG, PNG, GIF.";
        }
    } else {
        echo "Error uploading file.";
    }
}
?>
