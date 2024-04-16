<?php
include '../DAL/conexion.php';

if (isset($_POST['id_reclamacion']) && !isset($_POST['confirmar_eliminar'])) {
    $id_reclamacion = $_POST['id_reclamacion'];

    $conexion = Conecta();
    $sql = "SELECT * FROM Reclamaciones WHERE id_reclamacion = '$id_reclamacion'";
    $resultado = mysqli_query($conexion, $sql);

    if (mysqli_num_rows($resultado) > 0) {
        $reclamacion = mysqli_fetch_assoc($resultado);
    } else {
        echo json_encode(array("success" => false, "message" => "No se encontro."));
    }

    Desconectar($conexion);

} elseif (isset($_POST['confirmar_eliminar'])) {
    $id_reclamacion = $_POST['id_reclamacion'];

    $conexion = Conecta();
    $sql = "DELETE FROM Reclamaciones WHERE id_reclamacion = '$id_reclamacion'";
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
    <title>Eliminar Reclamo</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body>
    <form method="post">
        <label for="id_reclamacion">Numero de Reclamo:</label>
        <input type="number" id="id_reclamacion" name="id_reclamacion" required><br><br>

        <input type="submit" value="Eliminar">
    </form>

    <a href="reclamaciones.php" class="btn">Volver a Reclamos</a>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../js/reclamaciones.js"></script>

</body>

</html>