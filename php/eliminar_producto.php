<?php
include '../DAL/conexion.php';

$response = array();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['eliminar_producto'])) {
    $producto_id = $_POST['producto_id'];

    $conexion = Conecta();
    $consulta_eliminar = "DELETE FROM Productos WHERE id_producto = $producto_id";
    if (mysqli_query($conexion, $consulta_eliminar)) {
        $response['success'] = true;
        $response['message'] = "El producto se eliminó correctamente.";
    } else {
        $response['success'] = false;
        $response['message'] = "Error al eliminar el producto: " . mysqli_error($conexion);
    }
    Desconectar($conexion);
} else {
    $response['success'] = false;
    $response['message'] = "No se han proporcionado datos para eliminar el producto.";
}

echo json_encode($response);
?>
