$(document).ready(function() {
    
    $('#loginForm').on('submit', function(e) {
        e.preventDefault(); // Evitar que se envíe de forma tradicional

        var formData = $(this).serialize(); // Obtener los datos del formulario

        $.ajax({
            url: './Controller/LoginController.php', // El archivo PHP donde se procesa el login
            type: 'POST',
            data: formData,
            success: function(response) {

                var data = JSON.parse(response); 
                
                if (data.status === 'success') {
                    window.location.href = data.redirect; 
                } else {
                    
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: data.message, 
                    });
                }
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Hubo un problema al procesar la solicitud.',
                });
            }
        });
    });
});
