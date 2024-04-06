<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Editar Orden</title>
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
<h1>Editar Orden</h1>

<?php
include '../DAL/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_evento'])) {
    $id_venta = $_POST['id_evento'];

    $conexion = Conecta();
    $sql = "SELECT * FROM Orden_del_dia WHERE id_evento = $id_evento";
    $resultado = mysqli_query($conexion, $sql);

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        $venta = mysqli_fetch_assoc($resultado);
    } else {
        echo "No se encontró la orden.";
        exit;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['editar'])) {
        $id_evento = $_POST['id_venta'];
        $titulo = $_POST['titulo'];
        $descripcion = $_POST['descripcion'];
        $fecha_inicio = $_POST['fecha_inicio'];
        $fecha_fin = $_POST['fecha_fin'];
        $id_empleado = $_POST['id_empleado'];

        $sql = "UPDATE Orden_del_dia SET titulo = $titulo, descripcion = $descripcion, fecha_inicio = $fecha_inicio, fecha_fin = $fecha_fin, id_empleado = $id_empleado WHERE id_evento = $id_evento";
        if (mysqli_query($conexion, $sql)) {
            echo "Orden editada correctamente.";
        } else {
            echo "Error al editar orden: " . mysqli_error($conexion);
        }
    }

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
        <input type="date" id="fecha_inicio" name="fecha_inicio" value="<?php echo $orden_del_dia['fecha_inicio']; ?>" required><br><br>

        <label for="fecha_fin">Fecha Fin:</label>
        <input type="date" id="fecha_fin" name="fecha_fin" value="<?php echo $orden_del_dia['fecha_fin']; ?>" required><br><br>

        <label for="id_empleado">ID Empleado:</label>
        <input type="number" id="id_empleado" name="id_empleado" value="<?php echo $venta['id_empleado']; ?>" required><br><br>

        <input type="submit" name="editar" value="Editar">
    </form>
<?php endif; ?>

<a href="orden_del_dia.php"><button>Volver a Orden</button></a>
</body>

</html>