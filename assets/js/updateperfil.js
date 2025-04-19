$(document).ready(function() { 
    $(document).on('submit', '#perfilForm',function(e) {
    //$('#perfilForm').on('submit', function(e) {
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
                        text: data.message, 
                    }).then(() => {
                        $('#head-container').load('./contenido-perfil.php');

                        // Actualizar el nombre en la topbar
                        $('.text-white-600').text(data.nombre.toUpperCase());
                        /*$('#header-container').load('./perfil.php', function() {
                            $('#userDropdown').dropdown();
                            $('#userCollapse').collapse('dispose');  
                            $('#userCollapse').collapse();  
                        });*/
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

