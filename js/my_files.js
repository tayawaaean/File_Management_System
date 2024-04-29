document.addEventListener("DOMContentLoaded", function () {

    const folderGrid = document.querySelector('.grid-container');
    const addFolderBtn = document.getElementById('addFolderBtn');
    const folderForm = document.getElementById('folderForm');
    const folderNameInput = document.getElementById('folderName');
    const tableBody = document.querySelector('.files-table-wrapper tbody');
    const cancelButton = document.getElementById("cancelButton");
    
    let clickedFolder = null;

    function showContextMenu2(event) {
        event.preventDefault();
    
        if (event.button === 2) {
            const clickedFolder = event.target.closest(".folder");
            const clickedFile = event.target.closest(".file1");    
            const contextMenu2 = document.getElementById("contextMenu2");
    
            if (!clickedFolder && !clickedFile) {
                contextMenu2.style.display = "block";
                contextMenu2.style.left = (event.clientX + window.scrollX) + "px";
                contextMenu2.style.top = (event.clientY + window.scrollY) + "px";
            } else {
                contextMenu2.style.display = "none";
            }
        } else {
            const contextMenu2 = document.getElementById("contextMenu2");
            contextMenu2.style.display = "none";
        }
    }
    
    document.addEventListener("click", function(event) {
        // Hide the context menu when a left click occurs
        const contextMenu2 = document.getElementById("contextMenu2");
        contextMenu2.style.display = "none";
    });
    
    // Add event listeners for right-click and click outside the context menu to hide it
    document.addEventListener('contextmenu', showContextMenu2);
    document.addEventListener('click', hideContextMenu);

    function showContextMenu(event) {
    event.preventDefault(); // Prevent default right-click menu
    const contextMenu = document.getElementById("contextMenu");
    const clickedFolder = event.target.closest('.folder, .file1'); // Assuming the folder element has a class "folder"

    if (clickedFolder) {
        const rect = clickedFolder.getBoundingClientRect();
        contextMenu.style.display = "block";
        contextMenu.style.left = (rect.left + window.scrollX + 10) + "px"; // Adjust as needed
        contextMenu.style.top = (rect.top + window.scrollY + 10) + "px"; // Adjust as needed
    } else {
        hideContextMenu();
    }
}

function hideContextMenu() {
    const contextMenu = document.getElementById("contextMenu");
    contextMenu.style.display = "none";
}

document.addEventListener("DOMContentLoaded", function() {
    document.addEventListener("contextmenu", showContextMenu);
    document.addEventListener("click", function(event) {
        const contextMenu = document.getElementById("contextMenu");
        if (!contextMenu.contains(event.target)) {
            hideContextMenu();
        }
    });
});
    
    function addFolder(folderName) {
        const folderContainer = document.querySelector('.folders'); // Select the folders container
        const newFolder = document.createElement('div'); // Create a new folder div
        newFolder.classList.add('folder'); // Add the folder class
        newFolder.setAttribute('data-folder', folderName); // Set the data-folder attribute
        const icon = document.createElement('i'); // Create an icon element
        icon.classList.add('uil', 'uil-folder'); // Add classes to the icon
        const folderNameSpan = document.createElement('span'); // Create a span element for folder name
        folderNameSpan.classList.add('folder-name'); // Add class to the span
        folderNameSpan.textContent = folderName; // Set the text content of the span
        newFolder.appendChild(icon);
        newFolder.appendChild(folderNameSpan);
        newFolder.addEventListener('contextmenu', showContextMenu);
        newFolder.addEventListener('click', function () {
            openFolder(folderName);
        });
        folderContainer.appendChild(newFolder);
    }

    function addFolderToTable(folderName) {
        const newRow = document.createElement('tr');
        newRow.innerHTML = `
            <td><i class="uil-folder"></i> ${folderName}</td>
            <td>${getCurrentDate()}</td>
            <td>0 MB</td>
            <td>Your Name</td>
            <td>
                <a href="#" class="icon-button"><i class="material-icons">cloud_download</i></a>
                <a href="#" class="icon-button delete-file"><i class="material-icons">delete</i></a>
                <a href="#" class="icon-button rename-file"><i class="material-icons">border_color</i></a>
            </td>
        `;
        tableBody.appendChild(newRow);
        attachRenameEventListener(newRow);
        attachDeleteEventListener(newRow);  
    }
    
    function togglePopup() {
        const folderPopup = document.getElementById("folderPopup");
        if (folderPopup.style.display === "none") {
            folderPopup.style.display = "block"; // Show the popup
        } else {
            folderPopup.style.display = "none"; // Hide the popup
        }
    }

    // Function to handle form submission
    function handleFormSubmit(event) {
        event.preventDefault();
        const folderName = folderNameInput.value.trim();
        if (folderName !== '') {
            addFolder(folderName);
            addFolderToTable(folderName); // Add folder to tables section
            togglePopup(); // Hide the popup after creating the folder
            folderNameInput.value = ''; // Clear the input field
        }
    }

    function cancelFolderCreation() {
        document.getElementById("folderPopup").style.display = "none"; // Hide the popup
        document.getElementById("folderName").value = ''; // Clear the input field
        document.getElementById("renamePopup").style.display = "none";
    }

    cancelButton.addEventListener("click", cancelFolderCreation);
    addFolderBtn.addEventListener('click', togglePopup);
    folderForm.addEventListener('submit', handleFormSubmit);

    // Add event listeners to show context menu on right-click and hide it on click anywhere else
    document.addEventListener("contextmenu", showContextMenu);
    document.addEventListener("click", hideContextMenu);

    // Event listener for right-click on folder
    folderGrid.addEventListener('contextmenu', function (event) {
        event.preventDefault();
        clickedFolder = event.target.closest('.folder, .file1');
        if (clickedFolder) {
            showContextMenu(event.clientX, event.clientY);
        }
    });

    // Function to open folder
    function openFolder(folderName) {
        // Simulating navigation by storing the current folder in local storage
        localStorage.setItem('currentFolder', folderName);
        // Redirect to the folder page or perform other actions as needed
        window.location.href = '/folders/' + folderName; // Redirect to the corresponding folder page
    }

});

