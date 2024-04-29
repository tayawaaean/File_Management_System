<?php
include '../connection/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $job_title = $_POST['job_title'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    $stmt = $conn->prepare("UPDATE users SET name=?, job_title=?, phone=?, email=? WHERE id=?");
    $stmt->bind_param("ssssi", $name, $job_title, $phone, $email, $id);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to update user data']);
    }

    $stmt->close();
} else {
    header('HTTP/1.1 405 Method Not Allowed');
    echo json_encode(['status' => 'error', 'message' => 'Method Not Allowed']);
}
?>