<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de Venta</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            color: #31241E;
            background-color: #F6F4F3;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        header {
            background-color: #F6F4F3;
            padding: 20px;
            border-bottom: 1px solid #31241E;
            text-align: center;
        }

        h1 {
            font-size: 36px;
            margin-bottom: 20px;
            text-transform: uppercase;
        }

        .btn-container {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .btn-container a {
            margin: 0 10px;
            text-decoration: none;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #D1C8C1;
            color: #FFF;
            font-family: 'Montserrat', sans-serif;
            font-weight: bold;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #31241E;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            margin-bottom: 10px;
            background-color: #FFF;
            border: 1px solid #D1C8C1;
            border-radius: 5px;
            padding: 10px;
        }

        .no-categories {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
<header>
    <h1>Detalles de Venta</h1>
</header>
<div class="container">
    <div class="btn-container">
        <a href="agregar_detalle_venta.php" class="btn">Agregar Detalle de Venta</a>
        <a href="eliminar_detalle_venta.php" class="btn">Eliminar Detalle de Venta</a>
        <a href="editar_detalle_venta.php" class="btn">Editar Detalle de Venta</a>
    </div>
    
    <?php
    include '../DAL/conexion.php';

    function leerDetallesVenta()
    {
        $conexion = Conecta();
        $sql = "SELECT * FROM DetalleVenta";
        $resultado = mysqli_query($conexion, $sql);

        if ($resultado && mysqli_num_rows($resultado) > 0) {
            echo "<h2>Listado de Detalles de Venta</h2>";
            echo "<table>";
            echo "<tr><th>ID Detalle Venta</th><th>ID Venta</th><th>ID Producto</th><th>Cantidad</th><th>Precio Unitario</th><th>Subtotal</th></tr>";

            while ($fila = mysqli_fetch_assoc($resultado)) {
                echo "<tr>";
                echo "<td>" . $fila['id_detalle_venta'] . "</td>";
                echo "<td>" . $fila['id_venta'] . "</td>";
                echo "<td>" . $fila['id_producto'] . "</td>";
                echo "<td>" . $fila['cantidad'] . "</td>";
                echo "<td>" . $fila['precio_unitario'] . "</td>";
                echo "<td>" . $fila['subtotal'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "No se encontraron detalles de venta.";
        }

        Desconectar($conexion);
    }

    leerDetallesVenta();
    ?>
    
    <a href="index.php" class="btn">Menú Principal</a>
</div>
</body>
</html>
|