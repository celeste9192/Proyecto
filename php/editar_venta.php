<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Editar Venta</title>
</head>
<body>
    <header id="formularios-header">
        <h1 id="titulo-formularios">Editar Venta</h1>
        <a id="volver" href="ventas.php">Volver</a>
    </header>

    <?php
    include '../DAL/conexion.php';

   
    function limpiarDatos($dato)
    {
        return htmlspecialchars(stripslashes(trim($dato)));
    }

  
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_venta'])) {
        $id_venta = limpiarDatos($_POST['id_venta']);

        
        $conexion = Conecta();

      
        $sql = "SELECT * FROM Venta WHERE id_venta = $id_venta";
        $resultado = mysqli_query($conexion, $sql);

        if ($resultado && mysqli_num_rows($resultado) > 0) {
            $venta = mysqli_fetch_assoc($resultado);

            echo '<form id="editForm" method="POST">';
            echo '<input type="hidden" name="id_venta" value="' . $id_venta . '">';
            echo '<label for="id_cliente">Cliente:</label>';
            echo '<input type="number" id="id_cliente" name="id_cliente" value="' . ($venta['id_cliente'] ?? '') . '"><br>';
            echo '<label for="id_empleado">Empleado:</label>';
            echo '<input type="number" id="id_empleado" name="id_empleado" value="' . ($venta['id_empleado'] ?? '') . '"><br>';
            echo '<label for="fecha">Fecha:</label>';
            echo '<input type="date" id="fecha" name="fecha" value="' . ($venta['fecha'] ?? '') . '"><br>';
            echo '<label for="total">Total:</label>';
            echo '<input type="number" id="total" name="total" value="' . ($venta['total'] ?? '') . '"><br>';
            echo '<input type="submit" name="guardar" value="Guardar Cambios">';
            echo '</form>';
        } else {
            echo "No se encontró la venta.";
        }

        Desconectar($conexion);
    } elseif (isset($_POST['guardar'])) {
        echo "<p>Faltan datos para procesar.</p>";
    } else {
        echo '<form method="post">';
        echo '<label for="id_venta">Número de Venta a Editar:</label>';
        echo '<input type="number" id="id_venta" name="id_venta" required><br><br>';
        echo '<input type="submit" value="Buscar">';
        echo '</form>';
    }
    ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../js/ventas.js"></script>
</body>

</html>
