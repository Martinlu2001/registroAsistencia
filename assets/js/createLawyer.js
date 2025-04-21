$(document).ready(function() {
    
    $(document).on('submit','#addLawyer', function(e) {
        e.preventDefault();
        //var formData = new FormData(this);
        var formData = $(this).serialize(); 
        $.ajax({
            url: './Controller/AbogadoController.php', 
            type: 'POST',
            data: formData,
            //processData: false, // No procesar los datos
            //contentType: false, // No establecer el contentType, porque es FormData
            success: function(response) {
                var data = JSON.parse(response); 
                if (data.status=== 'success') {
                    Swal.fire({
                        icon: 'success',
                        text: data.message,
                    }).then(() => {
                        $('#header-container').load('./contenido-lawyer.php', function(){
                            $('#dataTable').DataTable();
                        });
                        $('#createLawyer').modal('hide');
                        $('#addLawyer')[0].reset();
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