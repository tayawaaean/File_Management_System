const body = document.querySelector("body"),
      modeToggle = body.querySelector(".mode-toggle");
      sidebar = body.querySelector("nav");
      sidebarToggle = body.querySelector(".sidebar-toggle");

let getMode = localStorage.getItem("mode");
if(getMode && getMode ==="dark"){
    body.classList.toggle("dark");
}

let getStatus = localStorage.getItem("status");
if(getStatus && getStatus ==="close"){
    sidebar.classList.toggle("close");
}

modeToggle.addEventListener("click", () =>{
    body.classList.toggle("dark");
    if(body.classList.contains("dark")){
        localStorage.setItem("mode", "dark");
    }else{
        localStorage.setItem("mode", "light");
    }
});

sidebarToggle.addEventListener("click", () => {
    sidebar.classList.toggle("close");
    if(sidebar.classList.contains("close")){
        localStorage.setItem("status", "close");
    }else{
        localStorage.setItem("status", "open");
    }
})

// Selecting the dropdown buttons and menus
const dropdown1 = document.getElementById('dropdown1');
const dropdown2 = document.getElementById('dropdown2');
const menu1 = dropdown1.nextElementSibling;
const menu2 = dropdown2.nextElementSibling;
const options1 = menu1.querySelectorAll('li');
const options2 = menu2.querySelectorAll('li');

// Function to close dropdown menus
function closeDropdowns() {
    menu1.classList.remove('menu-open');
    menu2.classList.remove('menu-open');
}

// Adding click event listener to the document body
document.body.addEventListener('click', (event) => {
    const isClickInsideDropdown1 = dropdown1.contains(event.target) || menu1.contains(event.target);
    const isClickInsideDropdown2 = dropdown2.contains(event.target) || menu2.contains(event.target);
    
    if (!isClickInsideDropdown1 && !isClickInsideDropdown2) {
        closeDropdowns();
    }
});

// Adding click event listener to the first dropdown button
dropdown1.addEventListener('click', () => {
    menu1.classList.toggle('menu-open'); // Toggle visibility directly on menu1
    menu2.classList.remove('menu-open'); // Close menu2
});

// Adding click event listeners to each option of the first dropdown
options1.forEach(option => {
    option.addEventListener('click', () => {
        closeDropdowns();
        options1.forEach(opt => {
            opt.classList.remove('active');
        });
        option.classList.add('active');
    });
});

// Adding click event listener to the second dropdown button
dropdown2.addEventListener('click', () => {
    menu2.classList.toggle('menu-open'); // Toggle visibility directly on menu2
    menu1.classList.remove('menu-open'); // Close menu1
});

// Adding click event listeners to each option of the second dropdown
options2.forEach(option => {
    option.addEventListener('click', () => {
        closeDropdowns();
        options2.forEach(opt => {
            opt.classList.remove('active');
        });
        option.classList.add('active');
    });
});

document.addEventListener('DOMContentLoaded', function() {
    var tds = document.querySelectorAll('.table tbody tr td');

    function toggleDescription() {
        var description = this.querySelector('.description');
        var fullDescription = this.querySelector('.full-description');

        // Toggle visibility of full description
        if (fullDescription.style.display === 'none' || fullDescription.style.display === '') {
            fullDescription.style.display = 'block';
            description.style.display = 'none'; // Hide incomplete description when full description is displayed
        } else {
            fullDescription.style.display = 'none';
            description.style.display = 'block'; // Show incomplete description when full description is hidden
        }
    }

    // Function to check screen width and attach click event listener accordingly
    function attachClickListener(td) {
        if (window.innerWidth <= 780) {
            td.addEventListener('click', toggleDescription);
        }
    }

    tds.forEach(function(td) {
        attachClickListener(td);
    });

    // Re-attach click event listener on window resize
    window.addEventListener('resize', function() {
        tds.forEach(function(td) {
            td.removeEventListener('click', toggleDescription);
            attachClickListener(td);
        });
    });
});

// Activity Log Script
$(document).ready(function() {
    var table = $('#ActivityLog').DataTable({
        responsive: true,
        dom: '<li<"entries-info">>frt<"bottom-search"f>t<"bottom"ip>',  
        "language": {
            "info": "Showing _START_ to _END_ of _TOTAL_ entries"
        },
        "columnDefs": [{
            "targets": 4,
            "orderable": false
        }, {
            "targets": 1,
            "type": "date-eu", // Use "date-eu" type for the date column
            "render": function(data, type, row) {
                // Parse the date string to a Date object for proper sorting
                return type === 'sort' ? new Date(data) : data;
            }
        }],
    });
    var currentAuthor = '';
    var currentMonth = '';
    $('#Author li').click(function() {
        var selectedAuthor = $(this).data('author');

        if (selectedAuthor === 'None') {
            currentAuthor = '';
        } else {
            currentAuthor = selectedAuthor;
        }

        filterData();
    });

    $('.menu li').click(function() {
        var selectedMonth = $(this).data('month');

        if (selectedMonth === 'None') {
            currentMonth = '';
        } else {
            currentMonth = selectedMonth;
        }

        filterData();
    });

    $('#ActivityLog th:eq(1)').click(function() {
        var order = table.order()[0]; // Get the current order
        var newOrder = order[1] === 'asc' ? 'asc' : 'desc'; // Toggle between asc and desc

        table.order([1, newOrder]).draw(); // Apply the new order to the date column
    });

    function filterData() {
        if (currentAuthor === '' && currentMonth === '') {
            table.search('').columns().search('').draw();
        } else {
            table.columns(0).search(currentAuthor).columns(1).search(currentMonth).draw();
        }
    }
    $('#custom-search').on('keyup', function() {
        table.search(this.value).draw();
    });
});