<?php
include '../DAL/conexion.php';

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
    <link rel="stylesheet" href="../css/styles.css">
   
</head>

<body>
    <header id="formularios-header">
        <h1 id="titulo-formularios " >Agregar Promoción</h1>
        <a id="volver" href="promociones.php">Volver</a>

    </header>
    <div class="container-formularios">
        <form id="formulario" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
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
