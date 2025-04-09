$(document).ready(function() { 
    $('#perfilForm').on('submit', function(e) {
        e.preventDefault(); 
        var formData = $(this).serialize(); 

        $.ajax({
            url: './Controller/PerfilAdminController.php', 
            type: 'POST',
            data: formData,
            success: function(response) {
                var data = JSON.parse(response);

                if (data.status=== 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Datos actualizados',
                        text: data.message, 
                    }).then(() => {
                        // Recargar el contenido del header después de la actualización
                        //$('#header-container').load('./perfil.php');
                        $('#header-container').load('./perfil.php', function() {
                            // Reiniciar los eventos de Bootstrap después de cargar el nuevo contenido
                            // Esto asegura que el dropdown funcione correctamente
                            $('#userDropdown').dropdown();
                            //$('#userCollapse').collapse();
                            $('#userCollapse').collapse('dispose');  // Eliminar el comportamiento anterior
                            $('#userCollapse').collapse();  // Reactivar el colapso
                        });
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

