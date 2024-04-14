function approveRequest(requestId) {
    $.ajax({
        type: "POST",
        url: "../html/process_request.php",
        data: { requestId: requestId, action: 'approve' },
        success: function(response) {
            const result = JSON.parse(response);
            if (result.status === 'success') {
                console.log("Request approved successfully");
                showNotification('success', result.message);
                removeRequestRow(requestId); 
            } else {
                console.error("Error approving request:", result.message);
                showNotification('error', result.message);
            }
        },
        error: function(xhr, status, error) {
            console.error("Error approving request:", error);
            showNotification('error', 'Failed to process the request. Please try again.');
        }
    });
}
function denyRequest(requestId) {
    $.ajax({
        type: "POST",
        url: "../html/process_request.php",
        data: { requestId: requestId, action: 'deny' },
        success: function(response) {
            const result = JSON.parse(response);
            if (result.status === 'success') {
                console.log("Request denied successfully");
                showNotification('success', result.message);
                removeRequestRow(requestId); // Remove the denied request row
            } else {
                console.error("Error denying request:", result.message);
                showNotification('error', result.message);
            }
        },
        error: function(xhr, status, error) {
            console.error("Error denying request:", error);
            showNotification('error', 'Failed to process the request. Please try again.');
        }
    });
}
function showNotification(type, message) {
    toastr.options = {
        positionClass: 'toast-top-right',
        progressBar: true,
        preventDuplicates: true
    };


    if (type === 'success') {
        toastr.options.progressBar = false; // Disable progressBar for custom styling
        toastr.options.showDuration = 1000; // Optional: Adjust duration for success message
        
        toastr.success(message, 'Success', {
            progressBar: true,
            timeOut: 3000, // Optional: Set a specific timeout
            extendedTimeOut: 1000, // Optional: Set extended timeout for longer messages
            closeButton: true, // Optional: Show close button to manually close the toast
            tapToDismiss: false, // Optional: Disable dismiss on click
            preventDuplicates: true, // Optional: Prevent duplicate toasts
            escapeHtml: false, // Optional: Disable HTML escaping in the message
            newestOnTop: true, // Optional: Show newest toast at the top
            toastClass: 'toast-success', // Custom CSS class for success toast
            progressBarColor: '#32CD32', // Custom progress bar color (green)
            tapToDismiss: true 
        });
    } else if (type === 'error') {
        toastr.error(message, 'Error');
    }
}

function removeRequestRow(requestId) {
    const rowToRemove = document.getElementById('requestRow_' + requestId);
    if (rowToRemove) {
        rowToRemove.remove(); // Remove the row element
    }
}


    function confirmDelete() {
        return confirm('Are you sure you want to delete this user?');
    }
