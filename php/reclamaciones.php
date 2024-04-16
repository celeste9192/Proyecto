<?php
include '../DAL/conexion.php';

function obtenerReclamaciones()
{
    $conexion = Conecta();
    $sql = "SELECT * FROM Reclamaciones";
    $resultado = mysqli_query($conexion, $sql);

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        echo "<h2 id='subtitulo'>Listado de Reclamos</h2>";
        echo "<table id='tabla'>";
        echo "<tr><th>Numero de Reclamo</th><th>Cliente</th><th>Motivo</th><th>Estado</th><th>Fecha</th></tr>";

        while ($fila = mysqli_fetch_assoc($resultado)) {
            echo "<tr>";
            echo "<td>" . $fila['id_reclamacion'] . "</td>";
            echo "<td>" . $fila['id_cliente'] . "</td>";
            echo "<td>" . $fila['motivo'] . "</td>";
            echo "<td>" . $fila['estado'] . "</td>";
            echo "<td>" . $fila['fecha'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No se encontraron clientes.";
    }

    Desconectar($conexion);

}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reclamos</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body>
    <header>
        <h1>Reclamos</h1>
    </header>
    <div class="btn-container">
        <a href="agregar_reclamacion.php" class="btn">Agregar Reclamo</a>
        <a href="eliminar_reclamacion.php" class="btn">Eliminar Reclamo</a>
        <a href="editar_reclamacion.php" class="btn">Editar Reclamo</a>
    </div>

    <?php obtenerReclamaciones(); ?>
    <a href="index.php" class="btn">Volver al Menú Principal</a>

</body>

</html>