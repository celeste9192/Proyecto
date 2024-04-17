$(document).ready(function () {
    $('.eliminar-producto').click(function () {
        const idCarrito = $(this).data('id');
        $.ajax({
            url: 'carrito2.php',
            method: 'POST',
            data: { eliminarProducto: idCarrito },
            dataType: 'json',
            success: function (response) {
                if (response.status === 'success') {
                    location.reload();
                }
            }
        });
    });

    $('#vaciar-carrito').click(function () {
        $.ajax({
            url: 'carrito2.php',
            method: 'POST',
            data: { vaciarCarrito: true },
            dataType: 'json',
            success: function (response) {
                if (response.status === 'success') {
                    location.reload();
                }
            }
        });
    });

    $('#finalizar-compra').click(function () {
        const total = parseFloat($('#totalCarrito').val());
        let confirmacion = confirm(`¿Estás seguro de querer confirmar la compra con un total de ${total}?`);
        if (confirmacion) {
            $.ajax({
                url: 'carrito2.php',
                method: 'POST',
                data: { finalizarCompra: true, total: total },
                dataType: 'json',
                success: function (response) {
                    if (response.status === 'confirm') {
                        window.location.href = `carrito2.php?total=${response.total}`;
                    }
                }
            });
        }
    });
});


