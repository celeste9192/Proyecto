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
    <title>Ventas</title>
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
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        header {
            background-color: #F6F4F3;
            padding: 20px;
            border-bottom: 1px solid #31241E;
            text-align: center;
        }

        h1 {
            font-size: 36px;
            margin-bottom: 20px;
            text-transform: uppercase;
        }

        .btn-container {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .btn-container a {
            margin: 0 10px;
            text-decoration: none;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #D1C8C1;
            color: #FFF;
            font-family: 'Montserrat', sans-serif;
            font-weight: bold;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #31241E;
        }

        .venta {
            background-color: #FFF;
            border: 1px solid #D1C8C1;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 20px;
        }

        .venta li {
            margin-bottom: 10px;
        }

        .no-ventas {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Orden del Dia</h1>
    </header>
    <div class="container">
        <div class="btn-container">
            <a href="agregar_orden.php" class="btn">Agregar Orden</a>
            <a href="eliminar_orden.php" class="btn">Eliminar Orden</a>
            <a href="editar_orden.php" class="btn">Editar Orden</a>
        </div>

        <?php if (!empty($orden_del_dia)) : ?>
            <?php foreach ($orden_del_dia as $orden_del_dia) : ?>
                <div class="orden">
                    <ul>
                        <li>ID Evento: <?php echo $venta['id_evento']; ?></li>
                        <li>Titulo: <?php echo $venta['titulo']; ?></li>
                        <li>Descripcion: <?php echo $venta['descripcion']; ?></li>
                        <li>Fecha Inicio: <?php echo $venta['fecha_inicio']; ?></li>
                        <li>Fecha Fin: <?php echo $venta['fecha_fin']; ?></li>
                        <li>ID Empleado: <?php echo $venta['id_empleado']; ?></li>
                    </ul>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <p class="no-orden">No se encontro nada.</p>
        <?php endif; ?>
    </div>
    
    <a href="index.php" class="btn">Menu Principal</a>
</body>
</html>