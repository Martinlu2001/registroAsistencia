$(document).ready(function() {
    
    $('#perfilForm').on('submit', function(e) {
        e.preventDefault(); // Evitar que se envíe de forma tradicional

        var formData = $(this).serialize(); // Obtener los datos del formulario

        $.ajax({
            url: './Controller/PerfilAdminController.php', // El archivo PHP donde se procesa el login
            type: 'POST',
            data: formData,
            success: function(response) {
                var data = JSON.parse(response); // Parseamos la respuesta JSON
                // Si la respuesta es positiva, redirigir
                if (data.status=== 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Datos actualizados',
                        text: data.message, // Mostrar el mensaje de error que se pasa desde PHP
                    });
                } else {
                    // Si hubo un error, mostrar el mensaje con SweetAlert
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops..',
                        text: data.message, // Mostrar el mensaje de error que se pasa desde PHP
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