function toggleLayout() {
    var table = document.getElementById("fileTable");
    var folderGrid = document.getElementById("folderGrid");
    var seperationText = document.getElementById("seperationText");
    var TextFiles = document.getElementById("TextFiles");

    if (table.style.display === "none") {
        table.style.display = "block";
        folderGrid.style.display = "none";
        fileGrid.style.display = "none";
        seperationText.style.display = "none"
        TextFiles.style.display = "none"
    } else {
        table.style.display = "none";
        folderGrid.style.display = "flex";
        fileGrid.style.display = "flex";
        seperationText.style.display = "flex"
        TextFiles.style.display = "flex"
    }
}

const fileIcons = {
    'pdf': 'bx bxs-file-pdf', // Example: PDF file icon class
    'doc': 'bx bxs-file-word', // Example: Word document icon class
    'docx': 'bx bxs-file-word',
    'txt': 'bx bxs-file-text', // Example: Text file icon class
    // Add more file extensions and corresponding icon classes as needed
};

// Function to get file icon class based on file extension
function getFileIconClass(fileName) {
    const extension = fileName.split('.').pop().toLowerCase();
    return fileIcons[extension] || 'bx bxs-folder'; // Default icon class if extension not found
}
// Global array to store uploaded files
let uploadedFiles = [];

function handleFileUpload() {
    const fileInput = document.getElementById('fileUpload');
    const files = fileInput.files;
    uploadedFiles.push(...files);
    displayFiles(uploadedFiles);
    addFilesToTable(files);
    
    // Store uploaded files in the global array
    
}

function getFileIcon(fileExtension) {
    // Map file extensions to corresponding Font Awesome icons
    const iconMap = {
        'pdf': 'fa-file-pdf',
        'doc': 'fa-file-word',
        'docx': 'fa-file-word',
        'xls': 'fa-file-excel',
        'xlsx': 'fa-file-excel',
        'ppt': 'fa-file-powerpoint',
        'pptx': 'fa-file-powerpoint',
        'txt': 'fa-file-alt',
        'jpg': 'fa-file-image',
        'jpeg': 'fa-file-image',
        'png': 'fa-file-image',
        'gif': 'fa-file-image',
        'mp3': 'fa-file-audio',
        'wav': 'fa-file-audio',
        'mp4': 'fa-file-video',
        'avi': 'fa-file-video',
        'zip': 'fa-file-archive',
        'rar': 'fa-file-archive',
        '7z': 'fa-file-archive',
        'default': 'fa-file'
    };

    // Get the corresponding icon for the file extension
    const iconClass = iconMap[fileExtension.toLowerCase()] || iconMap['default'];

    return iconClass;
}

