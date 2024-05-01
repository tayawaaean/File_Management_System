document.addEventListener('DOMContentLoaded', function() {
    function addCancelFunctionality(editBtnId, cancelBtnId, saveBtnId, fields) {
        var editBtn = document.getElementById(editBtnId);
        var cancelBtn = document.getElementById(cancelBtnId);
        var saveBtn = document.getElementById(saveBtnId);

        var originalValues = {};

        editBtn.addEventListener('click', function(event) {
            event.preventDefault(); // Prevent the default form submission behavior
            fields.forEach(function(field) {
                field.element.readOnly = false;
                field.element.style.border = '1px solid black';
                // Store original values
                originalValues[field.name] = field.element.value;
            });
            cancelBtn.style.display = 'block';
            saveBtn.style.display = 'block';
            editBtn.style.display = 'none';
        });

        saveBtn.addEventListener('click', function(event){
            fields.forEach(function(field) {
                field.element.readOnly = true;
                field.element.style.border = 'none';
            });
            cancelBtn.style.display = 'none';
            saveBtn.style.display = 'none';
            editBtn.style.display = 'inline-block';
        });

        cancelBtn.addEventListener('click', function(event){
            fields.forEach(function(field) {
                field.element.value = originalValues[field.name];
                field.element.readOnly = true;
                field.element.style.border = 'none';
            });
            cancelBtn.style.display = 'none';
            saveBtn.style.display = 'none';
            editBtn.style.display = 'inline-block';
        });
    }

    addCancelFunctionality(
        'contact-edit',
        'cancel-btn-contact',
        'save-btn-contact',
        [
            { name: 'email', element: document.getElementById('email') },
            { name: 'phone', element: document.getElementById('phone') },
            { name: 'mobile', element: document.getElementById('mobile') },
            { name: 'web', element: document.getElementById('web') }
        ]
    );
    addCancelFunctionality(
        'info-edit',
        'cancel-btn-info',
        'save-btn-info',
        [
            { name: 'name', element: document.getElementById('name') },
            { name: 'birthday', element: document.getElementById('birthday') },
            { name: 'Address', element: document.getElementById('Address') },
            { name: 'nickname', element: document.getElementById('nickname') }
        ]
    );

    addCancelFunctionality(
        'work-edit',
        'cancel-btn-work',
        'save-btn-work',
        [
            { name: 'jobtitle', element: document.getElementById('jobtitle') },
            { name: 'Department', element: document.getElementById('Department') },
            { name: 'Company', element: document.getElementById('Company') },
            { name: 'current-location', element: document.getElementById('current-location') }
        ]
    );
});

document.addEventListener('DOMContentLoaded', function(){
    // Populate user information
    document.getElementById('userName').textContent = userData.name;
    document.getElementById('work-title').textContent = userData.job_title;
    document.getElementById('email').value = userData.email;
    document.getElementById('phone').value = userData.phone;
    document.getElementById('mobile').value = userData.mobile;
    document.getElementById('web').value = userData.website;
    document.getElementById('Address').value = userData.address;
    document.getElementById('birthday').value = userData.birthday;
    document.getElementById('nickname').value = userData.nickname;
    document.getElementById('jobtitle').value = userData.job_title;
    document.getElementById('Department').value = userData.department;
    document.getElementById('Company').value = userData.company;
    document.getElementById('current-location').value = userData.current_location;
});


// Add event listeners to edit buttons
document.getElementById("contact-edit").addEventListener("click", function() {
    toggleEditMode("first-side");
});

document.getElementById("info-edit").addEventListener("click", function() {
    toggleEditMode("second-side");
});

document.getElementById("work-edit").addEventListener("click", function() {
    toggleEditMode("third-side");
});
// Function to toggle edit mode for a given section
function toggleEditMode(sectionId) {
    var section = document.querySelector("." + sectionId);
    var inputs = section.querySelectorAll("input");

    inputs.forEach(function(input) {
        input.readOnly = !input.readOnly; // Toggle read-only state
    });
}

// Save button functionality
document.getElementById("save-btn-contact").addEventListener("click", function() {
    // Gather edited data from input fields
    var editedData = {
        email: document.getElementById("email").value,
        phone: document.getElementById("phone").value,
        mobile: document.getElementById("mobile").value,
        website: document.getElementById("web").value
        // Add other fields as needed
    };

    // Send edited data to the server via AJAX for updating
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "update_user_info.php", true);
    xhr.setRequestHeader("Content-Type", "application/json");
   
    xhr.send(JSON.stringify(editedData));
});

// Save button functionality for other sections (similar to the above)
document.getElementById("save-btn-info").addEventListener("click", function() {
    // Gather edited data from input fields in the second-side section
    var editedData = {
        name: document.getElementById("name").value,
        birthday: document.getElementById("birthday").value,
        address: document.getElementById("Address").value,
        nickname: document.getElementById("nickname").value
        // Add other fields as needed
    };
    
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "update_user_info.php", true);
    xhr.setRequestHeader("Content-Type", "application/json");
   
    xhr.send(JSON.stringify(editedData));
    // Send edited data to the server via AJAX for updating
    // Same as above, but adjust the endpoint and input data accordingly
});

document.getElementById("save-btn-work").addEventListener("click", function() {
    // Gather edited data from input fields in the third-side section
    var editedData = {
        job_title: document.getElementById("jobtitle").value,
        department: document.getElementById("Department").value,
        company: document.getElementById("Company").value,
        current_location: document.getElementById("current-location").value
        // Add other fields as needed
    };
  var xhr = new XMLHttpRequest();
    xhr.open("POST", "update_user_info.php", true);
    xhr.setRequestHeader("Content-Type", "application/json");
  
    xhr.send(JSON.stringify(editedData));
    // Send edited data to the server via AJAX for updating
    // Same as above, but adjust the endpoint and input data accordingly
});
var toggleUploadButtonElement = document.getElementById("toggleUpload");
var uploadImageElement = document.getElementById("uploadImage");
var profiles = document.getElementById("profile-image-user");

function toggleUploadButton() {
    uploadImageElement.style.display = "block";
    adjustMargin();
    window.addEventListener('resize', adjustMargin);
}

function cancelToggle() {
    uploadImageElement.style.display = "none";
    defaultMargin();
    window.addEventListener('resize', defaultMargin);
}

// Function to handle file input change
function handleFileInput(event) {
    var file = event.target.files[0];
    var reader = new FileReader();

    reader.onload = function(e) {
        // Set the source of the profile image to the data URL of the selected image
        profiles.src = e.target.result;
    };

    reader.readAsDataURL(file);
}

// Trigger file input click
function triggerFileInput() {
    imageInput.click();
}

// Get the file input element
var imageInput = document.createElement("input");
imageInput.type = "file";
imageInput.accept = "image/*";
imageInput.style.display = "none";
imageInput.addEventListener("change", handleFileInput);

// Add event listener to the document to handle clicks
document.addEventListener("click", function(event) {
    var target = event.target;
    // Check if the clicked element is not the toggleUploadButton or uploadImageElement
    if (target !== toggleUploadButtonElement && target !== uploadImageElement && !toggleUploadButtonElement.contains(target) && !uploadImageElement.contains(target)) {
        cancelToggle();
    }
});

function adjustMargin(){
    const mediaQuery = window.matchMedia('(max-width: 768px)');
    if (mediaQuery.matches){
        document.getElementById("white-bg").style.marginTop = '40px';
    }
}
function defaultMargin(){
    const mediaQuery = window.matchMedia('(max-width: 768px)');
    if (mediaQuery.matches){
        document.getElementById("white-bg").style.marginTop = '';
    }
}
