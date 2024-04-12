<?php
include '../DAL/conexion.php';

if(isset($_POST['id_empleado']) && !isset($_POST['confirmar_eliminar'])) {
    $id_empleado = $_POST['id_empleado'];

    $conexion = Conecta();
    $sql = "SELECT * FROM Empleados WHERE id_empleado = '$id_empleado'";
    $resultado = mysqli_query($conexion, $sql);

    if(mysqli_num_rows($resultado) > 0) {
        $empleado = mysqli_fetch_assoc($resultado);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Empleado</title>
    <link rel="stylesheet" href="../css/styles.css"> 
</head>
<body>
<div class="container">
    <h1>Eliminar Empleado</h1>
    <p>Empleado:</p>
    <p>ID: <?php echo $empleado['id_empleado']; ?></p>
    <p>Nombre: <?php echo $empleado['nombre_empleado']; ?></p>
    <p>Apellido: <?php echo $empleado['apellido_empleado']; ?></p>
    <p>Email: <?php echo $empleado['email']; ?></p>
    <p>Teléfono: <?php echo $empleado['telefono']; ?></p>
    <p>Dirección: <?php echo $empleado['direccion']; ?></p>
    <p><button class="eliminar-empleado" onclick="eliminarEmpleado(<?php echo $empleado['id_empleado']; ?>);">Eliminar Empleado</button></p>

</div>
<a href="empleados.php"><button>Volver a Empleados</button></a>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="../js/empleados.js"></script>

</body>
</html>

<?php
    } else {
        echo json_encode(array("success" => false, "message" => "Empleado no encontrado."));
    }

    Desconectar($conexion);
} elseif(isset($_POST['confirmar_eliminar'])) {
    $id_empleado = $_POST['id_empleado'];

    $conexion = Conecta();
    $sql = "DELETE FROM Empleados WHERE id_empleado = '$id_empleado'";
    $resultado = mysqli_query($conexion, $sql);

    if($resultado) {
        echo json_encode(array("success" => true, "message" => "Empleado eliminado correctamente."));
    } else {
        echo json_encode(array("success" => false, "message" => "Error al eliminar empleado."));
    }

    Desconectar($conexion);
} else {
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Empleado</title>
    <link rel="stylesheet" href="../css/styles.css"> 
</head>
<body>
<div class="container">
    <h1>Eliminar Empleado</h1>
    <form method="post">
        <label for="id_empleado">Ingrese el ID del empleado:</label>
        <input type="text" id="id_empleado" name="id_empleado">
        <input type="submit" value="Buscar">
    </form>
</div>
<a href="empleados.php"><button>Volver a Empleados</button></a>
</body>
</html>

<?php
}
?>