function displayFiles(files) {
    const fileContainer = document.querySelector('.files1');

    files.forEach(file => {
        const fileName = file.name;
        const fileExtension = fileName.split('.').pop(); // Get file extension
        
        // Check if the file already exists in the container
        const existingFile = fileContainer.querySelector(`[data-name="${fileName}"]`);
        if (existingFile) {
            return; // Skip adding the file if it already exists
        }

        // Create a new div element for the file
        const fileDiv = document.createElement('div');
        fileDiv.classList.add('file1');
        fileDiv.setAttribute('data-name', fileName); // Add data attribute to identify the file

        // Create an icon element based on the file extension
        const iconClass = getFileIcon(fileExtension);
        const icon = document.createElement('i');
        icon.classList.add('fa', iconClass);

        // Create a span element for the file name
        const fileNameSpan = document.createElement('span');
        fileNameSpan.textContent = fileName;
        fileNameSpan.classList.add('file1-name');

        // Append the icon and file name span to the file div
        fileDiv.appendChild(icon);
        fileDiv.appendChild(fileNameSpan);

        // Append the file div to the file container
        fileContainer.appendChild(fileDiv);
    });
}

function addFilesToTable(files) {
    const tableBody = document.querySelector('#filesTable tbody');

    for (let i = 0; i < files.length; i++) {
        const file = files[i];
        const fileExtension = getFileExtension(file.name);
        const fileIconClass = getFileIcon(fileExtension);
        const fileSizeMB = (file.size / (1024 * 1024)).toFixed(2);

        // Create table row
        const newRow = document.createElement('tr');
        newRow.innerHTML = `
            <td><i class="fas ${fileIconClass}"></i>${file.name}</td>
            <td>${getCurrentDate()}</td>
            <td>${fileSizeMB} MB</td>
            <td>Your Name</td>
            <td>
                 <a href="#" class="icon-button"><i class="material-icons">cloud_download</i></a>
                 <a href="#" class="icon-button delete-file"><i class="material-icons">delete</i></a>
                 <a href="#" class="icon-button rename-file"><i class="material-icons">border_color</i></a>
            
            </td>
        `;
        tableBody.appendChild(newRow);
        attachRenameEventListener(newRow);
        attachDeleteEventListener(newRow);
    }
}

// Function to get file extension
function getFileExtension(filename) {
    return filename.split('.').pop().toLowerCase();
}



function attachRenameEventListener(row) {
    const renameButtons = row.querySelectorAll('.icon-button.rename-file');

    // Function to handle the renaming process
    function handleRenameClick(event) {
        event.preventDefault();
        const folderNameCell = this.closest('tr').querySelector('td:first-child');
        const folderName = folderNameCell.textContent.trim();
        const renamePopup = document.getElementById('renamePopup');
        const newFolderNameInput = document.getElementById('newFolderName');

        newFolderNameInput.value = folderName;
        renamePopup.style.display = 'block';

        const renameForm = document.getElementById('renameForm');

        function handleRenameFormSubmit(e) {
            e.preventDefault();
            const newName = newFolderNameInput.value.trim();

            if (newName !== '') {
                // Update the folder name in the tables section
                const fileExtension = getFileIcon(getFileExtension(newName)); // Get file extension and determine icon class
                folderNameCell.innerHTML = `<i class="fas ${fileExtension}"></i> ${newName}`;

                // Update the folder name in the folders section
                const folderElement = document.querySelector(`.folder[data-folder="${folderName}"]`);
                if (folderElement) {
                    folderElement.setAttribute('data-folder', newName);
                    folderElement.querySelector('.folder-name').textContent = newName;
                }

                const fileElements = document.querySelectorAll('.file1');
                fileElements.forEach(fileElement => {
                    const fileNameElement = fileElement.querySelector('.file1-name');
                    const fileName = fileNameElement.textContent;
                     if (fileName.startsWith(folderName)) {
                    // Update the file name
                        fileNameElement.textContent = fileName.replace(folderName, newName);
                        const iconElement = fileElement.querySelector('i');
                        const fileExtension = getFileIcon(getFileExtension(newName)); // Get file extension and determine icon class
                        iconElement.className = `fas ${fileExtension}`;
                     }
                });
            }

            renamePopup.style.display = 'none';
            renameForm.removeEventListener('submit', handleRenameFormSubmit);
        }

        renameForm.addEventListener('submit', handleRenameFormSubmit);
    }

    // Attach click event listener to each rename button
    renameButtons.forEach(renameButton => {
        renameButton.addEventListener('click', handleRenameClick);
    });
}



