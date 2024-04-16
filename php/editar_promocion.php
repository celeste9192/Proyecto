<?php
include '../DAL/conexion.php';

$promociones = obtenerPromociones();

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

function obtenerPromociones()
{
    $conexion = Conecta();
    $consulta = "SELECT * FROM Promociones";
    $resultado = mysqli_query($conexion, $consulta);

    $promociones = array();

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        while ($fila = mysqli_fetch_assoc($resultado)) {
            $promociones[] = $fila;
        }
    }

    Desconectar($conexion);

    return $promociones;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Promoción</title>
    <link rel="stylesheet" href="../css/styles.css">
   

<body>


    <header id="formularios-header">
        <h1 id="titulo-formularios">Editar Promoción</h1>
        <a id="volver" href="promociones.php">Volver</a>
    </header>
    <div class="container">
        <div class="promo-select">
            <label for="select_promocion">Selecciona la Promoción:</label>
            <select id="select_promocion">
                <?php foreach ($promociones as $promo) : ?>
                    <option value="<?php echo $promo['id_promocion']; ?>" <?php echo ($promo['id_promocion'] == $promocion['id_promocion']) ? 'selected' : ''; ?>><?php echo $promo['nombre_promocion']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
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

    <script>
        document.getElementById('select_promocion').addEventListener('change', function() {
            var idPromocion = this.value;
            window.location.href = 'promociones.php?id=' + idPromocion;
        });
    </script>
</body>

</html>
