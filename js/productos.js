$(document).ready(function() {
    function cargarProductos() {
        $.ajax({
            url: "../php/productos.php",
            method: "GET",
            dataType: "json",
            success: function(response) {
                mostrarProductos(response);
            },
            error: function(xhr, status, error) {
                console.error("Error al cargar los productos:", error);
            }
        });
    }

    function mostrarProductos(productos) {
        $("#lista-productos").empty();
        productos.forEach(function(producto) {
            var html = `<div class="producto">
                            <h3>${producto.nombre_producto}</h3>
                            <p><strong>Descripción:</strong> ${producto.descripcion_producto}</p>
                            <p><strong>Precio:</strong> ${producto.precio}</p>
                            <p><strong>Categoría:</strong> ${producto.nombre_categoria}</p>
                            <img src="${producto.imagen}" alt="${producto.nombre_producto}">
                            <button class="eliminar-btn" data-id="${producto.id_producto}">Eliminar</button>
                            <form action="editar_producto.php" method="get">
                                <input type="hidden" name="producto_id" value="${producto.id_producto}">
                                <button type="submit">Editar</button>
                            </form>
                        </div>`;
            $("#lista-productos").append(html);
        });
    }

    $(document).on('click', '.eliminar-btn', function() {
        var idProducto = $(this).data('id');
        var nombreProducto = $(this).siblings('h3').text();
        if (confirm("¿Estás seguro de eliminar el producto '" + nombreProducto + "'?")) {
            eliminarProducto(idProducto);
        }
    });

    function eliminarProducto(idProducto) {
        $.ajax({
            url: "../php/eliminar_producto.php",
            method: "POST",
            data: {
                producto_id: idProducto
            },
            success: function(response) {
                alert(response);
                cargarProductos();
            },
            error: function(xhr, status, error) {
                console.error("Error al eliminar el producto:", error);
            }
        });
    }

    cargarProductos();
});
