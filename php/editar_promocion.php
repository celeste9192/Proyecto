<?php
include '../DAL/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_promocion'])) {
    $idPromocion = $_POST['id_promocion'];
    $nombrePromocion = $_POST['nombre_promocion'];
    $descripcionPromocion = $_POST['descripcion_promocion'];
    $fechaInicio = $_POST['fecha_inicio'];
    $fechaFin = $_POST['fecha_fin'];
    $descuento = $_POST['descuento'];

    $conexion = Conecta();

    $actualizarPromocion = "UPDATE Promociones SET nombre_promocion='$nombrePromocion', descripcion_promocion='$descripcionPromocion', fecha_inicio='$fechaInicio', fecha_fin='$fechaFin', descuento='$descuento' WHERE id_promocion=$idPromocion";

    if (mysqli_query($conexion, $actualizarPromocion)) {
        echo '<script>alert("Promoción actualizada exitosamente.");</script>';
    } else {
        echo '<script>alert("Error al actualizar la promoción: ' . mysqli_error($conexion) . '");</script>';
    }

    Desconectar($conexion);
} elseif (isset($_GET['id'])) {
    $idPromocion = $_GET['id'];
    $conexion = Conecta();
    $consultaPromocion = "SELECT * FROM Promociones WHERE id_promocion=$idPromocion";
    $resultado = mysqli_query($conexion, $consultaPromocion);
    $promocion = mysqli_fetch_assoc($resultado);
    Desconectar($conexion);
} else {
    header("Location: promociones.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Promoción</title>
    <link rel="stylesheet" href="css/style.css">
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

<body>
    <header>
        <h1>Editar Promoción</h1>
        <a href="promociones.php">Volver</a>
    </header>
    <div class="container">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input type="hidden" name="id_promocion" value="<?php echo $promocion['id_promocion']; ?>">
            <label for="nombre_promocion">Nombre de la Promoción:</label>
            <input type="text" id="nombre_promocion" name="nombre_promocion" value="<?php echo $promocion['nombre_promocion']; ?>" required>

            <label for="descripcion_promocion">Descripción:</label>
            <input type="text" id="descripcion_promocion" name="descripcion_promocion" value="<?php echo $promocion['descripcion_promocion']; ?>" required>

            <label for="fecha_inicio">Fecha de Inicio:</label>
            <input type="date" id="fecha_inicio" name="fecha_inicio" value="<?php echo $promocion['fecha_inicio']; ?>" required>

            <label for="fecha_fin">Fecha de Fin:</label>
            <input type="date" id="fecha_fin" name="fecha_fin" value="<?php echo $promocion['fecha_fin']; ?>" required>

            <label for="descuento">Descuento (%):</label>
            <input type="number" id="descuento" name="descuento" min="0" max="100" value="<?php echo $promocion['descuento']; ?>" required>

            <input type="submit" value="Guardar Cambios">
        </form>
    </div>
</body>

</html>
