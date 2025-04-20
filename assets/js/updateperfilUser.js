$(document).ready(function() { 
    $(document).on('submit', '#perfilForm',function(e) {
        e.preventDefault(); 
        var formData = $(this).serialize(); 

        $.ajax({
            url: './Controller/PerfilController.php', 
            type: 'POST',
            data: formData,
            success: function(response) {
                var data = JSON.parse(response);

                if (data.status=== 'success') {
                    Swal.fire({
                        icon: 'success',
                        text: data.message, 
                    }).then(() => {
                        $('#head-container').load('./contenido-perfil.php');
                        $('.text-white-600').text(data.nombre.toUpperCase());
                    });
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

