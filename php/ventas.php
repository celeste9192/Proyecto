<?php
include '../DAL/conexion.php';

function obtenerVentas()
{
    $conexion = Conecta();
    $sql = "SELECT * FROM Venta";
    $resultado = mysqli_query($conexion, $sql);

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        echo "<h2 id='subtitulo'>Listado de Ventas</h2>";
        echo "<div id='container'>";
        echo "<table id='tabla'>";
        echo "<tr><th>Número de Venta</th><th>Cliente</th><th>Empleado</th><th>Fecha</th><th>Total</th></tr>";

        while ($fila = mysqli_fetch_assoc($resultado)) {
            echo "<tr>";
            echo "<td>" . $fila['id_venta'] . "</td>";
            echo "<td>" . $fila['id_cliente'] . "</td>";
            echo "<td>" . $fila['id_empleado'] . "</td>";
            echo "<td>" . $fila['fecha'] . "</td>";
            echo "<td>" . $fila['total'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "</div>";
    } else {
        echo "<p id='no-products-msg'>No se encontraron ventas.</p>";
    }

    Desconectar($conexion);
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ventas</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body>
    <header id="titulo">
        <h1>Ventas</h1>
    </header>
    <div id="container">
        <div id="btn-container">
            <a href="agregar_venta.php" class="btn">Agregar Venta</a>
            <a href="eliminar_venta.php" class="btn">Eliminar Venta</a>
            <a href="editar_venta.php" class="btn">Editar Venta</a>
        </div>

        <?php obtenerVentas(); ?>
        <a href="agregar_detalle_venta.php" class="btn">Agregar Detalles</a>
        <a href="index.php" id="btn-menu-principal" class="btn">Menú Principal</a>
    </div>
</body>

</html>
