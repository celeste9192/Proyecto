<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombrePromocion = $_POST['nombre_promocion'];
    $descripcionPromocion = $_POST['descripcion_promocion'];
    $fechaInicio = $_POST['fecha_inicio'];
    $fechaFin = $_POST['fecha_fin'];
    $descuento = $_POST['descuento'];

    $conexion = Conecta();

    $insertarPromocion = "INSERT INTO Promociones (nombre_promocion, descripcion_promocion, fecha_inicio, fecha_fin, descuento) VALUES ('$nombrePromocion', '$descripcionPromocion', '$fechaInicio', '$fechaFin', '$descuento')";

    if (mysqli_query($conexion, $insertarPromocion)) {
        echo '<script>alert("Promoción agregada exitosamente.");</script>';
    } else {
        echo '<script>alert("Error al agregar la promoción: ' . mysqli_error($conexion) . '");</script>';
    }

    Desconectar($conexion);
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Promoción</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            color: #31241E;
            background-color: #F6F4F3;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
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

        form {
            background-color: #FFF;
            border: 1px solid #D1C8C1;
            border-radius: 5px;
            padding: 20px;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="text"],
        input[type="date"],
        input[type="number"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #D1C8C1;
            border-radius: 5px;
        }

        input[type="submit"] {
            background-color: #31241E;
            color: #FFF;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #42362b;
        }
    </style>
</head>

<body>
    <header>
        <h1>Agregar Promoción</h1>
        <a href="promociones.php">Volver</a>
    </header>
    <div class="container">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="nombre_promocion">Nombre de la Promoción:</label>
            <input type="text" id="nombre_promocion" name="nombre_promocion" required>

            <label for="descripcion_promocion">Descripción:</label>
            <input type="text" id="descripcion_promocion" name="descripcion_promocion" required>

            <label for="fecha_inicio">Fecha de Inicio:</label>
            <input type="date" id="fecha_inicio" name="fecha_inicio" required>

            <label for="fecha_fin">Fecha de Fin:</label>
            <input type="date" id="fecha_fin" name="fecha_fin" required>

            <label for="descuento">Descuento (%):</label>
            <input type="number" id="descuento" name="descuento" min="0" max="100" required>

            <input type="submit" value="Agregar Promoción">
        </form>
    </div>
</body>

</html>