function attachDeleteEventListener(row) {
    const deleteButton = row.querySelector('.icon-button.delete-file');

    // Function to handle the deletion process
    function handleDeleteClick(event) {
        const folderNameCell = this.closest('tr').querySelector('td:first-child');
        const folderName = folderNameCell.textContent.trim();
        const deletePopup = document.getElementById('deletePopup');

        // Display the delete confirmation popup
        deletePopup.style.display = 'block';

        const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
        const cancelDeleteBtn = document.getElementById('cancelDeleteBtn');

        function confirmDelete() {
            // Perform deletion actions here
            // For example:
            // 1. Remove the row from the table
            row.remove();

            // 2. Remove corresponding elements from other sections if needed
            const folderElement = document.querySelector(`.folder[data-folder="${folderName}"]`);
            if (folderElement) {
                folderElement.remove();
            }

            const fileElements = document.querySelectorAll('.file1');
            fileElements.forEach(fileElement => {
                const fileName = fileElement.textContent;
                if (fileName.startsWith(folderName)) {
                    fileElement.remove();
                }
            });

            // Hide the delete confirmation popup
            deletePopup.style.display = 'none';

            // Remove event listeners
            confirmDeleteBtn.removeEventListener('click', confirmDelete);
            cancelDeleteBtn.removeEventListener('click', cancelDelete);
        }

        function cancelDelete() {
            // Hide the delete confirmation popup
            deletePopup.style.display = 'none';

            // Remove event listeners
            confirmDeleteBtn.removeEventListener('click', confirmDelete);
            cancelDeleteBtn.removeEventListener('click', cancelDelete);
        }

        // Add event listeners to delete and cancel buttons
        confirmDeleteBtn.addEventListener('click', confirmDelete);
        cancelDeleteBtn.addEventListener('click', cancelDelete);

        event.preventDefault();
    }

    deleteButton.addEventListener('click', handleDeleteClick);
}


// Function to get current date
function getCurrentDate() {
    const currentDate = new Date();
    const year = currentDate.getFullYear();
    let month = currentDate.getMonth() + 1;
    month = month < 10 ? '0' + month : month;
    let day = currentDate.getDate();
    day = day < 10 ? '0' + day : day;
    return `${year}-${month}-${day}`;
}

// Function to handle search
// Function to handle search
function handleSearch() {
    const searchInput = document.getElementById('searchInput');
    const searchText = searchInput.value.toLowerCase(); // Get the value of the search input and convert it to lowercase for case-insensitive search

    // Get all file and folder elements
    const files = document.querySelectorAll('.file1-name');
    const folders = document.querySelectorAll('.folder-name');

    // Loop through all file elements and hide those that do not match the search input
    files.forEach(file => {
        const fileName = file.textContent.toLowerCase(); // Get the text content of the file name and convert it to lowercase
        if (fileName.includes(searchText)) {
            file.parentElement.style.display = ''; // Show the file element
        } else {
            file.parentElement.style.display = 'none'; // Hide the file element
        }
    });

    // Loop through all folder elements and hide those that do not match the search input
    folders.forEach(folder => {
        const folderName = folder.textContent.toLowerCase(); // Get the text content of the folder name and convert it to lowercase
        if (folderName.includes(searchText)) {
            folder.parentElement.style.display = ''; // Show the folder element
        } else {
            folder.parentElement.style.display = 'none'; // Hide the folder element
        }
    });

    // Search within the table rows and hide those rows that do not match the search input
    const tableRows = document.querySelectorAll('#filesTable tbody tr');
    tableRows.forEach(row => {
        const cells = row.querySelectorAll('td'); // Get all cells in the row
        let matchFound = false; // Flag to indicate if a match is found in any cell
        cells.forEach(cell => {
            const cellText = cell.textContent.toLowerCase(); // Get the text content of the cell and convert it to lowercase
            if (cellText.includes(searchText)) {
                matchFound = true; // Set the flag to true if a match is found
            }
        });
        if (matchFound) {
            row.style.display = ''; // Show the row if a match is found
        } else {
            row.style.display = 'none'; // Hide the row if no match is found
        }
    });
}


