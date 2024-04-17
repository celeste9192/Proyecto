<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reabastecimiento de Stock</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="../css/styles.css">
    
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