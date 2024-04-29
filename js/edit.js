$(document).ready(function() {
        $('.edit-btn').click(function() {
            var userId = $(this).data('user-id');
            $.ajax({
                url: 'get_user.php', // EDIT FETCH SA USER.PHP
                method: 'POST',
                data: {
                    id: userId
                },
                dataType: 'json',
                success: function(response) {
                    $('#edit_id').val(response.id);
                    $('#edit_name').val(response.name);
                    $('#edit_job_title').val(response.job_title);
                    $('#edit_phone').val(response.phone);
                    $('#edit_email').val(response.email);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });
