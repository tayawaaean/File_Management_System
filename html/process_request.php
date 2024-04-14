<?php
// process_request.php

include '../connection/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $requestId = $_POST['requestId'];
    $action = $_POST['action'];

    if ($action === 'approve') {
        // Retrieve user details from pending_requests
        $result = $conn->query("SELECT * FROM pending_requests WHERE id = $requestId");
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();

            // Insert approved user into the 'users' table
            $name = $row['name'];
            $email = $row['email'];
            $username = $row['username'];
            $password = $row['password'];

            $stmt = $conn->prepare("INSERT INTO users (name, email, username, password) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $name, $email, $username, $password);
            $stmt->execute();
            $stmt->close();

            $conn->query("DELETE FROM pending_requests WHERE id = $requestId");

            echo json_encode(['status' => 'success', 'message' => 'User registration approved successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'User not found in pending requests']);
        }
    } elseif ($action === 'deny') {
        $conn->query("DELETE FROM pending_requests WHERE id = $requestId");

        echo json_encode(['status' => 'success', 'message' => 'User registration denied']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid action']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
?>