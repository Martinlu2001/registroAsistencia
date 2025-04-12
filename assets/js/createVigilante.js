$(document).ready(function() {
    
    $('#addSecurity').on('submit', function(e) {
        e.preventDefault(); // Evitar que se envíe de forma tradicional

        var formData = new FormData(this);
        $.ajax({
            url: './Controller/PersonalSeguridadController.php', 
            type: 'POST',
            data: formData,
            processData: false, // No procesar los datos
            contentType: false, // No establecer el contentType, porque es FormData
            success: function(response) {
                var data = JSON.parse(response); 
                if (data.status=== 'success') {
                    Swal.fire({
                        icon: 'success',
                        text: data.message,
                    }).then(() => {
                        /*if ( $.fn.DataTable.isDataTable('#dataTable') ) {
                            $('#dataTable').DataTable().destroy();
                        }*/
                        //$('#header-container').load('./contenido-security.php');
                        $('#header-container').load('./contenido-security.php', function(){
                            $('#dataTable').DataTable();
                        });
                        /*$('#dataDispSec').modal('hide');
                        $('#addSecurity')[0].reset();*/
                        /*$('#header-container').load('./contenido-security.php', function(response, status, xhr) {
                            
                                $('#dataTable').DataTable({
                                    responsive: true,
                                    language: {
                                        url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
                                    }
                                });
            
                    
                            // Cerrar modal y resetear el form
                           
                        });*/
                        $('#dataDispSec').modal('hide');
                        $('#addSecurity')[0].reset();
                    });
                } else {
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