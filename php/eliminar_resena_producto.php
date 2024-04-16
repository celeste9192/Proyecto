<?php
include '../DAL/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id_resena_producto = $_GET['id'];

    $conexion = Conecta();
    $consulta = "DELETE FROM ReseñasProducto WHERE id_resena_producto='$id_resena_producto'";

    if (mysqli_query($conexion, $consulta)) {
        header("Location: resenas_productos.php");
        exit();
    } else {
        echo "Error al eliminar la reseña: " . mysqli_error($conexion);
    }

    Desconectar($conexion);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Reseña de Producto</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <h1>Eliminar Reseña de Producto</h1>
    <form method="get" onsubmit="return confirmarEliminar()">
        <p>¿Está seguro de que desea eliminar esta reseña?</p>
        <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
        <input type="submit" value="Eliminar">
    </form>
    <a href="resenas_productos.php">Cancelar</a>

    <script>
        function confirmarEliminar() {
            return confirm("¿Está seguro de que desea eliminar la reseña?");
        }
    </script>
</body>
</html>
