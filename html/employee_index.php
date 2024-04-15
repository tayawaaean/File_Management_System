<?php
include '../connection/verifier.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="../css/employee_dashboard.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <title>Admin Dashboard Panel</title> 
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

        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <h2>Dashboard</h2>
                </div>
                <hr>

                <div class="boxes">
                    <div class="box box1">
                        <i class='bx bxs-inbox'></i>
                        <span class="text">
                            <span class="number">12</span>
                            <span class="text">Inbox</span>
                        </span>
                    </div>
                    <div class="box box2">
                        <i2 class="material-symbols-outlined">description</i2>
                        <span class="text">
                            <span class="number">1,028</span>
                            <span class="text">Total Files</span>
                        </span>
                    </div>
                    <div class="box box3">
                        <i class="material-symbols-outlined">folder_open</i>
                        <span class="text">
                            <span class="number">4</span>
                            <span class="text">Total Folders</span>
                        </span>
                    </div>
                    <div class="box box4">
                        <i2 class="material-symbols-outlined">unarchive</i2>
                        <span class="text">
                            <span class="number">1,028</span>
                            <span class="text">Sent Files</span>
                        </span>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="activity">
                    <div class="title">
                        <div class="act">
                            <span class="material-symbols-outlined">
                                history
                                </span>
                            <span class="text">Activity Log</span>
                        </div>
                        <div class="buttons">
                            <button id="dropdown1" class="dropdown-button">
                                <i class='bx bx-user'></i>
                            </button>                            
                            <ul class="menu">
                                <li>Aean Gabrielle Tayawa</li>
                                <li>Dexter John Perdido</li>
                                <li>Kenric Catiwa</li>
                            </ul>
                            <button id="dropdown2" class="dropdown-button">
                                <i class='bx bxs-calendar' ></i>
                            </button>                            
                            <ul class="menu">
                                <li>January</li>
                                <li>February</li>
                                <li>March</li>
                                <li>April</li>
                                <li>May</li>
                                <li>June</li>
                                <li>July</li>
                                <li>August</li>
                                <li>September</li>
                                <li>October</li>
                                <li>November</li>
                                <li>December</li>
                            </ul>
                        </div>
                        
                        <div class="bottom-search">
                            <div class="search">
                                <i class="uil uil-search"></i>
                                <input type="text" placeholder="Search...">
                            </div>
                        </div>
                    </div>
                    <div class="table-container">
                        <div class="dashboard-table-wrapper">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Author</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Action</th>
                                        <th>Description</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Aean Gabrielle Tayawa</td>
                                        <td>May 30,2022</td>
                                        <td>4:38 pm</td>
                                        <td>New User Approved</td>
                                        <td>
                                            <div class="description">
                                                Admin Aean Gabrielle Tayawa accepted Dexter John Perdido to be a new user.
                                            </div>
                                            <div class="full-description">
                                                Admin Aean Gabrielle Tayawa accepted Dexter John Perdido to be a new user.
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Dexter John Perdido</td>
                                        <td>June 08,2022</td>
                                        <td>5:12 pm</td>
                                        <td>Document Deleted</td>
                                        <td>
                                            <div class="description">
                                                User Dexter John Perdido deleted the document MMSU Waiver.docx
                                            </div>
                                            <div class="full-description">
                                                User Dexter John Perdido deleted the document MMSU Waiver.docx
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Kenric Catiwa</td>
                                        <td>June 08,2022</td>
                                        <td>5:12 pm</td>
                                        <td>Document Upload</td>
                                        <td>
                                            <div class="description">
                                                User Kenric Catiwa uploaded the document Ma'am Abbie Assignment.pdf
                                            </div>
                                            <div class="full-description">
                                                User Kenric Catiwa uploaded the document MMSU Waiver.pdf
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Dexter John Perdido</td>
                                        <td>June 08,2022</td>
                                        <td>5:12 pm</td>
                                        <td>Document Deleted</td>
                                        <td>
                                            <div class="description">
                                                User Dexter John Perdido deleted the document MMSU Waiver.docx
                                            </div>
                                            <div class="full-description">
                                                User Dexter John Perdido deleted the document MMSU Waiver.docx
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Dexter John Perdido</td>
                                        <td>June 08,2022</td>
                                        <td>5:12 pm</td>
                                        <td>Document Deleted</td>
                                        <td>
                                            <div class="description">
                                                User Dexter John Perdido deleted the document MMSU Waiver.docx
                                            </div>
                                            <div class="full-description">
                                                User Dexter John Perdido deleted the document MMSU Waiver.docx
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Dexter John Perdido</td>
                                        <td>June 08,2022</td>
                                        <td>5:12 pm</td>
                                        <td>Document Deleted</td>
                                        <td>
                                            <div class="description">
                                                User Dexter John Perdido deleted the document MMSU Waiver.docx
                                            </div>
                                            <div class="full-description">
                                                User Dexter John Perdido deleted the document MMSU Waiver.docx
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Dexter John Perdido</td>
                                        <td>June 08,2022</td>
                                        <td>5:12 pm</td>
                                        <td>Document Deleted</td>
                                        <td>
                                            <div class="description">
                                                User Dexter John Perdido deleted the document MMSU Waiver.docx
                                            </div>
                                            <div class="full-description">
                                                User Dexter John Perdido deleted the document MMSU Waiver.docx
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Dexter John Perdido</td>
                                        <td>June 08,2022</td>
                                        <td>5:12 pm</td>
                                        <td>Document Deleted</td>
                                        <td>
                                            <div class="description">
                                                User Dexter John Perdido deleted the document MMSU Waiver.docx
                                            </div>
                                            <div class="full-description">
                                                User Dexter John Perdido deleted the document MMSU Waiver.docx
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Dexter John Perdido</td>
                                        <td>June 08,2022</td>
                                        <td>5:12 pm</td>
                                        <td>Document Deleted</td>
                                        <td>
                                            <div class="description">
                                                User Dexter John Perdido deleted the document MMSU Waiver.docx
                                            </div>
                                            <div class="full-description">
                                                User Dexter John Perdido deleted the document MMSU Waiver.docx
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Dexter John Perdido</td>
                                        <td>June 08,2022</td>
                                        <td>5:12 pm</td>
                                        <td>Document Deleted</td>
                                        <td>
                                            <div class="description">
                                                User Dexter John Perdido deleted the document MMSU Waiver.docx
                                            </div>
                                            <div class="full-description">
                                                User Dexter John Perdido deleted the document MMSU Waiver.docx
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="../js/employee_dashboard.js"></script>
</body>
</html>