<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Reabastecimiento</title>
    <link rel="stylesheet" href="../css/styles.css">
    <script>
        function confirmarEditar() {
            return confirm("¿Está seguro de que desea editar este reabastecimiento?");
        }
    </script>
</head>
<header id="formularios-header">
        <h1 id="titulo-formularios">Editar Reabastecimiento</h1>
        <a id="volver" href="reabastecimiento.php">Volver</a>
    </header>
<body>


    <form method="get">
        <label for="id_reabastecimiento">ID del Reabastecimiento a Editar:</label>
        <input type="text" id="id_reabastecimiento" name="id_reabastecimiento" required><br><br>
        <input type="submit" value="Buscar">
    </form>

    <?php
    include '../DAL/conexion.php';

    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id_reabastecimiento'])) {
        $id_reabastecimiento = $_GET['id_reabastecimiento'];

        $conexion = Conecta();
        $sql = "SELECT * FROM ReabastecimientoStock WHERE id_reabastecimiento = $id_reabastecimiento";
        $resultado = mysqli_query($conexion, $sql);

        if ($resultado && mysqli_num_rows($resultado) > 0) {
            $fila = mysqli_fetch_assoc($resultado);
            $id_producto = $fila['id_producto'];
            $cantidad = $fila['cantidad'];

            
            $sql_productos = "SELECT id_producto, nombre_producto FROM Productos";
            $resultado_productos = mysqli_query($conexion, $sql_productos);

            echo "<form method='post' onsubmit='return confirmarEditar()'>";
            echo "<input type='hidden' name='id_reabastecimiento' value='$id_reabastecimiento'>";
            echo "<label for='producto'>Producto:</label>";
            echo "<select id='producto' name='id_producto' required>";
            while ($fila_producto = mysqli_fetch_assoc($resultado_productos)) {
                $selected = ($fila_producto['id_producto'] == $id_producto) ? 'selected' : '';
                echo "<option value='" . $fila_producto['id_producto'] . "' $selected>" . $fila_producto['nombre_producto'] . "</option>";
            }
            echo "</select><br><br>";
            echo "<label for='cantidad'>Cantidad a Reabastecer:</label>";
            echo "<input type='number' id='cantidad' name='cantidad' value='$cantidad' required><br><br>";
            echo "<input type='submit' value='Actualizar'>";
            echo "</form>";
        } else {
            echo "No se encontró ningún reabastecimiento con el ID proporcionado.";
        }

        Desconectar($conexion);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id_reabastecimiento = $_POST['id_reabastecimiento'];
        $id_producto = $_POST['id_producto'];
        $cantidad = $_POST['cantidad'];

        $conexion = Conecta();
        $sql = "UPDATE ReabastecimientoStock SET id_producto = '$id_producto', cantidad = '$cantidad' WHERE id_reabastecimiento = $id_reabastecimiento";

        if (mysqli_query($conexion, $sql)) {
            echo "Reabastecimiento actualizado correctamente.";
        } else {
            echo "Error al actualizar el reabastecimiento: " . mysqli_error($conexion);
        }

        Desconectar($conexion);
    }
    ?>

   
</body>

</html>
