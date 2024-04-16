<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Editar Orden</title>
</head>

<header id="formularios-header">
    <h1 id="titulo-formularios">Editar Orden</h1>
    <a id="volver" href="orden_del_dia.php">Volver</a>
</header>

<body>

    <?php
    include '../DAL/conexion.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_evento'])) {
        $id_evento = $_POST['id_evento'];

        $conexion = Conecta();
        $sql = "SELECT * FROM Orden_del_dia WHERE id_evento = ?";
        $statement = mysqli_prepare($conexion, $sql);
        mysqli_stmt_bind_param($statement, "i", $id_evento);
        mysqli_stmt_execute($statement);
        $resultado = mysqli_stmt_get_result($statement);

        if ($resultado && mysqli_num_rows($resultado) > 0) {
            $orden_del_dia = mysqli_fetch_assoc($resultado);
        } else {
            echo "No se encontró la orden.";
            exit;
        }

        Desconectar($conexion);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['editar'])) {
        $id_evento = $_POST['id_evento'];
        $titulo = $_POST['titulo'];
        $descripcion = $_POST['descripcion'];
        $fecha_inicio = $_POST['fecha_inicio'];
        $fecha_fin = $_POST['fecha_fin'];
        $id_empleado = $_POST['id_empleado'];

        $conexion = Conecta();
        $sql = "UPDATE Orden_del_dia SET titulo = ?, descripcion = ?, fecha_inicio = ?, fecha_fin = ?, id_empleado = ? WHERE id_evento = ?";
        $statement = mysqli_prepare($conexion, $sql);
        mysqli_stmt_bind_param($statement, "ssssii", $titulo, $descripcion, $fecha_inicio, $fecha_fin, $id_empleado, $id_evento);
        
        if (mysqli_stmt_execute($statement)) {
            echo "Orden editada correctamente.";
        } else {
            echo "Error al editar orden: " . mysqli_error($conexion);
        }
        mysqli_stmt_close($statement);

        Desconectar($conexion);
    }
    ?>

    <form method="post">
        <label for="id_evento">Numero de Orden a Editar:</label>
        <input type="number" id="id_evento" name="id_evento" required><br><br>
        <input type="submit" value="Buscar">
    </form>

    <?php if (isset($orden_del_dia)): ?>
        <form method="post">
            <input type="hidden" name="id_evento" value="<?php echo $orden_del_dia['id_evento']; ?>">

            <label for="titulo">Titulo:</label>
            <input type="text" id="titulo" name="titulo" value="<?php echo $orden_del_dia['titulo']; ?>" required><br><br>

            <label for="descripcion">Descripcion:</label>
            <input type="text" id="descripcion" name="descripcion" value="<?php echo $orden_del_dia['descripcion']; ?>" required><br><br>

            <label for="fecha_inicio">Fecha Inicio:</label>
            <input type="date" id="fecha_inicio" name="fecha_inicio" value="<?php echo date('Y-m-d', strtotime($orden_del_dia['fecha_inicio'])); ?>" required><br><br>

            <label for="fecha_fin">Fecha Fin:</label>
            <input type="date" id="fecha_fin" name="fecha_fin" value="<?php echo date('Y-m-d', strtotime($orden_del_dia['fecha_fin'])); ?>" required><br><br>

            <label for="id_empleado">ID Empleado:</label>
            <input type="number" id="id_empleado" name="id_empleado" value="<?php echo $orden_del_dia['id_empleado']; ?>" required><br><br>

            <input type="submit" name="editar" value="Editar">
        </form>
    <?php endif; ?>


</body>

</html>
