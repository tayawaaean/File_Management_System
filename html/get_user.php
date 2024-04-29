<?php
include '../connection/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id'])) {
        $userId = $_POST['id'];

        $sql = "SELECT * FROM users WHERE id = $userId";


        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            $userData = array(
                'id' => $row['id'],
                'name' => $row['name'],
                'job_title' => $row['job_title'],
                'phone' => $row['phone'],
                'email' => $row['email']
            );

            header('Content-Type: application/json');
            echo json_encode($userData);
        } else {
            header('HTTP/1.1 404 Not Found');
            echo json_encode(array('error' => 'User not found.'));
        }
    } else {
        // If user ID is not provided, send an error response
        header('HTTP/1.1 400 Bad Request');
        echo json_encode(array('error' => 'User ID is required.'));
    }
} else {
    // If the request method is not POST, send an error response
    header('HTTP/1.1 405 Method Not Allowed');
    echo json_encode(array('error' => 'Method Not Allowed.'));
}
?>
