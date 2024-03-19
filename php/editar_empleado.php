<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Editar Empleado</title>
    <style>
         body,h1,h2,h3,h4,h5,h6,p,ul,li,button,input,form,label {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            color: #31241E;
            background-color: #F6F4F3;
        }

        h1,h2,h3,h4,h5,h6 {
            font-family: 'Montserrat', sans-serif;
            font-weight: bold;
        }

        header {
            background-color: #F6F4F3;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #31241E;
        }

        h1 {
            font-size: 36px;
            text-transform: uppercase;
        }

        nav ul {
            list-style-type: none;
            padding: 0;
        }

        nav ul li {
            display: inline-block;
            margin-right: 20px;
        }

        nav ul li a {
            text-decoration: none;
            font-family: 'Montserrat', sans-serif;
            font-weight: bold;
            font-size: 16px;
            color: #31241E;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="number"],
        input[type="email"],
        input[type="url"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #D1C8C1;
        }

        input[type="submit"],
        button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #D1C8C1;
            color: #FFF;
            font-family: 'Montserrat', sans-serif;
            font-weight: bold;
            font-size: 18px;
            cursor: pointer;
        }

        button {
            background-color: transparent;
            color: #31241E;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        ul {
            margin-top: 20px;
            padding-left: 20px;
        }

        ul li {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <h1>Editar Empleado</h1>

    <?php
    include 'conexion.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['empleado_id'])) {
        $empleado_id = $_POST['empleado_id'];

        $conexion = Conecta();
        $sql = "SELECT * FROM Empleados WHERE id_empleado = $empleado_id";
        $resultado = mysqli_query($conexion, $sql);

        if ($resultado && mysqli_num_rows($resultado) > 0) {
            $empleado = mysqli_fetch_assoc($resultado);
        } else {
            echo "No se encontró ningún empleado con el ID proporcionado.";
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
                echo "Empleado actualizado correctamente.";
            } else {
                echo "Error al actualizar el empleado: " . mysqli_error($conexion);
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
        <form method="post">
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

            <input type="submit" name="actualizar" value="Actualizar">
        </form>
    <?php endif; ?>

    <a href="empleados.php"><button>Volver a Empleados</button></a>
</body>

</html>
