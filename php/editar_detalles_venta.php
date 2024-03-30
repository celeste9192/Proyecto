<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Detalle de Venta</title>
    <style>
        body,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p,
        ul,
        li,
        button,
        input,
        form,
        label {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            color: #31241E;
            background-color: #F6F4F3;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: 'Montserrat', sans-serif;
            font-weight: bold;
        }

        header {
            background-color: #F6F4F3;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #31241E;
        }

        h1 {
            font-size: 36px;
            text-transform: uppercase;
        }

        nav ul {
            list-style-type: none;
            padding: 0;
        }

        nav ul li {
            display: inline-block;
            margin-right: 20px;
        }

        nav ul li a {
            text-decoration: none;
            font-family: 'Montserrat', sans-serif;
            font-weight: bold;
            font-size: 16px;
            color: #31241E;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="number"],
        input[type="email"],
        input[type="url"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #D1C8C1;
        }

        input[type="submit"],
        button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #D1C8C1;
            color: #FFF;
            font-family: 'Montserrat', sans-serif;
            font-weight: bold;
            font-size: 18px;
            cursor: pointer;
        }

        button {
            background-color: transparent;
            color: #31241E;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        ul {
            margin-top: 20px;
            padding-left: 20px;
        }

        ul li {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <header>
        <h1>Editar Detalle de Venta</h1>
    </header>
    <div class="container">
        <?php
        // Verificar si se recibieron datos del formulario
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            include 'conexion.php';

            // Recibir datos del formulario
            $id_detalle_venta = $_POST['id_detalle_venta'];
            $id_venta = $_POST['id_venta'];
            $id_producto = $_POST['id_producto'];
            $cantidad = $_POST['cantidad'];
            $precio_unitario = $_POST['precio_unitario'];
            $subtotal = $cantidad * $precio_unitario;

            // Actualizar el detalle de venta en la base de datos
            $conexion = Conecta();
            $sql = "UPDATE DetalleVenta SET id_venta='$id_venta', id_producto='$id_producto', cantidad='$cantidad', precio_unitario='$precio_unitario', subtotal='$subtotal' WHERE id_detalle_venta='$id_detalle_venta'";

            if (mysqli_query($conexion, $sql)) {
                echo "<p>Detalle de venta actualizado correctamente.</p>";
            } else {
                echo "Error al actualizar detalle de venta: " . mysqli_error($conexion);
            }

            Desconectar($conexion);
        }
        ?>

        <!-- Formulario para editar detalle de venta -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="id_detalle_venta">ID Detalle Venta:</label>
            <input type="text" id="id_detalle_venta" name="id_detalle_venta"><br>

            <label for="id_venta">ID Venta:</label>
            <input type="text" id="id_venta" name="id_venta"><br>

            <label for="id_producto">ID Producto:</label>
            <input type="text" id="id_producto" name="id_producto"><br>

            <label for="cantidad">Cantidad:</label>
            <input type="text" id="cantidad" name="cantidad"><br>

            <label for="precio_unitario">Precio Unitario:</label>
            <input type="text" id="precio_unitario" name="precio_unitario"><br>

            <input type="submit" value="Editar Detalle de Venta">
        </form>

        <a href="index.php" class="btn">Menú Principal</a>
    </div>
</body>

</html>