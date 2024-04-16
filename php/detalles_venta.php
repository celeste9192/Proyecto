<?php
include '../DAL/conexion.php';

function obtenerDetallesVenta()
{
    $conexion = Conecta();
    $sql = "SELECT * FROM DetalleVenta";
    $resultado = mysqli_query($conexion, $sql);

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        echo "<h2 id='subtitulo'>Listado de Detalles de las Ventas</h2>";
        echo "<div id='container'>";
        echo "<table id='tabla'>";
        echo "<tr><th>Número de Detalle</th><th>Venta</th><th>Producto</th><th>Cantidad</th><th>Precio Unitario</th><th>Subttal</th></tr>";

        while ($fila = mysqli_fetch_assoc($resultado)) {
            echo "<tr>";
            echo "<td>" . $fila['id_venta'] . "</td>";
            echo "<td>" . $fila['id_producto'] . "</td>";
            echo "<td>" . $fila['cantidad'] . "</td>";
            echo "<td>" . $fila['precio_unitario'] . "</td>";
            echo "<td>" . $fila['subtotal'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "</div>";
    } else {
        echo "<p id='no-products-msg'>No se encontro el detalle.</p>";
    }

    Desconectar($conexion);
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de Venta</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
<header>
    <h1>Detalles de Venta</h1>
</header>
<div class="container">
    <div class="btn-container">
        <a href="agregar_detalle_venta.php" class="btn">Agregar Detalle de Venta</a>
        <a href="eliminar_detalle_venta.php" class="btn">Eliminar Detalle de Venta</a>
        <a href="editar_detalle_venta.php" class="btn">Editar Detalle de Venta</a>
    </div>

    <?php obtenerDetallesVenta(); ?>
    
    <a href="index.php" class="btn">Menú Principal</a>
</div>
</body>
</html>
|