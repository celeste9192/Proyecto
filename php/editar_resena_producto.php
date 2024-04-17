<?php
include '../DAL/conexion.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_resena_producto = $_POST['id_resena_producto'];
    $id_producto = $_POST['id_producto'];
    $id_cliente = $_SESSION['id_cliente']; 
    $calificacion = $_POST['calificacion'];
    $comentario = $_POST['comentario'];
    $fecha = $_POST['fecha'];

    $conexion = Conecta();

    // Verificar si el usuario es cliente o administrador
    $rol = $_SESSION['rol'];
    if ($rol == 'cliente') {
        // Si el usuario es cliente, verificamos que sea el autor de la reseña
        $consulta_verificacion = "SELECT id_cliente FROM ReseñasProducto WHERE id_resena_producto='$id_resena_producto'";
        $resultado_verificacion = mysqli_query($conexion, $consulta_verificacion);
        $fila_verificacion = mysqli_fetch_assoc($resultado_verificacion);
        if ($fila_verificacion['id_cliente'] != $id_cliente) {
            echo "No estás autorizado para editar esta reseña.";
            exit;
        }
    }

    $consulta = "UPDATE ReseñasProducto SET id_producto='$id_producto', calificacion='$calificacion', comentario='$comentario', fecha='$fecha' WHERE id_resena_producto='$id_resena_producto'";

    if (mysqli_query($conexion, $consulta)) {
        header("Location: resenas_productos.php");
        exit();
    } else {
        echo "Error al editar la reseña: " . mysqli_error($conexion);
    }

    Desconectar($conexion);
} else {
    
    if (isset($_GET['id'])) {
        $id_resena_producto = $_GET['id'];
        $conexion = Conecta();
        $consulta = "SELECT * FROM ReseñasProducto WHERE id_resena_producto='$id_resena_producto'";
        $resultado = mysqli_query($conexion, $consulta);

        if ($resultado && mysqli_num_rows($resultado) > 0) {
            $resena = mysqli_fetch_assoc($resultado);
        } else {
            echo "Reseña no encontrada.";
            exit;
        }

        Desconectar($conexion);
    } else {
        echo "ID de reseña no especificado.";
        exit;
    }
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

<header id="formularios-header">
        <h1 id="titulo-formularios">Editar Reseña</h1>
        <a id="volver" href="resenas_productos.php">Volver</a>
    </header>
<body>
   
    <form method="post">
        <input type="hidden" name="id_resena_producto" value="<?php echo $resena['id_resena_producto']; ?>">

        <label for="id_producto">ID Producto:</label>
        <input type="number" id="id_producto" name="id_producto" value="<?php echo $resena['id_producto']; ?>" required><br><br>

        <label for="id_cliente">ID Cliente:</label>
        <input type="number" id="id_cliente" name="id_cliente" value="<?php echo $_SESSION['id_cliente']; ?>" readonly required><br><br>
        

        <label for="calificacion">Calificación:</label>
        <input type="number" id="calificacion" name="calificacion" value="<?php echo $resena['calificacion']; ?>" required><br><br>

        <label for="comentario">Comentario:</label>
        <textarea id="comentario" name="comentario" required><?php echo $resena['comentario']; ?></textarea><br><br>

        <label for="fecha">Fecha:</label>
        <input type="date" id="fecha" name="fecha" value="<?php echo date('Y-m-d', strtotime($resena['fecha'])); ?>" required><br><br>

        <input type="submit" value="Guardar Cambios">
    </form>
    
</body>
</html>
