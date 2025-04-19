function confirmDelete(dni) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: "¡No podrás revertir esto!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: './Controller/PersonalSeguridadController.php', // cambia esto a tu ruta
                method: 'POST',
                data: {
                    action: 'delete',
                    dni: dni
                },
                success: function(response) {
                    const res = JSON.parse(response);
                    if (res.status === 'success') {
                        Swal.fire(
                            '¡Eliminado!',
                            res.message,
                            'success'
                        ).then(() => {
                            // Recargar la tabla o la sección deseada
                            $('#header-container').load('./contenido-security.php', function() {
                                $('#dataTable').DataTable();
                            });
                        });
                    } else {
                        Swal.fire(
                            'Error',
                            res.message,
                            'error'
                        );
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    Swal.fire('Error', 'Ocurrió un error al procesar la solicitud', 'error');
                }
            });
        }
    });
}