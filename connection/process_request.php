<?php
// process_request.php

include '../connection/connection.php';

// Start the session
session_start();

// Set the timezone to Eastern Time Zone (ET)
date_default_timezone_set('Asia/Manila');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $requestId = $_POST['requestId'];
    $action = $_POST['action'];

    // Check if user is logged in
    if (!isset($_SESSION['username'])) {
        echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
        exit();
    }

    $authorUsername = $_SESSION['username'];

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

            // Create a folder with the user's name in ../Employee Files directory
            $folderName = $username; // Use the original name without modification
            $folderPath = "C:\\Users\\user\\Desktop\\File Management System\\Employee Files\\$folderName";
            if (!file_exists($folderPath)) {
                mkdir($folderPath, 0777, true);
                echo json_encode(['status' => 'success', 'message' => 'User registration approved successfully']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Folder already exists for this user']);
            }

            // Get the name of the author from users table
            $authorResult = $conn->query("SELECT name FROM users WHERE username='$authorUsername'");
            if ($authorResult && $authorResult->num_rows > 0) {
                $author = $authorResult->fetch_assoc()['name'];
            } else {
                $author = "Unknown";
            }

            // Log activity for approval
            $datetime = date("Y-m-d H:i:s");
            $action = "New User Approved";
            $description = $name;
            $conn->query("INSERT INTO activity_log (Author, job_title, DateTime, Action, Description) VALUES ('$author', 'Admin', '$datetime', '$action', '$description')");

            // Delete the request from pending_requests table
            $conn->query("DELETE FROM pending_requests WHERE id = $requestId");
        } else {
            echo json_encode(['status' => 'error', 'message' => 'User not found in pending requests']);
        }
    } elseif ($action === 'deny') {
        // Retrieve user details from pending_requests
        $result = $conn->query("SELECT * FROM pending_requests WHERE id = $requestId");
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $name = $row['name'];

            // Get the name of the author from users table
            $authorResult = $conn->query("SELECT name FROM users WHERE username='$authorUsername'");
            if ($authorResult && $authorResult->num_rows > 0) {
                $author = $authorResult->fetch_assoc()['name'];
            } else {
                $author = "Unknown";
            }

            // Log activity for denial
            $datetime = date("Y-m-d H:i:s");
            $action = "New User Denied";
            $description = $name;
            $conn->query("INSERT INTO activity_log (Author, job_title, DateTime, Action, Description) VALUES ('$author', 'Admin', '$datetime', '$action', '$description')");

            // Delete the request from pending_requests table
            $conn->query("DELETE FROM pending_requests WHERE id = $requestId");

            echo json_encode(['status' => 'success', 'message' => 'User registration denied']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'User not found in pending requests']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid action']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
?>
