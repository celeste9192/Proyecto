<?php
include '../DAL/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id_reclamacion'])) {
    $id_reclamacion = $_GET['id_reclamacion'];
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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['guardar'])) {
    $id_reclamacion = $_POST['id_reclamacion'];
    $estado = $_POST['estado']; 

    $conexion = Conecta();
    $sql = "UPDATE Reclamaciones SET estado='$estado' WHERE id_reclamacion = $id_reclamacion";
    $resultado = mysqli_query($conexion, $sql);

    if ($resultado) {
        Desconectar($conexion);
        echo '<script>alert("La reclamación se ha actualizado correctamente."); window.location.href = "reclamaciones.php";</script>';
        exit;
    } else {
        echo "<p>Error al actualizar los datos: " . mysqli_error($conexion) . "</p>";
    }
}
?>

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

    <form id="editForm" method="POST">
        <input type="hidden" name="id_reclamacion" id="id_reclamacion" value="<?php echo isset($reclamacion) ? $reclamacion['id_reclamacion'] : ''; ?>">
        <input type="hidden" name="id_cliente" id="id_cliente" value="<?php echo isset($reclamacion) ? $reclamacion['id_cliente'] : ''; ?>">

        <label for="motivo">Motivo:</label>
        <textarea id="motivo" name="motivo" rows="4" required><?php echo isset($reclamacion) ? $reclamacion['motivo'] : ''; ?></textarea><br><br>

        <label for="estado">Estado:</label>
        <select name="estado" id="estado" disabled>
            <option value="Pendiente" <?php echo isset($reclamacion) && $reclamacion['estado'] === 'Pendiente' ? 'selected' : ''; ?>>Pendiente</option>
            <option value="En Proceso" <?php echo isset($reclamacion) && $reclamacion['estado'] === 'En Proceso' ? 'selected' : ''; ?>>En Proceso</option>
            <option value="Finalizado" <?php echo isset($reclamacion) && $reclamacion['estado'] === 'Finalizado' ? 'selected' : ''; ?>>Finalizado</option>
        </select><br><br>

        <input type="submit" name="guardar" value="Guardar Cambios">
    </form>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="../js/reclamaciones.js"></script>
</body>

</html>
