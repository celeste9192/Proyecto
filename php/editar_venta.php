<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Editar Venta</title>
</head>

<body>
    <h1>Editar Venta</h1>

    <?php

    include '../DAL/conexion.php';

    if (isset($_GET['id_venta'])) {
        $id_venta = $_GET['id_venta'];

        $conexion = Conecta();
        $sql = "SELECT * FROM Ventas WHERE id_venta = $id_venta";
        $resultado = mysqli_query($conexion, $sql);

        if ($resultado && mysqli_num_rows($resultado) > 0) {
            $venta = mysqli_fetch_assoc($resultado);

            echo '<form id="editForm" method="POST">';
            echo '<input type="hidden" name="id_venta" value="' . $id_venta . '">';
            echo '<label for="id_cliente">Cliente:</label>';
            echo '<input type="number" id="id_cliente" name="id_cliente" value="' . $id_cliente['id_cliente'] . '"><br>';
            echo '<label for="id_empleado">Empleado:</label>';
            echo '<input type="number" id="id_empleado" name="id_empleado" value="' . $id_empleado['id_empleado'] . '"><br>';
            echo '<label for="fecha">Fecha:</label>';
            echo '<input type="date" id="fecha" name="fecha" value="' . $fecha['fecha'] . '"><br>';
            echo '<label for="total">Total:</label>';
            echo '<input type="number" id="total" name="total" value="' . $total['total'] . '"><br>';

        } else {
            echo "No se encontró la venta.";
        }

        Desconectar($conexion);

    } else {

        echo '<form id="searchForm" action="" method="GET">';
        echo '<label for="id_venta">Numero de Venta:</label>';
        echo '<input type="number" id="id_venta" name="id_venta">';
        echo '<button type="submit">Buscar</button>';
        echo '</form>';

    }

    if (isset($_POST['guardar'])) {

        $id_venta = $_POST['id_venta'];
        $id_cliente = $_POST['id_cliente'];
        $id_empleado = $_POST['id_empleado'];
        $fecha = $_POST['fecha'];
        $total = $_POST['total'];

        $conexion = Conecta();
        $sql = "UPDATE Ventas SET id_cliente='$id_cliente', id_empleado='$id_empleado', fecha='$fecha', total='$total' WHERE id_venta = $id_venta";
        $resultado = mysqli_query($conexion, $sql);

        if ($resultado) {
            echo "<p>Los datos se editaron.</p>";
        } else {
            echo "<p>Error al actualizar los datos: " . mysqli_error($conexion) . "</p>";
        }

        Desconectar($conexion);
    }
    ?>

    <form method="post">
        <label for="id_venta">Numero de Venta a Editar:</label>
        <input type="number" id="id_venta" name="id_venta" required><br><br>
        <input type="submit" value="Buscar">
    </form>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../js/ventas.js"></script>

</body>

</html>