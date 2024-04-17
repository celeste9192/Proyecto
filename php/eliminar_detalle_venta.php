<?php
/* Este archivo tampoco se esta utilizando
include '../DAL/conexion.php';

if(isset($_POST['id_detalle_venta']) && isset($_POST['confirmar_eliminar'])) {
    $id_detalle_venta = $_POST['id_detalle_venta'];
    
    $conexion = Conecta();
    
    $sql = "DELETE FROM DetalleVenta WHERE id_detalle_venta = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param('i', $id_detalle_venta);
    
    if($stmt->execute()) {
        $response = [
            'success' => true,
            'message' => 'Detalles de venta eliminados correctamente.'
        ];
    } else {
        $response = [
            'success' => false,
            'message' => 'Error al eliminar los detalles de la venta.'
        ];
    }
    
    echo json_encode($response);
    
    Desconectar($conexion);
} else {
    $response = [
        'success' => false,
        'message' => 'Datos no recibidos correctamente.'
    ];
    
    echo json_encode($response);
}
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Eliminar Detalles</title>
</head>

<body>

    <form method="post">
        <label for="id_detalle_venta">Numero de Detalle:</label>
        <input type="number" id="id_detalle_venta" name="id_detalle_venta"><br>

        <input type="submit" value="Eliminar">
    </form>

    <a href="detalles_venta.php"><button>Volver a Detalles</button></a>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../js/detalles_ventas.js"></script>
    </div>
</body>

</html>