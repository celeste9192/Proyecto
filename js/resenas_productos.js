
$(document).ready(function() {
function cargarResenas() {
    $.ajax({
        url: 'obtener_resenas.php',
        method: 'GET',
        success: function(response) {
            
            $('#tabla-resenas').html(response);
        },
        error: function(xhr, status, error) {
            console.error('Error al cargar las reseñas:', error);
        }
    });
}


function agregarResena() {
    
    var formData = $('#form-agregar-resena').serialize();
    
    $.ajax({
        url: 'agregar_resena.php',
        method: 'POST',
        data: formData,
        success: function(response) {
            
            cargarResenas();
            
            $('#form-agregar-resena')[0].reset();
        },
        error: function(xhr, status, error) {
            console.error('Error al agregar la reseña:', error);
        }
    });
}


function editarResena(idResena) {
    
    var formData = $('#form-editar-resena-' + idResena).serialize();
    
    $.ajax({
        url: 'editar_resena.php',
        method: 'POST',
        data: formData,
        success: function(response) {
            
            cargarResenas();
            
        },
        error: function(xhr, status, error) {
            console.error('Error al editar la reseña:', error);
        }
    });
}

function eliminarResena(idResena) {
    $.ajax({
        url: 'eliminar_resena.php',
        method: 'POST',
        data: { id: idResena },
        success: function(response) {
            
            cargarResenas();
        },
        error: function(xhr, status, error) {
            console.error('Error al eliminar la reseña:', error);
        }
    });
}


    cargarResenas();
});
