<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <title>Agregar Reabastecimiento</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body>
    <header id="formularios-header">
        <h1 id="titulo-formularios">Agregar Reabastecimiento</h1>
        <a id="volver" href="reabastecimiento.php">Volver</a>
    </header>

    <?php
    include '../DAL/conexion.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id_producto = $_POST['id_producto'];
        $cantidad = $_POST['cantidad'];

        $estado = isset($_POST['estado']) ? $_POST['estado'] : 'Pendiente';

        $conexion = Conecta();
        $sql = "INSERT INTO ReabastecimientoStock (id_producto, cantidad, estado) VALUES ('$id_producto', '$cantidad', '$estado')";

        if (mysqli_query($conexion, $sql)) {
            echo "Reabastecimiento agregado correctamente.";
        } else {
            echo "Error al agregar el reabastecimiento: " . mysqli_error($conexion);
        }

        Desconectar($conexion);
    }
    ?>

    <form method="post">
        <label for="producto">Producto:</label>
        <select id="producto" name="id_producto" required>
            <option value="">Seleccionar producto</option>
            <?php

            $conexion = Conecta();
            $sql = "SELECT id_producto, nombre_producto FROM Productos";
            $resultado = mysqli_query($conexion, $sql);

            if ($resultado && mysqli_num_rows($resultado) > 0) {
                while ($fila = mysqli_fetch_assoc($resultado)) {
                    echo "<option value='" . $fila['id_producto'] . "'>" . $fila['nombre_producto'] . "</option>";
                }
            } else {
                echo "<option value=''>No hay productos disponibles</option>";
            }

            Desconectar($conexion);
            ?>
        </select><br><br>

        
            <label for="cantidad">Cantidad a Reabastecer:</label>
            <input type="number" id="cantidad" name="cantidad" required><br><br>

            <input type="hidden" name="estado" value="Pendiente">

            <input type="submit" value="Agregar">
      
    </form>

   
</body>

</html>
