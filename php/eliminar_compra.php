<?php

include '../DAL/conexion.php';

if (isset($_POST['id_compra']) && !isset($_POST['confirmar_eliminar'])) {
    $id_compra = $_POST['id_compra'];

    $conexion = Conecta();
    $sql = "SELECT * FROM Compras WHERE id_compra = '$id_compra'";
    $resultado = mysqli_query($conexion, $sql);

    if (mysqli_num_rows($resultado) > 0) {
        $compra = mysqli_fetch_assoc($resultado);
    } else {
        echo json_encode(array("success" => false, "message" => "No se encontro."));
    }

    Desconectar($conexion);

} elseif (isset($_POST['confirmar_eliminar'])) {
    $id_compra = $_POST['id_compra'];

    $conexion = Conecta();
    $sql = "DELETE FROM Compras WHERE id_compra = '$id_compra'";
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
    <title>Eliminar Compra</title>
</head>

<body>

    <form method="post">
        <label for="id_compra">Numero de Compra:</label>
        <input type="number" id="id_compra" name="id_compra" required><br><br>

        <input type="submit" value="Eliminar">
    </form>

    <a href="compras.php"><button>Volver a Compras</button></a>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../js/clientes.js"></script>

</body>

</html>