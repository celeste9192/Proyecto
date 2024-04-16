<?php
include '../DAL/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_producto = $_POST['id_producto'];
    $id_cliente = $_POST['id_cliente'];
    $calificacion = $_POST['calificacion'];
    $comentario = $_POST['comentario'];
    $fecha = $_POST['fecha']; 

    $conexion = Conecta();
    $consulta_cliente = "SELECT * FROM Clientes WHERE id_cliente = '$id_cliente'";
    $resultado_cliente = mysqli_query($conexion, $consulta_cliente);

    if (mysqli_num_rows($resultado_cliente) == 0) {
        echo "Error: El cliente con ID $id_cliente no existe.";
        exit();
    }

    $consulta = "INSERT INTO ReseñasProducto (id_producto, id_cliente, calificacion, comentario, fecha) VALUES ('$id_producto', '$id_cliente', '$calificacion', '$comentario', '$fecha')";

    if (mysqli_query($conexion, $consulta)) {
        header("Location: resenas_productos.php");
        exit();
    } else {
        echo "Error al agregar la reseña: " . mysqli_error($conexion);
    }

    Desconectar($conexion);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Reseña de Producto</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
<h1>Agregar Reseña de Producto</h1>
    <form method="post">
        <label for="id_producto">ID Producto:</label>
        <input type="number" id="id_producto" name="id_producto" required><br><br>

        <label for="id_cliente">ID Cliente:</label>
        <input type="number" id="id_cliente" name="id_cliente" required><br><br>

        <label for="calificacion">Calificación:</label>
        <input type="number" id="calificacion" name="calificacion" required><br><br>

        <label for="comentario">Comentario:</label>
        <textarea id="comentario" name="comentario" required></textarea><br><br>

        <input type="hidden" name="fecha" value="<?php echo date('Y-m-d'); ?>">
        
        <input type="submit" value="Agregar Reseña">
    </form>
    <a href="resenas_productos.php">Volver a la lista de reseñas</a>
</body>
</html>
