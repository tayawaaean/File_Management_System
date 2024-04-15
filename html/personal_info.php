<?php
include '../connection/verifier.php';?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../css/personal_info.css">
    <link rel="stylesheet" href="../css/style-personal-info.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
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
                <li><a href="#">
                    <i class='bx bx-folder-open'></i>
                    <span class="link-name">My Files</span>
                </a></li>
                <li><a href="personal_info.php">
                    <i class="material-symbols-outlined">person</i>
                    <span class="link-name">Personal Info</span>
                </a></li>
                <li><a href="../inbox/inbox.html">
                    <i class="material-symbols-outlined">inbox</i>
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
            
            <img src="/img/Catiwa, Kenric.jpeg" alt="">
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
                <span class="userName" id="userName"></span>
                <span class="userTitle" id="work-title"></span>
            </div>
           </div>
        </div>
        <div class="first-side">
            <div class="operation">
                <p class="textheader">Contact</p>
                <div class="buttons">
                <a class="cancel-btn"  id="cancel-btn"><span class="material-symbols-outlined">
                    close
                    </span></i></a> 
                <a class="save-btn" id="save-btn"><span class="material-symbols-outlined">
                    check_small
                    </span></a>
                <a class="edit-info-btn"  id="contact-edit"><img src="../img/edit-246.png" alt="edit-icon"></a>
                </div>
            </div>
            <div class="content-info">
            <label class="user-label" for="email">Email</label> 
            <input type="text" id="email" readonly value="jjtengtejada754gmail">
            
        
            <label class="user-label" for="phone">Phone</label>
            <input type="text" id="phone" readonly value="00000000000"> 

            <label class="user-label" for="mobile">Mobile</label>
            <input type="text" id="mobile" readonly value="00000000000"> 

            <label class="user-label" for="web">Website</label>
            <input type="text" id="web" readonly value="asdsadsadsadsadsadsad"> 
            </div>
        </div>


        <div class="second-side">
            <div class="operation">
                <p class="textheader">User Information</p>
                <div class="buttons">
                <a class="cancel-btn"  id="cancel-btn-info"><span class="material-symbols-outlined">
                    close
                    </span></i></a> 
                <a class="save-btn" id="save-btn-info"><span class="material-symbols-outlined">
                    check_small
                    </span></a>
                <a class="edit-info-btn"  id="info-edit"><img src="../img/edit-246.png" alt="edit-icon"></a>
                </div>
            </div>
            <div class="content-info">

            <label class="user-label"  for="name">Name</label>
            <input type="text" id="name" readonly value="Kenric Catiwa"> 

            <label class="user-label" for="birthday">BirthDay</label>
            <input type="text" id="birthday" readonly value="05 June 2002"> 
        
            <label class="user-label" for="Address">Address</label>
            <input type="text" id="Address" readonly value="Mexico, Pampanga"> 

            <label class="user-label" for="nickname">Nickname</label>
            <input type="text" id="nickname" readonly value="Berto"> 
                </div>
        </div>
        <div class="third-side">
                <div class="operation">
                    <p class="textheader">Work</p>
                    <div class="buttons">
                    <a class="cancel-btn"  id="cancel-btn-work"><span class="material-symbols-outlined">
                        close
                        </span></i></a> 
                    <a class="save-btn" id="save-btn-work"><span class="material-symbols-outlined">
                        check_small
                        </span></a>
                    <a class="edit-info-btn"  id="work-edit"><img src="../img/edit-246.png" alt="edit-icon"></a>
                    </div>
                </div>
            
            <div class="content-info">
                <label class="user-label" for="jobtitle">Job Title</label>
                <input type="text" id="jobtitle" readonly value="Dean"> 
    
                <label for="Department"class="user-label">Department</label>
                <input type="text" id="Department" readonly value="Com Eng"> 
            
                <label class="user-label" for="Company">Company</label>
                <input type="text" id="Company" readonly value="Mexico, Pampanga"> 
    
                <label class="user-label" for="current-location">Current Location</label>
                <input type="text" id="current-location" readonly value="Berto"> 
                    </div>
        </div>
    </div>
</body>
<script src="../js/personal_info.js"></script>
<script src="../js/script.js"></script>
</html>