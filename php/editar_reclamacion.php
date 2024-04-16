<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Reclamo</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body>
    <h1>Editar Reclamo</h1>

    <?php

    include '../DAL/conexion.php';

    if (isset($_GET['id_reclamacion'])) {
        $id_reclamacion = $_GET['id_reclamacion'];

        $conexion = Conecta();
        $sql = "SELECT * FROM Reclamaciones WHERE id_reclamacion = $id_reclamacion";
        $resultado = mysqli_query($conexion, $sql);

        if ($resultado && mysqli_num_rows($resultado) > 0) {
            $reclamacion = mysqli_fetch_assoc($resultado);

            echo '<form id="editForm" method="POST">';
            echo '<input type="hidden" name="id_reclamacion" value="' . $id_reclamacion . '">';
            echo '<label for="id_cliente">Cliente:</label>';
            echo '<input type="number" id="id_cliente" name="id_cliente" value="' . $id_cliente['id_cliente'] . '"><br>';
            echo '<label for="motivo">Motivo:</label>';
            echo '<input type="text" id="motivo" name="motivo" value="' . $motivo['motivo'] . '"><br>';

        } else {
            echo "No se encontró el reclamo.";
        }

        Desconectar($conexion);

    } else {

        echo '<form id="searchForm" action="" method="GET">';
        echo '<label for="id_reclamacion">Numero de Reclamo:</label>';
        echo '<input type="number" id="id_reclamacion" name="id_reclamacion">';
        echo '<button type="submit">Buscar</button>';
        echo '</form>';

    }

    if (isset($_POST['guardar'])) {

        $id_venta = $_POST['id_reclamacion'];
        $id_cliente = $_POST['id_cliente'];
        $motivo = $_POST['motivo'];

        $conexion = Conecta();
        $sql = "UPDATE Reclamacion SET id_cliente='$id_cliente', motivo='$motivo' WHERE id_reclamacion = $id_reclamacion";
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
        <label for="id_reclamacion">Numero de Reclamo a Editar:</label>
        <input type="number" id="id_reclamacion" name="id_reclamacion" required><br><br>
        <input type="submit" value="Buscar">
    </form>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../js/reclamacion.js"></script>

</body>

</html>