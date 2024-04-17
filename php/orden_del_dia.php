<?php
include '../DAL/conexion.php';

function obtenerOrden_del_Dia()
{
    $conexion = Conecta();
    $consulta = "SELECT * FROM orden_del_dia";
    $resultado = mysqli_query($conexion, $consulta);

    $orden_del_dia = array();

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        while ($fila = mysqli_fetch_assoc($resultado)) {
            $orden_del_dia[] = $fila;
        }
    }

    Desconectar($conexion);

    return $orden_del_dia;
}

$orden_del_dia = obtenerOrden_del_Dia();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ordenes del Dia</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="orden.js"></script>
    <link rel="stylesheet" href="../css/styles.css">
    
</head>
<body>
    <header>
        <h1>Ordenes del Dia</h1>
        <a id="volver" href="index.php">Volver</a>
    </header>
    <div class="container">
        <div class="btn-container">
            <a href="agregar_orden.php" class="btn">Agregar Orden</a>
            <a href="eliminar_orden.php" class="btn">Eliminar Orden</a>
            <a href="editar_orden.php" class="btn">Editar Orden</a>
        </div>

        <div id="ordenes-container">
            <?php if (!empty($orden_del_dia)) : ?>
                <?php foreach ($orden_del_dia as $orden) : ?>
                    <div class="orden">
                        <ul>
                            <li>ID Evento: <?php echo $orden['id_evento']; ?></li>
                            <li>Titulo: <?php echo $orden['titulo']; ?></li>
                            <li>Descripcion: <?php echo $orden['descripcion']; ?></li>
                            <li>Fecha Inicio: <?php echo $orden['fecha_inicio']; ?></li>
                            <li>Fecha Fin: <?php echo $orden['fecha_fin']; ?></li>
                            <li>ID Empleado: <?php echo $orden['id_empleado']; ?></li>
                        </ul>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p class="no-orden">No se encontro nada.</p>
            <?php endif; ?>
        </div>

    </div>
    
   

    <script>
        $(document).ready(function() {
            $('#agregar-orden-btn').click(function(e) {
                e.preventDefault();
                
                $.ajax({
                    url: 'agregar_orden.php',
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        if (data.length > 0) {
                            let html = '';
                            data.forEach(orden => {
                                html += `
                                    <div class="orden">
                                        <ul>
                                            <li>ID Evento: ${orden.id_evento}</li>
                                            <li>Titulo: ${orden.titulo}</li>
                                            <li>Descripcion: ${orden.descripcion}</li>
                                            <li>Fecha Inicio: ${orden.fecha_inicio}</li>
                                            <li>Fecha Fin: ${orden.fecha_fin}</li>
                                            <li>ID Empleado: ${orden.id_empleado}</li>
                                        </ul>
                                    </div>
                                `;
                            });
                            $('#ordenes-container').html(html);
                        } else {
                            $('#ordenes-container').html('<p class="no-orden">No se encontro nada.</p>');
                        }
                    },
                    error: function(error) {
                        console.log('Error:', error);
                    }
                });
            });
        });
    </script>
</body>
</html>