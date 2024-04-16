<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Agregar Orden</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>

    <header id="formularios-header">
        <h1 id="titulo-formularios">Agregar Orden</h1>
        <a id="volver" href="orden_del_dia.php">Volver</a>
    </header>

<body>

<?php
include '../DAL/conexion.php';

$conexion = Conecta();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];
    $id_empleado = $_POST['id_empleado'];

    $resultado = mysqli_query($conexion, "SHOW TABLES LIKE 'Orden_del_dia'");
    if ($resultado && mysqli_num_rows($resultado) > 0) {
        
        $consulta = "INSERT INTO Orden_del_dia (titulo, descripcion, fecha_inicio, fecha_fin, id_empleado) VALUES (?, ?, ?, ?, ?)";
        $statement = mysqli_prepare($conexion, $consulta);
        mysqli_stmt_bind_param($statement, "ssssi", $titulo, $descripcion, $fecha_inicio, $fecha_fin, $id_empleado);
        if (mysqli_stmt_execute($statement)) {
            $mensaje = "Orden se agregó correctamente.";
        } else {
            $error = "Error al agregar orden: " . mysqli_error($conexion);
        }
        mysqli_stmt_close($statement);
    } else {
        $error = "La tabla 'Orden_del_dia' no existe en la base de datos.";
    }
}
?>



<?php if (isset($mensaje)) : ?>
    <p><?php echo $mensaje; ?></p>
<?php endif; ?>

<?php if (isset($error)) : ?>
    <p><?php echo $error; ?></p>
<?php endif; ?>
<div class="container-formularios">
<form method="post">
    <label for="titulo">Titulo:</label>
    <input type="text" id="titulo" name="titulo" required><br><br>

    <label for="descripcion">Descripcion:</label>
    <input type="text" id="descripcion" name="descripcion"><br><br>

    <label for="fecha_inicio">Fecha Inicio:</label>
    <input type="date" id="fecha_inicio" name="fecha_inicio"><br><br>

    <label for="fecha_fin">Fecha Fin:</label>
    <input type="date" id="fecha_fin" name="fecha_fin"><br><br>

    <label for="id_empleado">ID Empleado:</label>
    <input type="number" id="id_empleado" name="id_empleado"><br><br>

    <input type="submit" value="Agregar Orden">
</form>
</div>
<?php
Desconectar($conexion);
?>

</body>

</html>