// Sorting function for files and folders
function sortFilesAndFolders() {
    const filesContainer = document.querySelector('.files1');
    const foldersContainer = document.querySelector('.folders');

    const files = Array.from(filesContainer.children);
    const folders = Array.from(foldersContainer.children);

    // Sort files
    files.sort((a, b) => {
        const nameA = a.textContent.trim().toLowerCase();
        const nameB = b.textContent.trim().toLowerCase();
        return nameA.localeCompare(nameB);
    });

    // Sort folders
    folders.sort((a, b) => {
        const nameA = a.textContent.trim().toLowerCase();
        const nameB = b.textContent.trim().toLowerCase();
        return nameA.localeCompare(nameB);
    });

    // Reorder the elements in the containers
    files.forEach(item => filesContainer.appendChild(item));
    folders.forEach(item => foldersContainer.appendChild(item));
}

document.addEventListener('DOMContentLoaded', function() {
    const sortByNameLink = document.getElementById('sortByName');
    sortByNameLink.addEventListener('click', function(event) {
        event.preventDefault(); // Prevent the default behavior of the link
        
        sortFilesAndFolders(); // Call the sorting function
    });
});


document.addEventListener("DOMContentLoaded", function () {
    // Enable drag and drop for the regular file container
    enableDragAndDrop('dropdrag', '.files1');

    // Enable drag and drop for the table section
    enableDragAndDrop('tableDropZone', '#filesTable tbody');
});

function enableDragAndDrop(dropZoneId, targetContainerSelector) {
    const dropZone = document.getElementById(dropZoneId);
    const targetContainer = document.querySelector(targetContainerSelector);

    dropZone.addEventListener('dragover', function (e) {
        e.preventDefault();
        dropZone.classList.add('dragover');
    });

    dropZone.addEventListener('dragleave', function () {
        dropZone.classList.remove('dragover');
    });

    dropZone.addEventListener('drop', function (e) {
        e.preventDefault();
        dropZone.classList.remove('dragover');

        const files = e.dataTransfer.files;
        addFilesToTable1(files); // Call the addFilesToTable function with dropped files
    });
}

function addFilesToTable1(files) {
    const tableBody = document.querySelector('#filesTable tbody');
    const filesContainer = document.querySelector('.files1');

    // Get the list of existing file names in the table and files container
    const existingFileNames = Array.from(tableBody.querySelectorAll('tr td:first-child'), td => td.textContent);
    const existingFiles = Array.from(filesContainer.querySelectorAll('.file1-name'), span => span.textContent);

    for (let i = 0; i < files.length; i++) {
        const file = files[i];
        const fileName = file.name;

        // Check if the file name already exists in the table or files container
        if (existingFileNames.includes(fileName) || existingFiles.includes(fileName)) {
            console.log(`File '${fileName}' already exists.`);
            continue; // Skip adding the file
        }

        const fileExtension = getFileIcon(getFileExtension(fileName)); // Get file extension and determine icon class
        const fileSizeMB = (file.size / (1024 * 1024)).toFixed(2);

        // Create table row
        const tableRow = document.createElement('tr');
        tableRow.innerHTML = `
            <td><i class="fas ${fileExtension}"></i>${fileName}</td>
            <td>${getCurrentDate()}</td>
            <td>${fileSizeMB} MB</td>
            <td>Your Name</td>
            <td>
                <a href="#" class="icon-button"><i class="material-icons">cloud_download</i></a>
                <a href="#" class="icon-button delete-file"><i class="material-icons">delete</i></a>
                <a href="#" class="icon-button rename-file"><i class="material-icons">border_color</i></a>
            </td>
        `;
        tableBody.appendChild(tableRow);
        attachRenameEventListener(tableRow);
        attachDeleteEventListener(tableRow);

        // Create file div for .files1 section
        const fileDiv = document.createElement('div');
        fileDiv.classList.add('file1');
        fileDiv.innerHTML = `<i class="fas ${fileExtension}"></i><span class="file1-name">${fileName}</span>`;
        filesContainer.appendChild(fileDiv);
    }
}