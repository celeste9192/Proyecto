<?php
include '../DAL/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (
        isset($_POST['id_proveedor']) && !empty($_POST['id_proveedor']) &&
        isset($_POST['detalles']) && !empty($_POST['detalles']) &&
        isset($_POST['fecha']) && !empty($_POST['fecha']) &&
        isset($_POST['total']) && !empty($_POST['total'])
    ) {
        $id_proveedor = $_POST['id_proveedor'];
        $detalles = $_POST['detalles'];
        $fecha = $_POST['fecha'];
        $total = $_POST['total'];

        $conexion = Conecta();

        $consulta = "INSERT INTO Compras (id_proveedor, detalles, fecha_compra, total_compra) VALUES ('$id_proveedor', '$detalles', '$fecha', '$total')";

        if (mysqli_query($conexion, $consulta)) {
            echo "La compra se agregó correctamente.";
        } else {
            echo "Error al agregar la compra: " . mysqli_error($conexion);
        }

        Desconectar($conexion);
    } else {
        echo "Por favor, complete todos los campos.";
    }
}
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Agregar Compra</title>
</head>

<body>

    <header id="formularios-header">
        <h1 id="titulo-formularios">Agregar Compra</h1>
        <a id="volver" href="compras.php">Volver</a>
    </header>

    <div class="container-formularios">
        <form id="form-agregar-compra" method="post">
            <label for="id_proveedor">ID Proveedor:</label>
            <input type="number" id="id_proveedor" name="id_proveedor" required><br><br>

            <label for="detalles">Detalles:</label>
            <input type="text" id="detalles" name="detalles"><br><br>

            <label for="fecha">Fecha:</label>
            <input type="date" id="fecha" name="fecha"><br><br>

            <label for="total">Total:</label>
            <input type="number" id="total" name="total"><br><br>

            <input type="submit" value="Agregar Compra">
        </form>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../js/compras.js"></script>

</body>

</html>
