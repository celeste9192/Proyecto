$(document).ready(function() {
    $('.eliminar-btn').click(function(event) {
        event.preventDefault(); 
        var idReabastecimiento = $(this).closest('tr').data('id');
        var nombreProducto = $(this).closest('tr').data('producto');
        $('#id_reabastecimiento').val(idReabastecimiento);
        $('#producto-nombre').text(nombreProducto);
        $('#eliminar-modal').modal('open');
    });

    $('#eliminar-reabastecimiento-btn').click(function() {
        var idReabastecimiento = $('#id_reabastecimiento').val();

        $.ajax({
            url: 'eliminar_reabastecimiento.php',
            type: 'POST',
            data: { id_reabastecimiento: idReabastecimiento },
            success: function(response) {
                alert(response);
                location.reload();
            },
            error: function(error) {
                alert("Error al eliminar el reabastecimiento: " + error);
            }
        });
    });

    $('.editar-btn').click(function() {
        var tr = $(this).closest('tr');
        var idReabastecimiento = tr.data('id');
        var nombreProducto = tr.data('producto');
        var cantidad = tr.data('cantidad');
        var fecha = tr.data('fecha');
        var estado = tr.data('estado');
        window.location.href = `editar_reabastecimiento.php?id=${idReabastecimiento}&nombre=${nombreProducto}&cantidad=${cantidad}&fecha=${fecha}&estado=${estado}`;
    });

    $('#cancelar-eliminar').click(function() {
        $.modal.close();
    });
});
