<?php
session_start();

date_default_timezone_set('Asia/Manila');

include '../connection/connection.php';

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect to the login page if not logged in
    header("Location: login.php");
    exit();
}

// Output the value of $_SESSION['user_id'] for debugging
// Retrieve the user's ID from the database based on the username
$sql = "SELECT id FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $_SESSION['username']);
$stmt->execute();
$result = $stmt->get_result();

// Check if the query returned a result
if ($result->num_rows > 0) {
    // Fetch the user ID
    $row = $result->fetch_assoc();
    $user_id_from_database = $row['id'];

    // Assign the user ID to $_SESSION['user_id']
    $_SESSION['user_id'] = $user_id_from_database;
} else {
    // Handle the case where the user ID is not found
    // You can redirect the user to a login page or display an error message
    echo "User ID not found.";
}

// Get edited data from the request
$editedData = json_decode(file_get_contents("php://input"), true);

// Construct the SQL update query based on the provided data
$query = "UPDATE users SET ";
$updateParams = [];
$updateTypes = "";
foreach ($editedData as $key => $value) {
    // Check if the key is a valid column in the users table
    if (in_array($key, ['email', 'phone', 'mobile', 'website', 'name', 'birthday', 'address', 'nickname', 'job_title', 'department', 'company', 'current_location'])) {
        // Add the column to the update query
        $query .= "$key=?, ";
        $updateParams[] = $value;
        $updateTypes .= "s";
    }
}
// Remove the trailing comma and space from the query
$query = rtrim($query, ", ");
$query .= " WHERE id=?"; // Add the WHERE clause

// Add the user ID parameter to the update parameters
$updateParams[] = $_SESSION['user_id'];
$updateTypes .= "i";

// Prepare and execute the update statement
$stmt = $conn->prepare($query);
$stmt->bind_param($updateTypes, ...$updateParams);
$result = $stmt->execute();

// Log activity
$authorUsername = $_SESSION['username'];
$action = "Profile Updated";
$datetime = date("Y-m-d H:i:s");

// Retrieve author's name from users table
$queryAuthorName = "SELECT name FROM users WHERE username=?";
$stmtAuthorName = $conn->prepare($queryAuthorName);
$stmtAuthorName->bind_param("s", $authorUsername);
$stmtAuthorName->execute();
$resultAuthorName = $stmtAuthorName->get_result();

if ($resultAuthorName->num_rows > 0) {
    $rowAuthorName = $resultAuthorName->fetch_assoc();
    $authorName = $rowAuthorName['name'];

    // Insert into activity_log
    $queryLog = "INSERT INTO activity_log (Author, job_title, DateTime, Action, Description) VALUES (?, ?, ?, ?, ?)";
    $stmtLog = $conn->prepare($queryLog);
    $job_title = "Employee"; // Assuming the user's job title is always "Employee"
    $description = $authorName; // Description as the author's name
    $stmtLog->bind_param("sssss", $authorName, $job_title, $datetime, $action, $description);
    $stmtLog->execute();
} else {
    echo "Author name not found.";
}

?>
