<?php
include '../DAL/conexion.php';

$mensaje = ""; // Inicializa la variable de mensaje

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['producto_id'])) {
    $producto_id = $_GET['producto_id'];

    $conexion = Conecta();
    $consulta = "SELECT * FROM Productos WHERE id_producto = ?";
    $stmt = $conexion->prepare($consulta);
    $stmt->bind_param("i", $producto_id);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado && $resultado->num_rows > 0) {
        $producto = $resultado->fetch_assoc();
    } else {
        $mensaje = "No se encontró el producto.";
    }

    $stmt->close();
    Desconectar($conexion);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['editar_producto'])) {
    $producto_id = $_POST['producto_id'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $imagen_url = $_POST['imagen_url'];

    $conexion = Conecta();
    $consulta = "UPDATE Productos SET nombre_producto=?, descripcion_producto=?, precio=?, imagen=? WHERE id_producto=?";
    $stmt = $conexion->prepare($consulta);
    $stmt->bind_param("ssdsi", $nombre, $descripcion, $precio, $imagen_url, $producto_id);
    
    if ($stmt->execute()) {
        $mensaje = "¡Producto editado correctamente!";
    } else {
        $mensaje = "Error al editar el producto: " . $conexion->error;
    }

    $stmt->close();
    Desconectar($conexion);
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body>
    <header id="formularios-header">
        <h1 id="titulo-formularios">Editar Producto</h1>
        <a id="volver" href="index.php">Volver</a>
    </header>

    <h1>Editar Producto</h1>
    <?php if (!empty($mensaje)): ?>
    <p><?php echo $mensaje; ?></p>
    <?php endif; ?>
    
    <?php if (isset($producto)): ?>
    <form action="" method="post">
        <input type="hidden" name="producto_id" value="<?php echo $producto_id; ?>">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" value="<?php echo $producto['nombre_producto']; ?>"><br>
        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion"><?php echo $producto['descripcion_producto']; ?></textarea><br>
        <label for="precio">Precio:</label>
        <input type="text" name="precio" value="<?php echo $producto['precio']; ?>"><br>
        <label for="imagen_url">URL de la Imagen:</label>
        <input type="text" name="imagen_url" value="<?php echo $producto['imagen']; ?>"><br>

        <input type="submit" name="editar_producto" value="Guardar Cambios">
    </form>
    <?php endif; ?>
   
    <script>
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
    </script>
</body>

</html>
