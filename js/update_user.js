$(document).ready(function() {
    $('#saveChangesBtn').click(function() {
        var id = $('#edit_id').val();
        var name = $('#edit_name').val();
        var job_title = $('#edit_job_title').val();
        var phone = $('#edit_phone').val();
        var email = $('#edit_email').val();

        var userData = {
            id: id,
            name: name,
            job_title: job_title,
            phone: phone,
            email: email
        };

        $.ajax({
            url: 'update_user.php', 
            method: 'POST',
            data: userData,
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'User data updated successfully.',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        location.reload(); 
                    });
                } else {
                    alert('Error: ' + response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });
});

