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
