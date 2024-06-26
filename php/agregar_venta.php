<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Agregar Venta</title>
</head>

<body>
    <header id="formularios-header">
        <h1 id="titulo-formularios">Agregar Venta</h1>
        <a id="volver" href="ventas.php">Volver</a>
    </header>

    <div class="container-formularios">
        <form id="form-agregar-venta" method="post">
            <label for="id_cliente">ID Cliente:</label>
            <input type="number" id="id_cliente" name="id_cliente" required><br><br>

            <label for="id_empleado">ID Empleado:</label>
            <input type="number" id="id_empleado" name="id_empleado"><br><br>

            <label for="fecha">Fecha:</label>
            <input type="date" id="fecha" name="fecha"><br><br>

            <label for="total">Total:</label>
            <input type="number" id="total" name="total"><br><br>

            <input type="submit" value="Agregar Venta">
        </form>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../js/ventas.js"></script>

</body>

</html>
