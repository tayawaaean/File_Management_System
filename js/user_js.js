document.addEventListener("DOMContentLoaded", function() {
    const tableBody = document.getElementById("tableBody");
    const pagination = document.getElementById("pagination");
    const rowsPerPage = 2; // Change this value to adjust the number of rows per page
    let currentPage = 1;

    function setupPagination() {
        pagination.innerHTML = "";
        const tableRows = tableBody.querySelectorAll("tr");
        const pageCount = Math.ceil(tableRows.length / rowsPerPage);
        for (let i = 1; i <= pageCount; i++) {
            const li = document.createElement("li");
            li.classList.add("page-item");
            if (i === currentPage) {
                li.classList.add("active");
            }
            const link = document.createElement("a");
            link.classList.add("page-link");
            link.href = "#";
            link.textContent = i;
            link.addEventListener("click", function() {
                currentPage = i;
                displayUsers();
                setupPagination();
            });
            li.appendChild(link);
            pagination.appendChild(li);
        }
    }

    function displayUsers() {
        const tableRows = tableBody.querySelectorAll("tr");
        const startIndex = (currentPage - 1) * rowsPerPage;
        const endIndex = startIndex + rowsPerPage;
        tableRows.forEach((row, index) => {
            if (index >= startIndex && index < endIndex) {
                row.style.display = "table-row";
            } else {
                row.style.display = "none";
            }
        });
    }

    setupPagination();
    displayUsers();
});