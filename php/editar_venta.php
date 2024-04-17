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

    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id_venta'])) {
        $id_venta = $_GET['id_venta'];

        $conexion = Conecta();
        $sql = "SELECT * FROM Venta WHERE id_venta = ?";
        $stmt = mysqli_prepare($conexion, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "i", $id_venta);
            mysqli_stmt_execute($stmt);
            $resultado = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($resultado) > 0) {
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

            mysqli_stmt_close($stmt);
        } else {
            echo "<p>Error en la preparación de la consulta: " . mysqli_error($conexion) . "</p>";
        }

        Desconectar($conexion);

    } elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['guardar'])) {
        $id_venta = $_POST['id_venta'];
        $id_cliente = $_POST['id_cliente'];
        $id_empleado = $_POST['id_empleado'];
        $fecha = $_POST['fecha'];
        $total = $_POST['total'];

        $conexion = Conecta();
        $sql = "UPDATE Venta SET id_cliente=?, id_empleado=?, fecha=?, total=? WHERE id_venta=?";
        $stmt = mysqli_prepare($conexion, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "iisdi", $id_cliente, $id_empleado, $fecha, $total, $id_venta);
            
            if (mysqli_stmt_execute($stmt)) {
                echo "<p>La venta se actualizó correctamente.</p>";
            } else {
                echo "<p>Error al actualizar la venta: " . mysqli_error($conexion) . "</p>";
            }

            mysqli_stmt_close($stmt);
        } else {
            echo "<p>Error en la preparación de la consulta: " . mysqli_error($conexion) . "</p>";
        }

        Desconectar($conexion);
    } else {
        echo '<form method="get">';
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
