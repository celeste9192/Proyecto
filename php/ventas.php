<?php
include '../DAL/conexion.php';

function obtenerVentas()
{
    $conexion = Conecta();
    $consulta = "SELECT * FROM Venta";
    $resultado = mysqli_query($conexion, $consulta);

    $ventas = array();

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        while ($fila = mysqli_fetch_assoc($resultado)) {
            $ventas[] = $fila;
        }
    }

    Desconectar($conexion);

    return $ventas;
}

$ventas = obtenerVentas();
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
        <h1>Ventas</h1>
    </header>
    <div class="container">
        <div class="btn-container">
            <a href="agregar_venta.php" class="btn">Agregar Venta</a>
            <a href="eliminar_venta.php" class="btn">Eliminar Venta</a>
            <a href="editar_venta.php" class="btn">Editar Venta</a>
        </div>

        <?php if (!empty($ventas)) : ?>
            <?php foreach ($ventas as $venta) : ?>
                <div class="venta">
                    <ul>
                        <li>ID Venta: <?php echo $venta['id_venta']; ?></li>
                        <li>ID Cliente: <?php echo $venta['id_cliente']; ?></li>
                        <li>ID Empleado: <?php echo $venta['id_empleado']; ?></li>
                        <li>Fecha: <?php echo $venta['fecha']; ?></li>
                        <li>Total: <?php echo $venta['total']; ?></li>
                    </ul>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <p class="no-ventas">No se encontraron ventas.</p>
        <?php endif; ?>
    </div>
    
    <a href="index.php" class="btn">Menu Principal</a>
</body>
</html>
