<?php
session_start();
include '../connection/connection.php';

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect to the login page if not logged in
    header("Location: login.php");
    exit();
}

// Retrieve the logged-in user's data from the database
$username = $_SESSION['username'];
$sql = "SELECT * FROM users WHERE username='$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // User found, fetch user details
    $user = $result->fetch_assoc();
} else {
    // User not found, handle accordingly (redirect or display error)
    $errorMessage = "User not found.";
}

// Pass the user data to JavaScript
echo '<script>';
echo 'const userData = ' . json_encode($user) . ';'; // Convert user data to JSON
echo '</script>';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../css/personal_info.css">
    <link rel="stylesheet" href="../css/style-personal-info.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    <title>Personal Information</title>
</head>
<body>
    <nav>
        <div class="logo-name">
            <div class="logo-image">
                <img src="../img/BNHS Logo.png" alt="">
            </div>

            <span class="logo_name">Bingao NHS</span>
        </div>

        <div class="menu-items">
            <ul class="nav-links">
                <li><a href="employee_index.php">
                    <i class="uil uil-estate"></i>
                    <span class="link-name">Dashboard</span>
                </a></li>
                <li><a href="my_files.php">
                    <i class='bx bx-folder-open'></i>
                    <span class="link-name">My Files</span>
                </a></li>
                <li><a href="personal_info.php">
                    <i class="material-symbols-outlined">person</i>
                    <span class="link-name">Personal Info</span>
                </a></li>
            </ul>
            
            <ul class="logout-mode">
                <li><a href="logout.php">
                    <i class="uil uil-signout"></i>
                    <span class="link-name">Logout</span>
                </a></li>

                <li class="mode">
                    <a href="#">
                        <i class="uil uil-moon"></i>
                    <span class="link-name">Dark Mode</span>
                </a>

                <div class="mode-toggle">
                  <span class="switch"></span>
                </div>
            </li>
            </ul>
        </div>
    </nav>

    <section class="dashboard">
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>

            <div class="search-box">
                <i class="uil uil-search"></i>
                <input type="text" placeholder="Search anything...">
            </div>
            
            <img src="../img/Catiwa, Kenric.jpeg" alt="">
        </div>
        <div class="container">
    <div class="header">
        <div class="background">
            <img class="image-background-profile" src="../img/background_temp.jpg" alt="background-lang">
            <div class="profile-image">
                <div class="image-user">
                    <img src="../img/Catiwa, Kenric.jpeg" alt="">
                </div>
            </div>
            <div class="white-bg">
                <span class="userName" id="userName"><?php echo $user['name']; ?></span>
                <span class="userTitle" id="work-title"><?php echo $user['job_title']; ?></span>
            </div>
        </div>
    </div>

    <!-- First Side -->
    <div class="first-side">
        <div class="operation">
            <p class="textheader">Contact</p>
            <div class="buttons">
                <a class="cancel-btn" id="cancel-btn-contact"><span class="material-symbols-outlined">close</span></a> 
                <a class="save-btn" id="save-btn-contact"><span class="material-symbols-outlined">check_small</span></a>
                <a class="edit-info-btn" id="contact-edit"><img src="../img/edit-246.png" alt="edit-icon"></a>
            </div>
        </div>
        <div class="content-info">
            <label class="user-label" for="email">Email</label> 
            <input type="text" id="email" readonly value="<?php echo $user['email']; ?>">
            
            <label class="user-label" for="phone">Phone</label>
            <input type="text" id="phone" readonly value="<?php echo $user['phone']; ?>"> 

            <label class="user-label" for="mobile">Mobile</label>
            <input type="text" id="mobile" readonly value="<?php echo $user['mobile']; ?>"> 

            <label class="user-label" for="web">Website</label>
            <input type="text" id="web" readonly value="<?php echo $user['website']; ?>"> 
        </div>
    </div>

    <!-- Second Side -->
    <div class="second-side">
        <div class="operation">
            <p class="textheader">User Information</p>
            <div class="buttons">
                <a class="cancel-btn" id="cancel-btn-info"><span class="material-symbols-outlined">close</span></a> 
                <a class="save-btn" id="save-btn-info"><span class="material-symbols-outlined">check_small</span></a>
                <a class="edit-info-btn" id="info-edit"><img src="../img/edit-246.png" alt="edit-icon"></a>
            </div>
        </div>
        <div class="content-info">
            <label class="user-label" for="name">Name</label>
            <input type="text" id="name" readonly value="<?php echo $user['name']; ?>"> 

            <label class="user-label" for="birthday">BirthDay</label>
            <input type="text" id="birthday" readonly value="<?php echo $user['birthday']; ?>"> 
            
            <label class="user-label" for="Address">Address</label>
            <input type="text" id="Address" readonly value="<?php echo $user['address']; ?>"> 

            <label class="user-label" for="nickname">Nickname</label>
            <input type="text" id="nickname" readonly value="<?php echo $user['nickname']; ?>"> 
        </div>
    </div>

    <!-- Third Side -->
    <div class="third-side">
        <div class="operation">
            <p class="textheader">Work</p>
            <div class="buttons">
                <a class="cancel-btn" id="cancel-btn-work"><span class="material-symbols-outlined">close</span></a> 
                <a class="save-btn" id="save-btn-work"><span class="material-symbols-outlined">check_small</span></a>
                <a class="edit-info-btn" id="work-edit"><img src="../img/edit-246.png" alt="edit-icon"></a>
            </div>
        </div>
        <div class="content-info">
            <label class="user-label" for="jobtitle">Job Title</label>
            <input type="text" id="jobtitle" readonly value="<?php echo $user['job_title']; ?>"> 

            <label for="Department" class="user-label">Department</label>
            <input type="text" id="Department" readonly value="<?php echo $user['department']; ?>"> 
        
            <label class="user-label" for="Company">Company</label>
            <input type="text" id="Company" readonly value="<?php echo $user['company']; ?>"> 

            <label class="user-label" for="current-location">Current Location</label>
            <input type="text" id="current-location" readonly value="<?php echo $user['current_location']; ?>"> 
        </div>
    </div>
</div>

</body>
<script src="../js/personal_info.js"></script>
<script src="../js/script.js"></script>
</html>