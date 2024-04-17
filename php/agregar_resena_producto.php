<?php
include '../DAL/conexion.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_producto = $_POST['id_producto'];
    $id_cliente = $_SESSION['id_cliente']; 
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

<header id="formularios-header">
        <h1 id="titulo-formularios">Agregar Reseña</h1>
        <a id="volver" href="resenas_productos.php">Volver</a>
    </header>
<body>
<div class="container-formularios">
    <form method="post">
        <label for="id_producto">Producto:</label>
        <select id="id_producto" name="id_producto" required>
            <?php
                $conexion = Conecta();
                $consulta_productos = "SELECT id_producto, nombre_producto FROM Productos";
                $resultado_productos = mysqli_query($conexion, $consulta_productos);

                if ($resultado_productos && mysqli_num_rows($resultado_productos) > 0) {
                    while ($fila = mysqli_fetch_assoc($resultado_productos)) {
                        echo "<option value='" . $fila['id_producto'] . "'>" . $fila['id_producto'] . " - " . $fila['nombre_producto'] . "</option>";
                    }
                }

                Desconectar($conexion);
            ?>
        </select><br><br>

       
        <input type="hidden" id="id_cliente" name="id_cliente" value="<?php echo $_SESSION['id_cliente']; ?>">

        <label for="calificacion">Calificación (del 1 al 10):</label>
        <input type="number" id="calificacion" name="calificacion" min="1" max="10" value="10" required><br><br>

        <label for="comentario">Comentario:</label>
        <textarea id="comentario" name="comentario" required></textarea><br><br>

        <input type="hidden" name="fecha" value="<?php echo date('Y-m-d'); ?>">
        
        <input type="submit" value="Agregar Reseña">
    </form>
    </div>
   
</body>
</html>
