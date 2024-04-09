<?php
// Database connection credentials
$servername = "localhost";
$username = "root"; // Replace with your MySQL username
$password = ""; // Replace with your MySQL password
$database = "File_management_system_bingao";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function login($username, $password, $conn) {
    global $database;
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        // Account found, return account details
        return $result->fetch_assoc();
    } else {
        // Account not found
        return null;
    }
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $user = login($username, $password, $conn);
    if ($user) {
        // Login successful, redirect to index.html
        header("Location: index.html");
        exit();
    }
    // No redirect if login failed
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BNHS File Management System</title>
    <link rel= "icon" type="image/png" href="../img/BNHS Logo.png">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Crimson+Pro">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>
    <div class="container containerFront">
        <div class="top">
            <div class="image">
                <img src="../img/BNHS Logo.png">
            </div>
            <span>Sign in</span>
        </div>
        <div class="sign-in">
            <!-- Display message if user is not registered -->
            <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && !$user): ?>
                <p style="color: red;">Username or password incorrect. Please check your credentials or <a href="register.php">register here</a>.</p>
            <?php endif; ?>
            <form action="" class="sign-in-form" method="post">
                <div class="inputBox inputBoxFront">
                    <i class="fas fa-user"></i>
                    <input type="text" placeholder="username" class="input" name="username">
                </div>
                <div class="inputBox inputBoxFront">
                    <i class="fas fa-lock"></i>
                    <input type="password" placeholder="password" class="input" name="password">
                </div>
                <button class="button-submit" type="submit">Sign in</button>
                
                <div class="users">
                    <label>Don't have an account yet?</label>
                    <span class="newUser">Sign Up</span>
                    <div class="forgot-pass">
                        <span class="forgotPass" id="forgotPass">Forgot password?</span>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="container containerBack">
        <div class="top topBack">
            <div class="image imageBack">
                <img src="../img/BNHS Logo.png">
            </div>
            <span>Sign Up</span>
        </div>
        <div class="sign-in sign-upBack">
            <form action="register.php" class="sign-in-form" method="post">
                <div class="inputBox inputBack">
                    <i class="fa-solid fa-n"></i>
                    <input type="text" placeholder="name" class="input" id="name" name="name">
                </div>
                <div class="inputBox inputBack">
                    <i class="fa-solid fa-envelope"></i>
                    <input type="email" placeholder="email" class="input" id="email" name="email">
                </div>
                <div class="inputBox inputBack">
                    <i class="fas fa-user"></i>
                    <input type="text" placeholder="username" class="input" id="username" name="username">
                </div>
                <div class="inputBox inputBoxBack">
                    <i class="fas fa-lock"></i>
                    <input type="password" placeholder="password" class="input" id="password" name="password">
                </div>
                <button class="button-submit submitBack">Sign Up</button>
                
                <div class="users usersBack">
                    <label>Already have an account?</label>
                    <span class="existingUser">Log In</span>
                </div>
            </form> 
        </div>
    </div>
    <div class="container containerSide">
        <div class="top topBack">
            <div class="image imageBack">
                <img src="../img/BNHS Logo.png">
            </div>
            <span>Change Password</span>
        </div>
        <div class="sign-in sign-upBack">
            <form id="forgotPasswordForm" class="sign-in-form">
                <div class="inputBox inputBack">
                    <i class="fa-solid fa-n"></i>
                    <input type="text" placeholder="name" name="name" class="input">
                </div>
                <div class="inputBox inputBack">
                    <i class="fa-solid fa-envelope"></i>
                    <input type="email" placeholder="email" name="email" class="input">
                </div>
                <div class="inputBox inputBack">
                    <i class="fas fa-user"></i>
                    <input type="text" placeholder="username" name="username" class="input">
                </div>
                <div class="inputBox inputBoxBack">
                    <i class="fas fa-lock"></i>
                    <input type="password" placeholder="new password" name="new_password" class="input">
                </div>
                <button type="button" class="button-submit submitBack" id="forgotPassword">Submit</button>
                
                <div class="users usersBack">
                    <label>Already have an account?</label>
                    <span class="existingUser existingUser2">Log In</span>
                </div>
            </form> 
        </div>
    </div>
    <script src="../js/login.js"></script>
    <script>
        document.getElementById("forgotPassword").addEventListener("click", function() {
            var name = document.querySelector('.inputBox input[name="name"]').value;
            var email = document.querySelector('.inputBox input[name="email"]').value;
            var username = document.querySelector('.inputBox input[name="username"]').value;
            var newPassword = document.querySelector('.inputBox input[name="new_password"]').value;

            // AJAX Request
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'forgot_password.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Handle the response from the server
                    alert(xhr.responseText);
                }
            };
            xhr.send('name=' + name + '&email=' + email + '&username=' + username + '&new_password=' + newPassword);
        });
    </script>
</body>
</html>
