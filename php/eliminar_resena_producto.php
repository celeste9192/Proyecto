<?php
include '../DAL/conexion.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id_resena_producto = $_GET['id'];

    // Obtenemos el ID del cliente que inició sesión y su rol
    $id_cliente_actual = $_SESSION['id_cliente'];
    $rol = $_SESSION['rol'];

    $conexion = Conecta();
    
    // Consulta para obtener el ID del cliente que escribió la reseña que se desea eliminar
    $consulta_cliente_reseña = "SELECT id_cliente FROM ReseñasProducto WHERE id_resena_producto='$id_resena_producto'";
    $resultado_cliente_reseña = mysqli_query($conexion, $consulta_cliente_reseña);
    
    if ($resultado_cliente_reseña) {
        $fila_cliente_reseña = mysqli_fetch_assoc($resultado_cliente_reseña);
        $id_cliente_reseña = $fila_cliente_reseña['id_cliente'];
        
        // Verificamos si el cliente que inició sesión es el mismo que escribió la reseña o si es administrador
        if ($id_cliente_actual == $id_cliente_reseña || $rol == 'administrador') {
            // Si el cliente es el autor de la reseña o es administrador, procedemos a eliminar la reseña
            $consulta_eliminar = "DELETE FROM ReseñasProducto WHERE id_resena_producto='$id_resena_producto'";
            if (mysqli_query($conexion, $consulta_eliminar)) {
                header("Location: resenas_productos.php");
                exit();
            } else {
                echo "Error al eliminar la reseña: " . mysqli_error($conexion);
            }
        } else {
            // Si el cliente que inició sesión no es el autor de la reseña y no es administrador, mostramos un mensaje de error
            echo "No estás autorizado para eliminar esta reseña.";
        }
    } else {
        echo "Error al obtener la información de la reseña.";
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
