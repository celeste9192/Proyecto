<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="..css/style.css">
    <title>Reabastecimiento de Stock</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
        <a id="volver" href="index.php">Volver</a>
    </header>
    <div class="container">
        <div class="btn-container">
            <a href="agregar_reabastecimiento.php" class="btn">Agregar Reabastecimiento</a>
            <a href="eliminar_reabastecimiento.php" class="btn">Eliminar Reabastecimiento</a>
            <a href="editar_reabastecimiento.php" class="btn">Editar Reabastecimiento</a>
        </div>

        <div id="reabastecimientos-container">
        <div id="reabastecimientos-container">
    <?php
    include '../DAL/conexion.php';

    function mostrarReabastecimientos()
    {
        $conexion = Conecta();
        $sql = "SELECT r.id_reabastecimiento, p.nombre_producto, r.cantidad, r.fecha, r.estado FROM ReabastecimientoStock r JOIN Productos p ON r.id_producto = p.id_producto";
        $resultado = mysqli_query($conexion, $sql);

        if ($resultado && mysqli_num_rows($resultado) > 0) {
            echo "<h2>Listado de Reabastecimientos</h2>";
            echo "<table>";
            echo "<tr><th>ID</th><th>Producto</th><th>Cantidad</th><th>Fecha</th><th>Estado</th><th>Acciones</th></tr>";

            while ($fila = mysqli_fetch_assoc($resultado)) {
                echo "<tr data-id='{$fila['id_reabastecimiento']}' data-producto='{$fila['nombre_producto']}' data-cantidad='{$fila['cantidad']}' data-fecha='{$fila['fecha']}' data-estado='{$fila['estado']}'>";
                echo "<td>" . $fila['id_reabastecimiento'] . "</td>";
                echo "<td>" . $fila['nombre_producto'] . "</td>";
                echo "<td>" . $fila['cantidad'] . "</td>";
                echo "<td>" . $fila['fecha'] . "</td>";
                echo "<td>" . $fila['estado'] . "</td>";
                echo "<td><button class='eliminar-btn'>Eliminar</button><button class='editar-btn'>Editar</button></td>";
                echo "</tr>";
            }
            echo "</table>";
            echo "</div>"; 
            echo "<div class='modal' id='eliminar-modal' style='display:none;'>
                <div class='modal-content'>
                    <h2>Eliminar Reabastecimiento</h2>
                    <p>¿Estás seguro de que deseas eliminar el reabastecimiento de <span id='producto-nombre'></span>?</p>
                    <input type='hidden' id='id_reabastecimiento' name='id_reabastecimiento'>
                    <button id='eliminar-reabastecimiento-btn'>Eliminar</button>
                    <button class='btn' id='cancelar-eliminar'>Cancelar</button>
                </div>
            </div>";
        } else {
            echo "No se encontraron reabastecimientos.";
        }

        Desconectar($conexion);
    }

    mostrarReabastecimientos();
    ?>

    
</div>
    </div>
    <script src="reabastecimiento.js"></script>
</body>

</html>