<?php
include '../connection/connection.php';

if (isset($_POST['delete_user'])) {
    $id = $_POST['id'];

    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) { // Execute the query
        header("location: user.php");
    } else {
        echo "<script>alert('Failed to delete user.');</script>";
    }

    $stmt->close();
}
?>
