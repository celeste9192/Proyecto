<?php
include 'conexion.php';

$mensaje = "";

if (isset($_GET['producto_id'])) {
    $producto_id = $_GET['producto_id'];

    function obtenerProducto($conexion, $producto_id)
    {
        $consulta = "SELECT * FROM productos WHERE product_id = $producto_id";
        $resultado = mysqli_query($conexion, $consulta);
        return mysqli_fetch_assoc($resultado);
    }

    $conexion = Conecta();
    $producto = obtenerProducto($conexion, $producto_id);
    Desconectar($conexion);

    if (!$producto) {
        echo "Producto no encontrado.";
        exit();
    }

    if (isset($_POST['editar_producto'])) {
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $precio = $_POST['precio'];
        $cantidad_stock = $_POST['cantidad_stock'];
        $imagen_url = $_POST['imagen_url'];
        $conexion = Conecta();
        $consulta = "UPDATE productos SET nombre='$nombre', descripcion='$descripcion', precio=$precio, cantidad_stock=$cantidad_stock, imagen='$imagen_url' WHERE product_id=$producto_id";
        $resultado = mysqli_query($conexion, $consulta);
        Desconectar($conexion);

        if ($resultado) {
            $mensaje = "Producto editado correctamente.";
        } else {
            $mensaje = "Error al editar el producto.";
        }
    }
} else {
    $mensaje = "ID de producto no proporcionado.";
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
    <script>
        function mostrarMensaje() {
            alert("<?php echo $mensaje; ?>");
        }
    </script>
</head>

<body onload="mostrarMensaje()">
    <h1>Editar Producto</h1>
    <form action="" method="post">
        <input type="hidden" name="producto_id" value="<?php echo $producto_id; ?>">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" value="<?php echo $producto['nombre']; ?>"><br>
        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion"><?php echo $producto['descripcion']; ?></textarea><br>
        <label for="precio">Precio:</label>
        <input type="text" name="precio" value="<?php echo $producto['precio']; ?>"><br>
        <label for="cantidad_stock">Cantidad en Stock:</label>
        <input type="text" name="cantidad_stock" value="<?php echo $producto['cantidad_stock']; ?>"><br>
        <label for="imagen_url">URL de la Imagen:</label>
        <input type="text" name="imagen_url" value="<?php echo $producto['imagen']; ?>"><br>

        <input type="submit" name="editar_producto" value="Guardar Cambios">
    </form>
    <a href="index.php"><button>Menu principal</button></a>
</body>

</html>