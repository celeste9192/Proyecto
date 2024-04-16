$(document).ready(function() {
    $('#agregar-orden-btn').click(function(e) {
        e.preventDefault();
        
        $.ajax({
            url: 'agregar_orden.php',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                if (data.length > 0) {
                    let html = '';
                    data.forEach(orden => {
                        html += `
                            <div class="orden">
                                <ul>
                                    <li>ID Evento: ${orden.id_evento}</li>
                                    <li>Titulo: ${orden.titulo}</li>
                                    <li>Descripcion: ${orden.descripcion}</li>
                                    <li>Fecha Inicio: ${orden.fecha_inicio}</li>
                                    <li>Fecha Fin: ${orden.fecha_fin}</li>
                                    <li>ID Empleado: ${orden.id_empleado}</li>
                                </ul>
                            </div>
                        `;
                    });
                    $('#ordenes-container').html(html);
                } else {
                    $('#ordenes-container').html('<p class="no-orden">No se encontro nada.</p>');
                }
            },
            error: function(error) {
                console.log('Error:', error);
            }
        });
    });
});
