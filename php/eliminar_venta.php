<?php

include '../DAL/conexion.php';

if (isset($_POST['id_venta']) && !isset($_POST['confirmar_eliminar'])) {
    $id_venta = $_POST['id_venta'];

    $conexion = Conecta();
    $sql = "SELECT * FROM Venta WHERE id_venta = '$id_venta'";
    $resultado = mysqli_query($conexion, $sql);

    if (mysqli_num_rows($resultado) > 0) {
        $venta = mysqli_fetch_assoc($resultado);
    } else {
        echo json_encode(array("success" => false, "message" => "No se encontro."));
    }

    Desconectar($conexion);

} elseif (isset($_POST['confirmar_eliminar'])) {
    $id_venta = $_POST['id_venta'];

    $conexion = Conecta();
    $sql = "DELETE FROM Ventas WHERE id_venta = '$id_venta'";
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
    <title>Eliminar Venta</title>
</head>

<body>

    <form method="post">
        <label for="id_venta">Numero de Venta:</label>
        <input type="number" id="id_venta" name="id_venta" required><br><br>

        <input type="submit" value="Eliminar">
    </form>

    <a href="ventas.php"><button>Volver a Ventas</button></a>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../js/ventas.js"></script>

</body>

</html>