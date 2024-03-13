
<?php
include 'conexion.php';

if (isset($_POST['producto_id'])) {
    $producto_id = $_POST['producto_id'];

    function obtenerProducto($conexion, $producto_id)
    {
        $consulta = "SELECT * FROM productos WHERE product_id = $producto_id";
        $resultado = mysqli_query($conexion, $consulta);
        return mysqli_fetch_assoc($resultado);
    }

    function eliminarProducto($conexion, $producto_id)
    {
        $consulta = "DELETE FROM productos WHERE product_id = $producto_id";
        $resultado = mysqli_query($conexion, $consulta);
        return $resultado;
    }

    if (isset($_POST['confirmar_eliminar'])) {
        $conexion = Conecta();
        if (eliminarProducto($conexion, $producto_id)) {
            echo "<script>alert('El producto ha sido eliminado correctamente');</script>";
        } else {
            echo "<script>alert('Error al eliminar el producto');</script>";
        }
        Desconectar($conexion);
    } else {
        $conexion = Conecta();
        $producto = obtenerProducto($conexion, $producto_id);
        Desconectar($conexion);

        echo "<h2>Elimianar Producto</h2>";
        echo "<strong>ID:</strong> " . $producto['product_id'] . "<br>";
        echo "<strong>Nombre:</strong> " . $producto['nombre'] . "<br>";
        echo "<strong>Descripción:</strong> " . $producto['descripcion'] . "<br>";
        echo "<strong>Precio:</strong> $" . $producto['precio'] . "<br>";
        echo "<strong>Cantidad en Stock:</strong> " . $producto['cantidad_stock'] . "<br>";
        echo "<strong>Imagen:</strong> <img src='" . $producto['imagen'] . "' width='100' height='100'><br>";

        echo "<form action='eliminar_producto.php' method='post'>";
        echo "<input type='hidden' name='producto_id' value='" . $producto['product_id'] . "'>";
        echo "<input type='hidden' name='confirmar_eliminar' value='true'>";
        echo "<input type='submit' value='Eliminar'>";
        echo "</form>";
    }
}

echo "<a href='index.php'><button>Volver menu principal</button></a>";
?>
