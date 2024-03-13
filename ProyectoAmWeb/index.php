<?php
include 'conexion.php';

function obtenerProductos() {
    $conexion = Conecta();
    $consulta = "SELECT * FROM productos";
    $resultado = mysqli_query($conexion, $consulta);
    if ($resultado && mysqli_num_rows($resultado) > 0) {
        echo "<ul>";
        while ($fila = mysqli_fetch_assoc($resultado)) {
            echo "<li>";
            echo "<strong>ID:</strong> " . $fila['product_id'] . "<br>";
            echo "<strong>Nombre:</strong> " . $fila['nombre'] . "<br>";
            echo "<strong>Descripción:</strong> " . $fila['descripcion'] . "<br>";
            echo "<strong>Precio:</strong> $" . $fila['precio'] . "<br>";
            echo "<strong>Cantidad en Stock:</strong> " . $fila['cantidad_stock'] . "<br>";
            echo "<strong>Imagen:</strong> <img src='" . $fila['imagen'] . "' width='100' height='100'><br>";

            // Formulario para eliminar el producto
            echo "<form action='eliminar_producto.php' method='post'>";
            echo "<input type='hidden' name='producto_id' value='" . $fila['product_id'] . "'>";
            echo "<input type='submit' value='Eliminar'>";
            echo "</form>";

            // Formulario para editar el producto
            echo "<form action='editar_producto.php' method='get'>";
            echo "<input type='hidden' name='producto_id' value='" . $fila['product_id'] . "'>";
            echo "<input type='submit' value='Editar'>";
            echo "</form>";
            
            echo "</li>";
        }
        echo "</ul>";
        echo "<a href='agregar_producto.php'><button>Agregar Producto</button></a>";
    } else {
        echo "No se encontraron productos.";
    }
    Desconectar($conexion);
}

obtenerProductos();
?>
