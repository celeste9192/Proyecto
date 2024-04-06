<?php
include '../DAL/conexion.php';

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

$promociones = obtenerPromociones();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Promociones</title>
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
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #31241E;
        }

        h1 {
            font-size: 36px;
            text-transform: uppercase;
        }

        .promo-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .promo-card {
            background-color: #FFF;
            border: 1px solid #D1C8C1;
            border-radius: 5px;
            padding: 20px;
        }

        .promo-card h2 {
            margin-bottom: 10px;
            font-size: 24px;
        }

        .promo-card p {
            margin-bottom: 10px;
        }

        .promo-card button {
            padding: 8px 16px;
            border: none;
            border-radius: 5px;
            background-color: #D1C8C1;
            color: #FFF;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .promo-card button:hover {
            background-color: #31241E;
        }
    </style>
</head>

<body>
    <header>
        <h1>Promociones</h1>
    </header>
    <div class="container">
        <div class="promo-container">
            <?php if (!empty($promociones)) : ?>
                <?php foreach ($promociones as $promocion) : ?>
                    <div class="promo-card">
                        <h2><?php echo $promocion['nombre_promocion']; ?></h2>
                        <p><?php echo $promocion['descripcion_promocion']; ?></p>
                        <p>Fecha de Inicio: <?php echo $promocion['fecha_inicio']; ?></p>
                        <p>Fecha de Fin: <?php echo $promocion['fecha_fin']; ?></p>
                        <p>Descuento: <?php echo $promocion['descuento']; ?>%</p>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p>No hay promociones disponibles.</p>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>
