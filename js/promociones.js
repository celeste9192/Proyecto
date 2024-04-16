$(document).ready(function() {

    function mostrarPromociones() {
        $.ajax({
            url: 'obtener_promociones.php',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                if (data.length > 0) {
                    let html = '';
                    data.forEach(promocion => {
                        html += `
                            <div class="promo-card">
                                <h2>${promocion.nombre_promocion}</h2>
                                <p>${promocion.descripcion_promocion}</p>
                                <p>Fecha de Inicio: ${promocion.fecha_inicio}</p>
                                <p>Fecha de Fin: ${promocion.fecha_fin}</p>
                                <p>Descuento: ${promocion.descuento}%</p>
                            </div>
                        `;
                    });
                    $('.promo-container').html(html);
                } else {
                    $('.promo-container').html('<p>No hay promociones disponibles.</p>');
                }
            },
            error: function(error) {
                console.log('Error:', error);
            }
        });
    }

    mostrarPromociones();

    $('#agregar-promo-btn').click(function() {
        let nombre = prompt('Ingrese el nombre de la promoción:');
        let descripcion = prompt('Ingrese la descripción de la promoción:');
        let fechaInicio = prompt('Ingrese la fecha de inicio (YYYY-MM-DD):');
        let fechaFin = prompt('Ingrese la fecha de fin (YYYY-MM-DD):');
        let descuento = prompt('Ingrese el descuento (%):');

        $.ajax({
            url: 'agregar_promocion.php',
            type: 'POST',
            data: {
                nombre_promocion: nombre,
                descripcion_promocion: descripcion,
                fecha_inicio: fechaInicio,
                fecha_fin: fechaFin,
                descuento: descuento
            },
            dataType: 'json',
            success: function(response) {
                alert(response.mensaje);
                mostrarPromociones();
            },
            error: function(error) {
                console.log('Error:', error);
            }
        });
    });

    $('#eliminar-promo-btn').click(function() {
        let idPromocion = prompt('Ingrese el ID de la promoción a eliminar:');

        $.ajax({
            url: 'eliminar_promocion.php',
            type: 'POST',
            data: { id_promocion: idPromocion },
            dataType: 'json',
            success: function(response) {
                alert(response.mensaje);
                mostrarPromociones();
            },
            error: function(error) {
                console.log('Error:', error);
            }
        });
    });

    $('#editar-promo-btn').click(function() {
        let idPromocion = prompt('Ingrese el ID de la promoción a editar:');
        let nombre = prompt('Ingrese el nuevo nombre de la promoción:');
        let descripcion = prompt('Ingrese la nueva descripción de la promoción:');
        let fechaInicio = prompt('Ingrese la nueva fecha de inicio (YYYY-MM-DD):');
        let fechaFin = prompt('Ingrese la nueva fecha de fin (YYYY-MM-DD):');
        let descuento = prompt('Ingrese el nuevo descuento (%):');

        $.ajax({
            url: 'editar_promocion.php',
            type: 'POST',
            data: {
                id_promocion: idPromocion,
                nombre_promocion: nombre,
                descripcion_promocion: descripcion,
                fecha_inicio: fechaInicio,
                fecha_fin: fechaFin,
                descuento: descuento
            },
            dataType: 'json',
            success: function(response) {
                alert(response.mensaje);
                mostrarPromociones();
            },
            error: function(error) {
                console.log('Error:', error);
            }
        });
    });

});
