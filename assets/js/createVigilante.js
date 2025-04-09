$(document).ready(function() {
    
    $('#addSecurity').on('submit', function(e) {
        e.preventDefault(); // Evitar que se envíe de forma tradicional

        //var formData = $(this).serialize(); // Obtener los datos del formulario
        var formData = new FormData(this);
        $.ajax({
            url: './Controller/PersonalSeguridadController.php', // El archivo PHP donde se procesa el login
            type: 'POST',
            data: formData,
            processData: false, // No procesar los datos
            contentType: false, // No establecer el contentType, porque es FormData
            success: function(response) {
                var data = JSON.parse(response); // Parseamos la respuesta JSON
                // Si la respuesta es positiva, redirigir
                if (data.status=== 'success') {
                    Swal.fire({
                        icon: 'success',
                        text: data.message,
                    }).then(() => {
                        // Actualizar solo el datatable, no recargar toda la página
                        //$('#header-container').load('./administrar_personal_seguridad.php');
                        //$('#dataDispSec').modal('hide');
                        //$('#addSecurity')[0].reset();

                        //$('#userDropdown').dropdown();
                        $('#dataDispSec').modal('hide');
                        $('#addSecurity')[0].reset();
                        $('#header-container').load('./administrar_personal_seguridad.php', function() {
                            // Reiniciar los eventos de Bootstrap después de cargar el nuevo contenido
                            // Esto asegura que el dropdown funcione correctamente
                            $('#userDropdown').dropdown();
                            $('#userCollapse').collapse('toggle');
                        });
                    });
                } else {
                    // Si hubo un error, mostrar el mensaje con SweetAlert
                    Swal.fire({
                        icon: 'error',
                        text: data.message, 
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error("Error: " + error);
                console.error("Status: " + status);
                console.error(xhr.responseText);
                
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Hubo un problema al procesar la solicitud.',
                });
            }
        });
    });
});