<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Reclamo</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body>
    <h1>Agregar Reclamo</h1>

    <form id="form-agregar-reclamacion" method="post">
        <label for="id_cliente">Cliente:</label>
        <input type="number" id="id_cliente" name="id_cliente" required><br><br>

        <label for="motivo">Motivo:</label>
        <textarea id="motivo" name="motivo" rows="4" required></textarea><br><br>

        <input type="submit" value="Agregar Reclamo">
    </form>

    <a href="reclamaciones.php" class="btn">Volver a Reclamos</a>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../js/ventas.js"></script>

</body>

</html>