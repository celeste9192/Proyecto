<?php
include '../DAL/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_resena_producto = $_POST['id_resena_producto'];
    $id_producto = $_POST['id_producto'];
    $id_cliente = $_POST['id_cliente'];
    $calificacion = $_POST['calificacion'];
    $comentario = $_POST['comentario'];
    $fecha = $_POST['fecha'];

    $conexion = Conecta();
    $consulta = "UPDATE ReseñasProducto SET id_producto='$id_producto', id_cliente='$id_cliente', calificacion='$calificacion', comentario='$comentario', fecha='$fecha' WHERE id_resena_producto='$id_resena_producto'";

    if (mysqli_query($conexion, $consulta)) {
        header("Location: resenas_productos.php");
        exit();
    } else {
        echo "Error: " . $consulta . "<br>" . mysqli_error($conexion);
    }

    Desconectar($conexion);
}

if (isset($_GET['id'])) {
    $id_resena_producto = $_GET['id'];
    $conexion = Conecta();
    $consulta = "SELECT * FROM ResenasProducto WHERE id_resena_producto='$id_resena_producto'";
    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        $resena = mysqli_fetch_assoc($resultado);
    } else {
        echo "Reseña no encontrada.";
        exit;
    }

    Desconectar($conexion);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Reseña de Producto</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <h1>Editar Reseña de Producto</h1>
    <form method="post">
        <input type="hidden" name="id_resena_producto" value="<?php echo $resena['id_resena_producto']; ?>">

        <label for="id_producto">ID Producto:</label>
        <input type="number" id="id_producto" name="id_producto" value="<?php echo $resena['id_producto']; ?>" required><br><br>

        <label for="id_cliente">ID Cliente:</label>
        <input type="number" id="id_cliente" name="id_cliente" value="<?php echo $resena['id_cliente']; ?>" required><br><br>

        <label for="calificacion">Calificación:</label>
        <input type="number" id="calificacion" name="calificacion" value="<?php echo $resena['calificacion']; ?>" required><br><br>

        <label for="comentario">Comentario:</label>
        <textarea id="comentario" name="comentario" required><?php echo $resena['comentario']; ?></textarea><br><br>

        <label for="fecha">Fecha:</label>
        <input type="date" id="fecha" name="fecha" value="<?php echo $resena['fecha']; ?>" required><br><br>

        <input type="submit" value="Guardar Cambios">
    </form>
    <a href="resenas_productos.php">Volver a la lista de reseñas</a>
</body>
</html>
