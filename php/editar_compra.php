<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Editar Compra</title>
</head>

<body>
    <h1>Editar Compra</h1>

    <?php

    include '../DAL/conexion.php';

    if (isset($_GET['id_compra'])) {
        $id_compra = $_GET['id_compra'];

        $conexion = Conecta();
        $sql = "SELECT * FROM Compras WHERE id_compra = $id_compra";
        $resultado = mysqli_query($conexion, $sql);

        if ($resultado && mysqli_num_rows($resultado) > 0) {
            $compra = mysqli_fetch_assoc($resultado);

            echo '<form id="editForm" method="POST">';
            echo '<input type="hidden" name="id_compra" value="' . $id_venta . '">';
            echo '<label for="id_proveedor">Proveedor:</label>';
            echo '<input type="number" id="id_proveedor" name="id_proveedor" value="' . $id_proveedor['id_proveedor'] . '"><br>';
            echo '<label for="detalles">Detalles:</label>';
            echo '<input type="text" id="detalles" name="detalles" value="' . $detalles['detalles'] . '"><br>';
            echo '<label for="fecha">Fecha:</label>';
            echo '<input type="date" id="fecha" name="fecha" value="' . $fecha['fecha'] . '"><br>';
            echo '<label for="total">Total:</label>';
            echo '<input type="number" id="total" name="total" value="' . $total['total'] . '"><br>';

        } else {
            echo "No se encontró la compra.";
        }

        Desconectar($conexion);

    } else {

        echo '<form id="searchForm" action="" method="GET">';
        echo '<label for="id_compra">Numero de Compra:</label>';
        echo '<input type="number" id="id_compra" name="id_compra">';
        echo '<button type="submit">Buscar</button>';
        echo '</form>';

    }

    if (isset($_POST['guardar'])) {

        $id_compra = $_POST['id_compra'];
        $id_proveedor = $_POST['id_proveedor'];
        $detalles = $_POST['detalles'];
        $fecha = $_POST['fecha'];
        $total = $_POST['total'];

        $conexion = Conecta();
        $sql = "UPDATE Compras SET id_proveedor='$id_proveedor', detalles='$detalles', fecha='$fecha', total='$total' WHERE id_venta = $id_venta";
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
        <label for="id_compra">Numero de Compra a Editar:</label>
        <input type="number" id="id_compra" name="id_compra" required><br><br>
        <input type="submit" value="Buscar">
    </form>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../js/compras.js"></script>
</body>

</html>