<?php
session_start();
include '../connection/connection.php';
include '../connection/login_checker.php';
?>
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
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Internal CSS -->
    
    <link rel="stylesheet" href="../css/my_files.css">
    <script src="../js/my_files.js"></script>
    <script>
    function createFolder(event) {
    event.preventDefault(); // Prevent default form submission behavior

    // Get the folder name from the input field
    var folderName = document.getElementById('folderName').value;

    // AJAX call to PHP script to create folder
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '../connection/save_folder.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // Folder created successfully
                console.log('Folder created successfully');
                // You can add further actions here, like displaying a success message or refreshing the folder list
            } else {
                // Error creating folder
                console.error('Error creating folder');
                // You can add further error handling here
            }
        }
    };
    xhr.send('folderName=' + encodeURIComponent(folderName)); // Send folder name to PHP script
}
    </script>
<script>
    function uploadFile() {
        // Get the form element
        var form = document.getElementById("fileUploadForm");

        // Create FormData object to send files
        var formData = new FormData(form);

        // Add selected folder name to FormData
        var selectedFolder = document.getElementById("destinationFolder").value;
        formData.append("folderName", selectedFolder);

        // Create XMLHttpRequest object
        var xhr = new XMLHttpRequest();

        // Define what happens on successful data submission
        xhr.onload = function() {
            if (xhr.status === 200) {
                alert(xhr.responseText); // Display success message
            } else {
                alert("Error uploading file."); // Display error message
            }
        };

        // Define what happens in case of error
        xhr.onerror = function() {
            alert("Error uploading file."); // Display error message
        };

        // Open connection to the server
        xhr.open("POST", "../connection/upload_files.php", true);

        // Send data
        xhr.send(formData);
    }
</script>
<script>
// Function to handle folder upload
function uploadFolder() {
    // Get the selected folder input element
    var folderInput = document.getElementById('folderInput');
    // Get the selected destination folder
    var destinationFolder = document.getElementById('destinationFolder_2').value;

    // Check if a folder is selected
    if (destinationFolder === 'none') {
        alert("Please select a destination folder.");
        return;
    }

    // Check if a folder is selected
    if (folderInput.files.length === 0) {
        alert("Please select a folder to upload.");
        return;
    }

    // Create FormData object to send data to the server
    var formData = new FormData();
    // Add the selected folder(s) to the FormData object
    for (var i = 0; i < folderInput.files.length; i++) {
        formData.append('folderInput[]', folderInput.files[i]);
    }
    // Add the selected destination folder to the FormData object
    formData.append('folderName', destinationFolder);

    // Send a POST request to upload the folder(s)
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '../connection/upload_folder.php', true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            // If the upload is successful, display a success message
            alert(xhr.responseText);
            // Optionally, reload the page to update the folder list
            location.reload();
        } else {
            // If there's an error, display an error message
            alert('Error uploading folder: ' + xhr.statusText);
        }
    };
    // Send the FormData object
    xhr.send(formData);
}
</script>
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

        <!-- Menu Items -->
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
            <img src="images/user.jpeg" alt="">
        </div>

        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <h2>My Files</h2>
                </div>
                <hr>
            </div>

            <div id="fileUploadPopup" class="popup" style="display: none;">
            <h3>Upload File</h3>
<form id="fileUploadForm" enctype="multipart/form-data">
    <input type="file" id="fileInput" name="fileInput">
    <div style="display: inline-block; vertical-align: top;">
        <p>Choose a folder:</p>
        <select id="destinationFolder">
            <option value="none">None</option>
            <?php
            // Fetch folders from the database based on the username
            $username = $_SESSION['username'];
            $query = "SELECT folder_name FROM folders WHERE username = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();

            // Generate <option> elements for each folder
            while ($row = $result->fetch_assoc()) {
                $folderName = $row['folder_name'];
                echo "<option value='$folderName'>$folderName</option>";
            }
            ?>
        </select>
    </div>
    <div style="display: block;">
        <button type="button" id="uploadFileBtn" onclick="uploadFile()">Upload</button>
        <button type="button" id="cancelUploadBtn" onclick="cancelFileUpload()">Cancel</button>
    </div>
</form>
</div>

<div id="folderUploadPopup" class="popup" style="display: none;">
    <h3>Upload Folder</h3>
    <form id="folderUploadForm" enctype="multipart/form-data">
        <input type="file" id="folderInput" name="folderInput" multiple directory webkitdirectory mozdirectory>
        <div style="display: inline-block; vertical-align: top;">
            <p>Choose a folder:</p>
            <select id="destinationFolder_2">
                <option value="none">None</option>
                <?php
                // Fetch folders from the database based on the username
                $username = $_SESSION['username'];
                $query = "SELECT folder_name FROM folders WHERE username = ?";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("s", $username);
                $stmt->execute();
                $result = $stmt->get_result();

                // Generate <option> elements for each folder
                while ($row = $result->fetch_assoc()) {
                    $folderName = $row['folder_name'];
                    echo "<option value='$folderName'>$folderName</option>";
                }
                ?>
            </select>
        </div>
        <div style="display: block;">
            <button type="button" id="uploadFolderBtn" onclick="uploadFolder()">Upload</button>
            <button type="button" id="cancelFolderUploadBtn" onclick="cancelFolderUpload()">Cancel</button>
        </div>
    </form>
