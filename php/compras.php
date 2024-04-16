<?php
include '../DAL/conexion.php';

function obtenerCompras()
{
    $conexion = Conecta();
    $sql = "SELECT * FROM Compras";
    $resultado = mysqli_query($conexion, $sql);

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        echo "<h2 id='subtitulo'>Listado de Compras:</h2>";
        echo "<table id='tabla'>";
        echo "<tr><th>Numero de Venta</th><th>Proveedor</th><th>Detalles</th><th>Fecha</th><th>Total</th></tr>";

        while ($fila = mysqli_fetch_assoc($resultado)) {
            echo "<tr>";
            echo "<td>" . $fila['id_compra'] . "</td>";
            echo "<td>" . $fila['id_proveedor'] . "</td>";
            echo "<td>" . $fila['detalles'] . "</td>";
            echo "<td>" . $fila['fecha'] . "</td>";
            echo "<td>" . $fila['total'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } 
    else {
        echo "No se encontro la compra.";
    }
    
    Desconectar($conexion);
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compras</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body>
    <header>
        <h1>Compras</h1>
    </header>
    <div class="container">
        <div class="btn-container">
            <a href="agregar_compra.php" class="btn">Agregar Compra</a>
            <a href="eliminar_compra.php" class="btn">Eliminar Compra</a>
            <a href="editar_compra.php" class="btn">Editar Compra</a>
        </div>

        <?php obtenerCompras(); ?>
        <a href="index.php" class="btn">Menu Principal</a>
</body>

</html>