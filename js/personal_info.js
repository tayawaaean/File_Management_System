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
        'cancel-btn',
        'save-btn',
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