</div>
<div class="container" id="dropdrag">
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
                        <button id="addFolderBtn" class="add-folder-icon" >
                            <i class="material-symbols-outlined">create_new_folder</i>
                            <span class="text">Create Folder</span>
                        </button>
                        <button id="fileUploadBtn">
                            <i class="material-symbols-outlined">upload_file</i>
                            <span class="text">File Upload</span>
                        </button>
                        <button id="folderUploadBtn">
                            <i class="material-symbols-outlined">drive_folder_upload</i>
                            <span class="text">Folder Upload</span>
                        </button>
                    </div>
            </div>
                <button onclick="toggleLayout()" class="dropbttn">
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
    <div id="folderPopup" class="popup" style="display: none;">
    <form id="folderForm" onsubmit="createFolder(event)">
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
            <button type="button" id="cancelRenameBtn" class="button">Cancel</button>
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
    <div class="folder-container" id="folderGrid"> 
    <div class="folders">
                <div class="folder">Folder 1</div>
    </div>

        </div>
            <!-- Separation text -->
            <div class="separation-text" id="TextFiles">Files</div>
            <!-- File container -->
                <div class="file-container" id="fileGrid"> 
                    <div class="files1">
                      
                    <!-- Add more file elements as needed -->
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
                                <th>Folder</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                // Check if the user is logged in
                                if (!isset($_SESSION['username'])) {
                                    // Redirect to login page or handle unauthorized access
                                    header("Location: login.php");
                                    exit();
                                }

                                // Include necessary files
                                include '../connection/connection.php';
                                include '../connection/login_checker.php';

                                // Get the username from the session
                                $username = $_SESSION['username'];

                                // Fetch files from the database based on the username
                                $query = "SELECT * FROM files WHERE owner = ?";
                                $stmt = $conn->prepare($query);
                                $stmt->bind_param("s", $username);
                                $stmt->execute();
                                $result = $stmt->get_result();

                                // Display the files in the table
                                while ($row = $result->fetch_assoc()) {
                                    // Decode the file name and file size from binary
                                    $decodedFileName = base64_decode($row['file_name']);
                                    $decodedFileSize = base64_decode($row['file_size']);

                                    // Output the file details in the table rows
                                    echo "<tr>";
                                    echo "<td>$decodedFileName</td>";
                                    echo "<td>{$row['date_time']}</td>";
                                    echo "<td>$decodedFileSize</td>";
                                    echo "<td>{$row['folder_name']}</td>";
                                    // Add action buttons or links as needed
                                    echo "<td>Action buttons or links</td>";
                                    echo "</tr>";
                                }
                                ?>

                        </tbody>
                    </table>
                </div>
</div>

            </div>
        </div>
    </div>
</div>
        <!-- Context menu template -->
        <div id="contextMenu" class="context-menu">
            <ul>
                <li id="renameFolder" class="icon-button rename-file">
                      <i class="material-symbols-outlined">border_color</i>
                        <span>Rename</span>
                </li>


                <li id="copyFolder"><i class="material-symbols-outlined">content_copy</i>Copy</li>
                <li id="pasteFolder"><i class="material-symbols-outlined">content_paste</i>Paste</li>
                <li id="deleteFolder" ><i class="material-symbols-outlined">delete</i>Delete</li>
                <li id="pasteFolder"><i class="material-symbols-outlined">download</i>Download</li>
            </ul>
        </div>

        <div id="contextMenu2" class="context-menu2">
            <ul>  
                <li onclick="document.getElementById('fileUpload').click();"><i class='material-symbols-outlined'>upload_file</i>Upload File</li>
                <li id="copyFolder"><i class="material-symbols-outlined">create_new_folder</i>Create Folder</li>
                <li id="pasteFolder"><i class="material-symbols-outlined">content_paste</i>Paste</li>            
            </ul>
        </div>

        <input type="file" id="fileUpload" style="display: none;" onchange="handleFileUpload();">

    </section>
    <script>
// Add this JavaScript to handle the file upload popup
function showFileUploadPopup() {
    document.getElementById('fileUploadPopup').style.display = 'block';
}

function cancelFileUpload() {
    document.getElementById('fileUploadPopup').style.display = 'none';
}

// Function to handle individual file upload
function handleFileUpload(event) {
    event.preventDefault(); // Prevent default form submission behavior

    var fileInput = document.getElementById('fileInput');
    var destinationFolder = document.getElementById('destinationFolder').value;

    // Additional code to handle file upload via AJAX
}

// Function to handle folder upload
function handleFolderUpload(event) {
    event.preventDefault(); // Prevent default form submission behavior

    // Additional code to handle folder upload via AJAX
}

// Add event listener for the file upload button to show the popup
document.getElementById('fileUploadBtn').addEventListener('click', showFileUploadPopup);

// Add event listener for the form submission to handle individual file upload
document.getElementById('fileUploadForm').addEventListener('submit', handleFileUpload);
</script>


<script>
// Add this JavaScript to handle the folder upload popup
function showFolderUploadPopup() {
    document.getElementById('folderUploadPopup').style.display = 'block';
}

function cancelFolderUpload() {
    document.getElementById('folderUploadPopup').style.display = 'none';
}

// Function to handle folder upload
function handleFolderUpload(event) {
    event.preventDefault(); // Prevent default form submission behavior

    var folderInput = document.getElementById('folderInput').files;

    // Additional code to handle folder upload via AJAX
}

// Add event listener for the folder upload button to show the popup
document.getElementById('folderUploadBtn').addEventListener('click', showFolderUploadPopup);

// Add event listener for the form submission to handle folder upload
document.getElementById('folderUploadForm').addEventListener('submit', handleFolderUpload);
</script>
</body>
</html>