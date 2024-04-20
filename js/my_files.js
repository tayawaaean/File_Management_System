document.addEventListener("DOMContentLoaded", function () {
    const column1 = document.getElementById('column1');
    const column2 = document.getElementById('column2');
    const column3 = document.getElementById('column3');
    const folderGrid = document.querySelector('.grid-container');
    const contextMenu = document.getElementById('contextMenu');
    const folders = document.querySelectorAll('.folder');
    const addFolderBtn = document.getElementById('addFolderBtn');
    const folderPopup = document.getElementById('folderPopup');
    const folderForm = document.getElementById('folderForm');
    const folderNameInput = document.getElementById('folderName');
    const tableBody = document.querySelector('.files-table-wrapper tbody');
    const cancelButton = document.getElementById("cancelButton");
    const newFolderNameInput = document.getElementById('newFolderName');

    let clickedFolder = null;

    // Global array to store uploaded files
    

    // Function to show context menu
    function showContextMenu(event) {
        event.preventDefault(); // Prevent default right-click menu
        const contextMenu = document.getElementById("contextMenu");
        const clickedFolder = event.target.closest(".folder"); // Assuming the folder element has a class "folder"

        if (clickedFolder) {
            const rect = clickedFolder.getBoundingClientRect();
            contextMenu.style.display = "block";
            contextMenu.style.left = (rect.left + window.scrollX + 10) + "px"; // Adjust as needed
            contextMenu.style.top = (rect.top + window.scrollY + 10) + "px"; // Adjust as needed
        }
    }

    // Function to hide context menu
    function hideContextMenu() {
        const contextMenu = document.getElementById("contextMenu");
        contextMenu.style.display = "none";
    }

    // Function to add folder to folders section
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

        // Append icon and folder name span to the folder div
        newFolder.appendChild(icon);
        newFolder.appendChild(folderNameSpan);

        // Add event listeners to the folder div
        newFolder.addEventListener('contextmenu', showContextMenu);
        newFolder.addEventListener('click', function () {
            openFolder(folderName);
        });

        // Append the new folder to the folder container
        folderContainer.appendChild(newFolder);
    }


    // Function to add folder to tables section
    function addFolderToTable(folderName) {
        const newRow = document.createElement('tr');
        const fileIconClass = getFileIconClass(folderName);
        newRow.innerHTML = `
            <td><i class="${fileIconClass}"></i> ${folderName}</td>
            <td>${getCurrentDate()}</td>
            <td>0 MB</td>
            <td>Your Name</td>
            <td>
                <a href="#" class="icon-button"><i class="material-symbols-outlined">download</i></a>
                <a href="#" class="icon-button delete-file"><i class="material-symbols-outlined">delete</i></a>
                <a href="#" class="icon-button"><i class="material-symbols-outlined">border_color</i></a>
                
            </td>
        `;
        tableBody.appendChild(newRow);
        attachDeleteEventListener(newRow);
    }

    // Function to toggle popup display
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
    // Event listener for add folder button
    addFolderBtn.addEventListener('click', togglePopup);

    // Event listener for form submission
    folderForm.addEventListener('submit', handleFormSubmit);

    // Add event listeners to show context menu on right-click and hide it on click anywhere else
    document.addEventListener("contextmenu", showContextMenu);
    document.addEventListener("click", hideContextMenu);

    // Event listener for right-click on folder
    folderGrid.addEventListener('contextmenu', function (event) {
        event.preventDefault();
        clickedFolder = event.target.closest('.folder');
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

    // Clear existing files in the file container
    fileContainer.innerHTML = '';

    files.forEach(file => {
        const fileName = file.name;
        const fileExtension = fileName.split('.').pop(); // Get file extension

        // Create a new div element for the file
        const fileDiv = document.createElement('div');
        fileDiv.classList.add('file1');

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
        const fileIconClass = getFileIconClass(file.name);
        const fileSizeMB = (file.size / (1024 * 1024)).toFixed(2);

        // Create table row
        const newRow = document.createElement('tr');
        newRow.innerHTML = `
            <td><i class="${fileIconClass}"></i>${file.name}</td>
            <td>${getCurrentDate()}</td>
            <td>${fileSizeMB} MB</td>
            <td>Your Name</td>
            <td>
                <a href="#" class="icon-button"><i class="material-symbols-outlined">download</i></a>
                <a href="#" class="icon-button delete-file"><i class="material-symbols-outlined">delete</i></a>
                <a href="#" class="icon-button"><i class="material-symbols-outlined">border_color</i></a>
            </td>
        `;
        tableBody.appendChild(newRow);
        attachDeleteEventListener(newRow);
    }
}

function attachDeleteEventListener(newRow) {
    const deleteIcon = newRow.querySelector('.delete-file');
    const deleteConfirmation = document.getElementById('deletePopup');
    const confirmDeleteButton = document.getElementById('confirmDeleteBtn');
    const cancelDeleteButton = document.getElementById('cancelDeleteBtn');
    deleteIcon.addEventListener('click', function (event) {
        event.preventDefault();
        deleteConfirmation.style.display = 'block';

        // Event listener for confirm delete button
        confirmDeleteButton.onclick = function () {
            const fileName = newRow.querySelector('td:first-child').textContent.trim(); // Get file name from the first cell
            const rowIndex = newRow.rowIndex - 1; // Adjust for table header
            newRow.remove(); // Remove the row from the table
            deleteConfirmation.style.display = 'none';

            // Remove the corresponding file from the uploadedFiles array
            uploadedFiles = uploadedFiles.filter(file => file.name !== fileName);

            // Update the files section to reflect the changes
            displayFiles(uploadedFiles);

            // Synchronize folder section if it exists
            const folderName = fileName.substring(0, fileName.lastIndexOf('.')); // Extract folder name from file name
            const folderToDelete = document.querySelector(`.folder[data-folder="${folderName}"]`);
            if (folderToDelete) {
                folderToDelete.remove(); // Remove the folder from the folder section
            }
        };

        // Event listener for cancel delete button
        cancelDeleteButton.onclick = function () {
            deleteConfirmation.style.display = 'none';
        };
    });
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


