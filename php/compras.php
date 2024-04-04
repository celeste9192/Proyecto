<?php
include 'conexion.php';

function obtenerCompras()
{
    $conexion = Conecta();
    $consulta = "SELECT * FROM Compras";
    $resultado = mysqli_query($conexion, $consulta);

    $compras = array();

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        while ($fila = mysqli_fetch_assoc($resultado)) {
           
            $compras[] = $fila;
        }
    }

    Desconectar($conexion);

    return $compras;
}

$compras = obtenerCompras();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compras</title>
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

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            margin-bottom: 10px;
            background-color: #FFF;
            border: 1px solid #D1C8C1;
            border-radius: 5px;
            padding: 10px;
        }

        .no-categories {
            text-align: center;
            margin-top: 20px;
        }
    </style>
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

        <?php if (!empty($compras)) : ?>
            <ul>
                <?php foreach ($compras as $compra) : ?>
            <li>
                        <strong>ID de Compra:</strong> <?php echo $compra['id_compra']; ?><br>
                        <strong>ID de Proveedor:</strong> <?php echo $compra['id_proveedor']; ?><br>
                        <strong>Detalles:</strong> <?php echo $compra['detalles']; ?><br>
                        <strong>Fecha:</strong> <?php echo $compra['fecha_compra']; ?><br>
                        <strong>Total:</strong> <?php echo $compra['total_compra']; ?><br>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else : ?>
            <p class="no-purchases">No se encontraron compras.</p>
        <?php endif; ?>
    </div>
    
    <a href="index.php" class="btn">Menu Principal</a>
</body>
</html>
