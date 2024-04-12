<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Editar Empleado</title>
    
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body>
    <div class="container">
        <h1>Editar Empleado</h1>

        <?php
        include '../DAL/conexion.php';

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['empleado_id'])) {
            $empleado_id = $_POST['empleado_id'];

            $conexion = Conecta();
            $sql = "SELECT * FROM Empleados WHERE id_empleado = $empleado_id";
            $resultado = mysqli_query($conexion, $sql);

            if ($resultado && mysqli_num_rows($resultado) > 0) {
                $empleado = mysqli_fetch_assoc($resultado);
            } else {
                echo "<p>No se encontró ningún empleado con el ID proporcionado.</p>";
                exit;
            }

            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['actualizar'])) {
                $nombre = $_POST['nombre'];
                $apellido = $_POST['apellido'];
                $email = $_POST['email'];
                $telefono = $_POST['telefono'];
                $direccion = $_POST['direccion'];
                $imagen = $_POST['imagen'];

                $sql = "UPDATE Empleados SET nombre_empleado='$nombre', apellido_empleado='$apellido', email='$email', telefono='$telefono', direccion='$direccion', imagen='$imagen' WHERE id_empleado = $empleado_id";

                if (mysqli_query($conexion, $sql)) {
                    echo "<p>Empleado actualizado correctamente.</p>";
                } else {
                    echo "<p>Error al actualizar el empleado: " . mysqli_error($conexion) . "</p>";
                }
            }

            Desconectar($conexion);
        }
        ?>

        <form method="post">
            <label for="empleado_id">ID del Empleado a Editar:</label>
            <input type="number" id="empleado_id" name="empleado_id" required><br><br>
            <input type="submit" value="Buscar">
        </form>

        <?php if (isset($empleado)) : ?>
            <form id="editForm" method="post">
                <input type="hidden" name="empleado_id" value="<?php echo $empleado['id_empleado']; ?>">

                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="<?php echo $empleado['nombre_empleado']; ?>" required><br><br>

                <label for="apellido">Apellido:</label>
                <input type="text" id="apellido" name="apellido" value="<?php echo $empleado['apellido_empleado']; ?>" required><br><br>

                <label for="email">Correo Electrónico:</label>
                <input type="email" id="email" name="email" value="<?php echo $empleado['email']; ?>"><br><br>

                <label for="telefono">Teléfono:</label>
                <input type="text" id="telefono" name="telefono" value="<?php echo $empleado['telefono']; ?>"><br><br>

                <label for="direccion">Dirección:</label>
                <textarea id="direccion" name="direccion"><?php echo $empleado['direccion']; ?></textarea><br><br>

                <label for="imagen">URL de la Imagen:</label>
                <input type="text" id="imagen" name="imagen" value="<?php echo $empleado['imagen']; ?>"><br><br>

                <button type="submit" name="actualizar">Actualizar</button>
            </form>
        <?php endif; ?>

        <a href="empleados.php"><button>Volver a Empleados</button></a>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../js/empleados.js"></script>
</body>

</html>
