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
            
            <img src="/img/Catiwa, Kenric.jpeg" alt="">
        </div>

        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <h2>Dashboard</h2>
                </div>
                <hr>

                <div class="boxes">
                    <div class="box box2">
                    <i2 class="material-symbols-outlined">description</i2>
                    <span class="text">
                        <?php 
                            include '../connection/connection.php';

                            $username = $_SESSION['username'];

                            // Query to count total files for the logged-in user
                            $query = "SELECT COUNT(*) AS total FROM files WHERE owner = '$username'";
                            $result = $conn->query($query);

                            if ($result) {
                                $row = $result->fetch_assoc();
                                $totalFiles = $row['total'];
                            } else {
                                // Error handling if the query fails
                                $totalFiles = "N/A";
                            }
                        ?> 
                        <span class="number"><?php echo $totalFiles?></span>
                        <span class="text">Total Files</span>
                    </span>
                </div>
                <div class="box box3">
                <i class="material-symbols-outlined">folder_open</i>
                <span class="text">
                    <?php 
                        // Establish connection to the database
                        include '../connection/connection.php';

                        // Assuming $_SESSION['username'] contains the username
                        $username = $_SESSION['username'];

                        // Query to count total folders for the logged-in user
                        $query = "SELECT COUNT(*) AS total FROM folders WHERE username = '$username'";
                        $result = $conn->query($query);

                        if ($result) {
                            $row = $result->fetch_assoc();
                            $totalFolders = $row['total'];
                        } else {
                            // Error handling if the query fails
                            $totalFolders = "N/A";
                        }
                    ?>
                    <span class="number"><?php echo $totalFolders?></span>
                    <span class="text">Total Folders</span>
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
                                    // Get the username from the session
                                    $username = $_SESSION['username'];

                                    // Retrieve the name from the users table based on the username
                                    $nameQuery = $conn->query("SELECT name FROM users WHERE username='$username'");
                                    if ($nameQuery && $nameQuery->num_rows > 0) {
                                        $name = $nameQuery->fetch_assoc()['name'];

                                        // Fetch activity log entries based on the author's name
                                        $result = $conn->query("SELECT * FROM activity_log WHERE Author = '$name'");
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
                                                    <?php echo 'You ', 'accepted' ,' ',$row['Description'],' ','to be a new user.'?>
                                                    <?php } else if ($row['Action'] === "New User Denied") {?>
                                                    <?php echo 'You ','denied',' ',$row['Description'],' ','to be a new user.'?>
                                                    <?php } else if ($row['Action'] === "Profile Updated") {?>
                                                    <?php echo 'You ','updated your personal information.'?>
                                                    <?php } else if ($row['Action'] === "Uploaded a new file") {?>
                                                    <?php echo 'You ','uploaded a document in ',$row['Description'],' folder.'?>
                                                    <?php } else if ($row['Action'] === "Uploaded Multiple Files") {?>
                                                    <?php echo 'You ','uploaded multipe files in ',$row['Description'],' folder.'?>
                                                    <?php } else if ($row['Action'] === "Created A New Folder") {?>
                                                    <?php echo 'You ','created ',$row['Description'],' folder.'?>
                                                    <?php } else if ($row['Action'] === "Document Deleted") {?>
                                                    <?php echo 'You ','deleted the document',' ',$row['Description'],'.'?>
                                                    <?php } else if ($row['Action'] === "Document Upload") {?>
                                                    <?php echo 'You ','uploaded the document',' ',$row['Description'],'.'?>
                                                    <?php }?>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php endwhile; ?>
                                        <?php } // <-- Missing closing bracket for if block ?>
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