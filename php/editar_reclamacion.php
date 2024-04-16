<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Reclamo</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body>
    <header id="formularios-header">
        <h1 id="titulo-formularios">Editar Reclamo</h1>
        <a id="volver" href="reclamaciones.php">Volver</a>
    </header>

    <?php
    include '../DAL/conexion.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_reclamacion'])) {
        $id_reclamacion = $_POST['id_reclamacion'];

        $conexion = Conecta();
        $sql = "SELECT * FROM Reclamaciones WHERE id_reclamacion = $id_reclamacion";
        $resultado = mysqli_query($conexion, $sql);

        if ($resultado && mysqli_num_rows($resultado) > 0) {
            $reclamacion = mysqli_fetch_assoc($resultado);
        } else {
            echo "No se encontró el reclamo.";
            exit;
        }

        Desconectar($conexion);
    }

    if (isset($_POST['guardar'])) {
        $id_reclamacion = $_POST['id_reclamacion'];
        $id_cliente = $_POST['id_cliente'];
        $motivo = $_POST['motivo'];

        $conexion = Conecta();
        $sql = "UPDATE Reclamaciones SET id_cliente='$id_cliente', motivo='$motivo' WHERE id_reclamacion = $id_reclamacion";
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

    <?php if (isset($reclamacion)): ?>
        <form id="editForm" method="POST">
            <input type="hidden" name="id_reclamacion" value="<?php echo $id_reclamacion; ?>">
            
            <label for="id_cliente">ID Cliente:</label>
            <input type="number" id="id_cliente" name="id_cliente" value="<?php echo $reclamacion['id_cliente']; ?>" required><br><br>

            <label for="motivo">Motivo:</label>
            <input type="text" id="motivo" name="motivo" value="<?php echo $reclamacion['motivo']; ?>" required><br><br>

            <input type="submit" name="guardar" value="Guardar Cambios">
        </form>
    <?php endif; ?>

</body>

</html>
