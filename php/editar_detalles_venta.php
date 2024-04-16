<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Editar Detalles</title>
</head>

<body>
    <h1>Editar Detalles</h1>

    <?php

    include '../DAL/conexion.php';

    if (isset($_GET['id_detalle_venta'])) {
        $id_detalle_venta = $_GET['id_detalle_venta'];

        $conexion = Conecta();
        $sql = "SELECT * FROM DetallesVenta WHERE id_detalle_venta = $id_detalle_venta";
        $resultado = mysqli_query($conexion, $sql);

        if ($resultado && mysqli_num_rows($resultado) > 0) {
            $detallesventa = mysqli_fetch_assoc($resultado);

            echo '<form id="editForm" method="POST">';
            echo '<input type="hidden" name="id_detalle_venta" value="' . $id_detalle_venta . '">';
            echo '<label for="id_cliente">Cliente:</label>';
            echo '<input type="number" id="id_cliente" name="id_cliente" value="' . $id_cliente['id_cliente'] . '"><br>';
            echo '<label for="id_producto">Producto:</label>';
            echo '<input type="number" id="id_producto" name="id_producto" value="' . $id_producto['id_producto'] . '"><br>';
            echo '<label for="cantidad">Cantidad:</label>';
            echo '<input type="number" id="cantidad" name="cantidad" value="' . $cantidad['cantidad'] . '"><br>';
            echo '<label for="precio_unitario">Precio Unitario:</label>';
            echo '<input type="number" id="precio_unitario" name="precio_unitario" value="' . $precio_unitario['precio_unitario'] . '"><br>';
            echo '<label for="subtotal">Subtotal:</label>';
            echo '<input type="number" id="subtotal" name="subtotal" value="' . $subtotal['subtotal'] . '"><br>';

        } else {
            echo "No se encontraron los detalles de la venta.";
        }

        Desconectar($conexion);

    } else {

        echo '<form id="searchForm" action="" method="GET">';
        echo '<label for="id_detalle_venta">Numero de Detalle de la Venta:</label>';
        echo '<input type="number" id="id_detalle_venta" name="id_detalle_venta">';
        echo '<button type="submit">Buscar</button>';
        echo '</form>';

    }

    if (isset($_POST['guardar'])) {

        $id_detalle_venta = $_POST['id_detalle_venta'];
        $id_cliente = $_POST['id_cliente'];
        $id_producto = $_POST['id_producto'];
        $cantidad = $_POST['cantidad'];
        $precio_unitario = $_POST['precio_unitario'];
        $subtotal = $_POST['subtotal'];

        $conexion = Conecta();
        $sql = "UPDATE DetallesVenta SET id_cliente='$id_cliente', id_producto='$id_producto', cantidad='$cantidad', precio_unitario='$precio_unitario', subtotal='$subtotal' WHERE id_detalle_venta = $id_detalle_venta";
        $resultado = mysqli_query($conexion, $sql);

        if ($resultado) {
            echo "<p>Los datos se editaron.</p>";
        } else {
            echo "<p>Error al actualizar los datos: " . mysqli_error($conexion) . "</p>";
        }

        Desconectar($conexion);
    }
    ?>

    <form method="post">
        <label for="id_detalle_venta">Numero de Detalle a Editar:</label>
        <input type="number" id="id_detalle_venta" name="id_detalle_venta" required><br><br>
        <input type="submit" value="Buscar">
    </form>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../js/detalles_venta.js"></script>

</body>

</html>