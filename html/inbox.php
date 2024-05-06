<?php
session_start();
include '../connection/connection.php';
include '../connection/login_checker.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../css/inbox.css">
    <link rel="stylesheet" href="../css/style-personal-info.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <title>Inbox</title>
</head>
<body>
<!-- NAVIGATION BAR -->
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
                <li><a href="inbox.php">
                    <i class="material-symbols-outlined">person</i>
                    <span class="link-name">Inbox</span>
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
            <img  src="../img/Catiwa, Kenric.jpeg" alt="tite">
        </div>
<div class="container">
    <div class="inbox">
        <div class="messages">

            <div class="email-header-options">
                <button >Create Email</button>
                <button >Delete</button>
            </div>

            <div class="email">
                <label>
                    
                    <div class="email-header">
                        <div class="checkbox-container">
                            <input type="checkbox" name="selectedEmail" >
                        </div>
                        <span class="sender">Sender Name 1</span>
                        <span class="subject">Subject 1</span>
                        <span class="date">Date</span>
                    </div>
                </label>
            </div>
            <div class="email">
                <label>
                    <div class="email-header">
                        <div class="checkbox-container">
                            <input type="checkbox" name="selectedEmail" >
                        </div>
                        <span class="sender">Sender Name 2</span>
                        <span class="subject">Subject 2</span>
                        <span class="date">Date</span>
                    </div>
                </label>
            </div>
        </div>
    </div>
 
</div>

</body>
<script src="../js/script.js"></script>



<!-- only check checkbox when it is directly pressed -->
<script>
        // Get all email headers
        var emailHeaders = document.querySelectorAll('.email-header');

        // Loop through each email header
        emailHeaders.forEach(function(header) {
            // Get the checkbox within the email header
            var checkbox = header.querySelector('input[type="checkbox"]');

            // Add click event listener to the email header
            header.addEventListener('click', function(event) {
                // Check if the click target is not the checkbox itself
                if (event.target !== checkbox) {
                    // Toggle the checkbox state
                    checkbox.checked = !checkbox.checked;
                }
            });
        });
    </script>
</html>