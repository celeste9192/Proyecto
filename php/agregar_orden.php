<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Agregar Orden</title>
    <style>
        body,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p,
        ul,
        li,
        button,
        input,
        form,
        label {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            color: #31241E;
            background-color: #F6F4F3;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
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

<?php
include 'conexion.php';

$conexion = Conecta();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_evento = $_POST['id_evento'];
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];
    $id_empleado = $_POST['id_empleado'];

    $resultado = mysqli_query($conexion, "SHOW TABLES LIKE 'Orden_del_dia'");
    if ($resultado && mysqli_num_rows($resultado) > 0) {
        
        $consulta = "INSERT INTO Orden_del_dia (id_evento, titulo, descripcion, fecha_inicio, fecha_fin, id_empleado) VALUES (?, ?, ?, ?, ?, ?)";
        $statement = mysqli_prepare($conexion, $consulta);
        mysqli_stmt_bind_param($statement, "iisd", $id_evento, $titulo, $descripcion, $fecha_inicio, $fecha_fin, $id_empleado);
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

<h1>Agregar Orden</h1>

<?php if (isset($mensaje)) : ?>
    <p><?php echo $mensaje; ?></p>
<?php endif; ?>

<?php if (isset($error)) : ?>
    <p><?php echo $error; ?></p>
<?php endif; ?>

<form method="post">
    <label for="id_evento">ID Evento:</label>
    <input type="number" id="id_evento" name="id_evento" required><br><br>

    <label for="titulo">Titulo:</label>
    <input type="text" id="id_empleado" name="id_empleado"><br><br>

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

<?php

Desconectar($conexion);
?>

<a href="orden_del_dia.php"><button>Volver a Orden del Dia</button></a>
</body>

</html>
