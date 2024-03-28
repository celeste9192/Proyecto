<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Reabastecimiento de Stock</title>
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
        }

        h1 {
            font-size: 36px;
            text-align: center;
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

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #31241E;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #31241E;
            color: #FFF;
            text-transform: uppercase;
        }

        td a {
            color: #31241E;
            font-weight: bold;
            text-decoration: none;
        }

        td a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <header>
        <h1>Reabastecimiento de Stock</h1>
    </header>
    <div class="container">
        <div class="btn-container">
            <a href="agregar_reabastecimiento.php" class="btn">Agregar Reabastecimiento</a>
            <a href="eliminar_reabastecimiento.php" class="btn">Eliminar Reabastecimiento</a>
            <a href="editar_reabastecimiento.php" class="btn">Editar Reabastecimiento</a>
        </div>

        <?php
        include 'conexion.php';

        function mostrarReabastecimientos()
        {
            $conexion = Conecta();
            $sql = "SELECT r.id_reabastecimiento, p.nombre_producto, r.cantidad, r.fecha, r.estado FROM ReabastecimientoStock r JOIN Productos p ON r.id_producto = p.id_producto";
            $resultado = mysqli_query($conexion, $sql);

            if ($resultado && mysqli_num_rows($resultado) > 0) {
                echo "<h2>Listado de Reabastecimientos</h2>";
                echo "<table>";
                echo "<tr><th>ID</th><th>Producto</th><th>Cantidad</th><th>Fecha</th><th>Estado</th></tr>";

                while ($fila = mysqli_fetch_assoc($resultado)) {
                    echo "<tr>";
                    echo "<td>" . $fila['id_reabastecimiento'] . "</td>";
                    echo "<td>" . $fila['nombre_producto'] . "</td>";
                    echo "<td>" . $fila['cantidad'] . "</td>";
                    echo "<td>" . $fila['fecha'] . "</td>";
                    echo "<td>" . $fila['estado'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "No se encontraron reabastecimientos.";
            }

            Desconectar($conexion);
        }

        mostrarReabastecimientos();
        ?>

        <a href="index.php" class="btn">Menú Principal</a>
    </div>
</body>

</html>
