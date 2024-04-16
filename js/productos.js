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
        $("#container").empty(); 
        productos.forEach(function(producto) {
            var html = `<div class="product-item">
                            <img src="${producto.imagen}" alt="${producto.nombre_producto}">
                            <p id="nombre-producto"><strong>${producto.nombre_producto}</strong></p>
                            <p><strong>Categoria:</strong> ${producto.nombre_categoria}</p>
                            <p><strong>Descripción:</strong> ${producto.descripcion_producto}</p>
                            <p><strong>Precio:</strong> $${producto.precio}</p>
                            <form method="post">
                                <input type="hidden" name="eliminar_producto" value="true">
                                <input type="hidden" name="producto_id" value="${producto.id_producto}">
                                <button type="submit">Eliminar</button>
                            </form>
                            <form action="editar_producto.php" method="get" class="botones-form">
                                <input type="hidden" name="producto_id" value="${producto.id_producto}">
                                <button type="submit" id="editar-producto">Editar</button>
                            </form>
                        </div>`;
            $("#container").append(html);
        });
    }

    $(document).on('submit', 'form', function(event) {
        event.preventDefault(); 
        var formData = $(this).serialize(); 
        $.ajax({
            type: "POST",
            url: "eliminar_producto.php",
            data: formData,
            dataType: "json",
            success: function(response) {
                if (response.success) {
                    alert(response.message); 
                    cargarProductos(); 
                } else {
                    alert(response.message); 
                }
            },
            error: function(xhr, status, error) {
                console.error("Error al eliminar/editar el producto:", error);
            }
        });
    });

    cargarProductos(); 
});
