$(document).ready(function() {
    $('#loginForm').on('submit', function(e) {
        e.preventDefault(); 
        var formData = $(this).serialize(); 

        $.ajax({
            url: './Controller/LoginController.php', 
            type: 'POST',
            data: formData,
            success: function(response) {

                var data = JSON.parse(response); 
                
                if (data.status === 'success') {
                    window.location.href = data.redirect; 
                } else {                   
                    Swal.fire({
                        icon: 'error',
                        text: data.message, 
                    });
                }
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    icon: 'error',
                    text: 'Hubo un problema al procesar la solicitud.',
                });
            }
        });
    });
});
