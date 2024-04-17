<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Agregar Detalles</title>
</head>

<body>
    <header>
        <h1>Agregar Detalles</h1>
        <a id="volver" href="ventas.php">Volver</a>
    </header>
    <div class="container">

        <form id="form-agregar-detallesventa" method="post">
            <label for="id_venta">ID Venta:</label>
            <input type="text" id="id_venta" name="id_venta"><br>

            <label for="id_producto">ID Producto:</label>
            <input type="text" id="id_producto" name="id_producto"><br>

            <label for="cantidad">Cantidad:</label>
            <input type="text" id="cantidad" name="cantidad"><br>

            <label for="precio_unitario">Precio Unitario:</label>
            <input type="text" id="precio_unitario" name="precio_unitario"><br>

            <input type="submit" value="Agregar Detalles">
        </form>

        <a href="ventas.php" class="btn">Volver a Ventas</a>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="../js/detalles_venta.js"></script>

    </div>
</body>

</html>