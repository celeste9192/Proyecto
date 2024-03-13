<?php
include 'conexion.php';

// Definimos una variable para el mensaje de éxito
$mensaje = "";

// Verificamos si se ha enviado un producto_id por GET
if(isset($_GET['producto_id'])) {
    $producto_id = $_GET['producto_id'];

    // Función para obtener la información del producto seleccionado
    function obtenerProducto($conexion, $producto_id) {
        $consulta = "SELECT * FROM productos WHERE product_id = $producto_id";
        $resultado = mysqli_query($conexion, $consulta);
        return mysqli_fetch_assoc($resultado);
    }

    // Obtener los datos del producto seleccionado
    $conexion = Conecta();
    $producto = obtenerProducto($conexion, $producto_id);
    Desconectar($conexion);

    if(!$producto) {
        echo "Producto no encontrado.";
        exit();
    }

    // Procesar el formulario de edición si se envía
    if(isset($_POST['editar_producto'])) {
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $precio = $_POST['precio'];
        $cantidad_stock = $_POST['cantidad_stock'];
        $imagen_url = $_POST['imagen_url']; // Obtener la URL de la imagen desde el formulario

        // Aquí deberías realizar la validación de los datos recibidos y actualizar el producto en la base de datos
        $conexion = Conecta();
        $consulta = "UPDATE productos SET nombre='$nombre', descripcion='$descripcion', precio=$precio, cantidad_stock=$cantidad_stock, imagen='$imagen_url' WHERE product_id=$producto_id";
        $resultado = mysqli_query($conexion, $consulta);
        Desconectar($conexion);

        if($resultado) {
            // Si la edición fue exitosa, establecemos el mensaje
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
        // Función para mostrar el mensaje de éxito
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
        <!-- Agregar más campos según sea necesario -->

        <input type="submit" name="editar_producto" value="Guardar Cambios">
    </form>
    <a href="index.php"><button>Menu principal</button></a>
</body>
</html>
