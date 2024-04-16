<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Agregar Empleado</title>
    
    <link rel="stylesheet" href="../css/styles.css">
</head>

<header id="formularios-header">
        <h1 id="titulo-formularios">Agregar Empleado</h1>
        <a id="volver" href="empleados.php">Volver</a>
    </header>
<body>
    

    <?php
    include '../DAL/conexion.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $direccion = $_POST['direccion'];
        $email = $_POST['email'];
        $telefono = $_POST['telefono'];
        $imagen = $_POST['imagen'];

        $conexion = Conecta();
        $sql = "INSERT INTO Empleados (nombre_empleado, apellido_empleado, email, telefono, direccion, imagen) VALUES ('$nombre', '$apellido', '$email', '$telefono', '$direccion', '$imagen')";

        if (mysqli_query($conexion, $sql)) {
            echo "Empleado agregado correctamente.";
        } else {
            echo "Error al agregar el empleado: " . mysqli_error($conexion);
        }

        Desconectar($conexion);
    }
    ?>
<div class="container-formularios">
    <form id="form-agregar-empleado" method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br><br>

        <label for="apellido">Apellido:</label>
        <input type="text" id="apellido" name="apellido" required><br><br>

        <label for="direccion">Dirección:</label>
        <input type="text" id="direccion" name="direccion"><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email"><br><br>

        <label for="telefono">Teléfono:</label>
        <input type="text" id="telefono" name="telefono"><br><br>

        <label for="imagen">URL de la Imagen:</label>
        <input type="text" id="imagen" name="imagen"><br><br>

        <input type="submit" value="Guardar">
    </form>
    </div>

    

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../js/empleados.js"></script>
</body>
</html>
