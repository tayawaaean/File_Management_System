<?php
include '../connection/verifier.php';
include '../connection/connection.php';?>
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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>


    <title>BNHS File Management System</title> 
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
                            <?php 
                                $result = $conn->query("SELECT COUNT(*) AS total FROM inbox;");
                                $row = $result->fetch_assoc();
                                $totalInbox = $row['total'];
                            ?>
                            <span class="number"><?php echo $totalInbox?></span>
                            <span class="text">Inbox</span>
                        </span>
                    </div>
                    <div class="box box2">
                        <i2 class="material-symbols-outlined">description</i2>
                        <span class="text">
                            <?php 
                                $result = $conn->query("SELECT COUNT(*) AS total FROM files;");
                                $row = $result->fetch_assoc();
                                $totalFiles = $row['total'];
                            ?>
                            <span class="number"><?php echo $totalFiles?></span>
                            <span class="text">Total Files</span>
                        </span>
                    </div>
                    <div class="box box3">
                        <i class="material-symbols-outlined">folder_open</i>
                        <span class="text">
                            <?php 
                                $result = $conn->query("SELECT COUNT(*) AS total FROM folders;");
                                $row = $result->fetch_assoc();
                                $totalFolders = $row['total'];
                            ?>
                            <span class="number"><?php echo $totalFolders?></span>
                            <span class="text">Total Folders</span>
                        </span>
                    </div>
                    <div class="box box4">
                        <i2 class="material-symbols-outlined">unarchive</i2>
                        <span class="text">
                            <?php 
                                $result = $conn->query("SELECT COUNT(*) AS total FROM sent_files;");
                                $row = $result->fetch_assoc();
                                $totalSentFiles = $row['total'];
                            ?>
                            <span class="number"><?php echo $totalSentFiles?></span>
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
                            <ul class="menu" id="Author">
                                <li data-author="None">None</li>
                                <?php 
                                    $result = $conn->query("SELECT DISTINCT Author FROM activity_log");
                                    while ($row = $result->fetch_assoc()): 
                                ?>
                                <li data-author="<?php echo $row['Author']?>"><?php echo $row['Author']?></li>
                                <?php endwhile?>
                            </ul>
                            <button id="dropdown2" class="dropdown-button">
                                <i class='bx bxs-calendar' ></i>
                            </button>                            
                            <ul class="menu">
                                <li data-month="None">None</li>
                                <li data-month="January">January</li>
                                <li data-month="February">February</li>
                                <li data-month="March">March</li>
                                <li data-month="April">April</li>
                                <li data-month="May">May</li>
                                <li data-month="June">June</li>
                                <li data-month="July">July</li>
                                <li data-month="August">August</li>
                                <li data-month="September">September</li>
                                <li data-month="October">October</li>
                                <li data-month="November">November</li>
                                <li data-month="December">December</li>
                            </ul>
                        </div>
                        
                        <div class="bottom-search">
                            <div class="search">
                                <i class="uil uil-search"></i>
                                <input type="text" id="custom-search" placeholder="Search...">
                            </div>
                        </div>
                    </div>
                    <div class="table-container">
                        <div class="dashboard-table-wrapper">
                            <table class="table" id="ActivityLog">
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
                                    <?php 
                                    $result = $conn->query("SELECT * FROM activity_log");
                                    while ($row = $result->fetch_assoc()): 
                                        $dateTime = $row['DateTime'];
                                        $date = date("F j, Y", strtotime($dateTime));
                                        $time = date("h:i A", strtotime($dateTime));
                                    ?>
                                    <tr>
                                        <td><?php echo $row['Author']?></td>
                                        <td><?php echo date('F j, Y', strtotime($row['DateTime'])); ?></td>
                                        <td><?php echo $time?></td>
                                        <td><?php echo $row['Action']?></td>
                                        <td>
                                        <div class="description">
                                                <?php if($row['Action'] === "New User Approved") { ?>
                                                <?php echo $row['job_title'],' ',$row['Author'],'', 'accepted' ,' ',$row['Description'],' ','to be a new user.'?>
                                                <?php } else if ($row['Action'] === "New User Denied") {?>
                                                <?php echo $row['job_title'],' ',$row['Author'],' ','denied',' ',$row['Description'],' ','to be a new user.'?>
                                                <?php } else if ($row['Action'] === "Document Deleted") {?>
                                                <?php echo $row['job_title'],' ',$row['Author'],' ','deleted the document',' ',$row['Description'],'.'?>
                                                <?php } else if ($row['Action'] === "Document Upload") {?>
                                                <?php echo $row['job_title'],' ',$row['Author'],' ','uploaded the document',' ',$row['Description'],'.'?>
                                                <?php }?>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endwhile; ?>
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