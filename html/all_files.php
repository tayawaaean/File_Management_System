<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- External CSS -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <!-- Example Font Awesome CDN link -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- Internal CSS -->
    
    <link rel="stylesheet" href="../css/my_files.css">

    <script src="../js/my_files.js"></script>

    <title>Admin Panel</title>
</head>
<body>
    <nav>
        <div class="logo-name">
            <div class="logo-image">
                <img src="../img/BNHS Logo.png" alt="">
            </div>
            <span class="logo_name">Bingao NHS</span>
        </div>

        <!-- Menu Items -->
        <div class="menu-items">
            <ul class="nav-links">
                <li><a href="index.php">
                    <i class="uil uil-estate"></i>
                    <span class="link-name">Dashboard</span>
                </a></li>
                <li>
                <a href="all_files.php">
                  <i class="material-symbols-outlined">save</i>
                  <span class="link-name">All Files</span>
                </a>
              </li>
                <li><a href="user.php">
                    <i class="material-symbols-outlined">person</i>
                    <span class="link-name">Employees</span>
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
            <img src="images/user.jpeg" alt="">
        </div>

        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <h2>Dashboard</h2>
                </div>
            </div>

            <!-- Search Box and Sort Select -->
            <div class="bottom-search">
                <div class="search">
                    <i class="uil uil-search"></i>
                    <input type="text" id="searchInput" placeholder="Search..." oninput="handleSearch()">
                </div>

                <div class="button-container">
                    <div class="dropdown">
                        <button id="dropdown1" class="dropbtn">
                            <i class="material-symbols-outlined">upload</i>
                        </button>
                        <div class="dropdown-content">
                            <button id="addFolderBtn" class="add-folder-icon">
                                <i class="material-symbols-outlined">create_new_folder</i>
                                <span class="text">Create Folder</span>
                            </button>
                            <button onclick="document.getElementById('fileUpload').click();">
                                <i class="material-symbols-outlined">upload_file</i>
                                <span class="text">File Upload</span>
                            </button>
                        </div>
                    </div>
                    <button onclick="toggleLayout()">
                        <i class="material-symbols-outlined">view_list</i>
                    </button>
                    <div class="dropdown2">
                        <button class="dropbtn2">
                            <i class="material-symbols-outlined">filter_list</i>
                        </button>
                        <div class="dropdown-content2">
                            <a href="#" id="sortByName">Sort by Name </a>
                            <a href="#" id="sortByDate">Sort by Date</a>
                            <a href="#" id="sortByFileType">Sort by File Type</a>
                            <a href="#" id="sortByFileSize">Sort by File Size</a>
                        </div>

                    </div>
                </div>

            </div>
        </div>
        <div id="folderPopup" class="popup" style="display: none;">
            <form id="folderForm">
                <label for="folderName" class="label">Folder Name:</label>
                <input type="text" id="folderName" name="folderName" class="input" required>
                <div class="button-group">
                    <button type="submit" class="button">Create</button>
                    <button type="button" id="cancelButton" class="button" onclick="cancelFolderCreation()">Cancel</button>
                </div>
            </form>
        </div>


        <div id="renamePopup" class="popup" style="display: none;">
            <form id="renameForm">
                <label for="newFolderName" class="label">New Folder Name:</label>
                <input type="text" id="newFolderName" name="newFolderName" class="input" required>
                <button type="submit" id="confirmRenameBtn">Rename</button>
                <button type="button" id="cancelRenameBtn" class="button" onclick="cancelFolderCreation()">Cancel</button>
            </form>
        </div>

        <div id="deletePopup" class="popup" style="display: none;">
            <div class="popup-content">
                <h3>Delete Folder</h3>
                <p>Are you sure you want to delete this folder?</p>
                <div class="buttons">
                    <button id="confirmDeleteBtn">Delete</button>
                    <button id="cancelDeleteBtn">Cancel</button>
                </div>
            </div>
        </div>
        <div class="separation-text" id="seperationText">Folder</div>
        <div class="container">
            <div class="folder-container" id="folderGrid" ondrop="drop(event, 'folder')" ondragover="allowDrop(event)" ondragenter="dragEnter(event)" ondragleave="dragLeave(event)">
                <div class="folders">
                    <div class="folder">Folder 1</div>
                    <!-- Add more folder elements as needed -->
                    <!-- Folders will be dynamically added here -->
                </div>
            </div>
            <!-- Separation text -->
            <div class="separation-text" id="TextFiles">Files</div>

            <!-- File container -->
            <div class="file-container" id="fileGrid" ondrop="drop(event, 'file')" ondragover="allowDrop(event)" ondragenter="dragEnter(event)" ondragleave="dragLeave(event)">
                <div class="files1">
                    <div class="file1">
                        <span class="file1-name">Your File Name Here</span>
                    </div>
                    <div class="file1">
                        <span class="file1-name">Your.pdf</span>
                    </div>
                    <!-- Add more file elements as needed -->
                </div>
            </div>
        </div>

        <div id="fileTable" class="table-containers">
            <div class="files-table-wrapper">
                <table id="filesTable" class="tables">
                    <thead>
                        <tr>
                            <th>File Name</th>
                            <th>Last Modified</th>
                            <th>File Size</th>
                            <th>Owner</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>



        <!-- Context menu template -->
        <div id="contextMenu" class="context-menu">
            <ul>
                <li id="renameFolder"><i class='material-symbols-outlined'>border_color</i>Rename</li>
                <li id="copyFolder"><i class="material-symbols-outlined">content_copy</i>Copy</li>
                <li id="pasteFolder"><i class="material-symbols-outlined">content_paste</i>Paste</li>
                <li id="deleteFolder"><i class="material-symbols-outlined">delete</i>Delete</li>
                <li id="pasteFolder"><i class="material-symbols-outlined">download</i>Download</li>
            </ul>
        </div>

        <input type="file" id="fileUpload" style="display: none;" onchange="handleFileUpload();">


        <!-- Modify your button to trigger file upload -->
        </div>
    </section>

</body>
</html>