<?php

include '../DAL/conexion.php';

if (isset($_POST['id_detalle_venta']) && !isset($_POST['confirmar_eliminar'])) {
    $id_detalle_venta = $_POST['id_detalle_venta'];

    $conexion = Conecta();
    $sql = "SELECT * FROM DetallesVenta WHERE id_detalle_venta = '$id_detalle_venta'";
    $resultado = mysqli_query($conexion, $sql);

    if (mysqli_num_rows($resultado) > 0) {
        $venta = mysqli_fetch_assoc($resultado);
    } else {
        echo json_encode(array("success" => false, "message" => "No se encontro."));
    }

    Desconectar($conexion);

} elseif (isset($_POST['confirmar_eliminar'])) {
    $id_detalle_venta = $_POST['id_detalle_venta'];

    $conexion = Conecta();
    $sql = "DELETE FROM DetallesVenta WHERE id_detalle_venta = '$id_detalle_venta'";
    $resultado = mysqli_query($conexion, $sql);

    if ($resultado) {
        echo json_encode(array("success" => true, "message" => "Se elimino correctamente."));
    } else {
        echo json_encode(array("success" => false, "message" => "Error al eliminar."));
    }

    Desconectar($conexion);
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