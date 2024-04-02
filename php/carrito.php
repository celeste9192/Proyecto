<?php
include 'conexion.php';

function obtenerCarrito()
{
    $conexion = Conecta();
    $consulta = "SELECT * FROM Carrito";
    $resultado = mysqli_query($conexion, $consulta);

    $carrito = array();

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        while ($fila = mysqli_fetch_assoc($resultado)) {
            $carrito[] = $fila;
        }
    }

    Desconectar($conexion);

    return $carrito;
}

$ventas = obtenerCarrito();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito</title>
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
        <h1>Carrito</h1>
    </header>
    <div class="container">
        <div class="btn-container">
            <a href="agregar_carrito.php" class="btn">Agregar Carrito</a>
            <a href="eliminar_carrito.php" class="btn">Eliminar Carrito</a>
            <a href="editar_carrito.php" class="btn">Editar Carrito</a>
        </div>

        <?php if (!empty($carrito)) : ?>
            <?php foreach ($carrito as $carrito) : ?>
                <div class="carrito">
                    <ul>
                        <li>ID Carrito: <?php echo $carrito['id_carrito']; ?></li>
                        <li>ID Cliente: <?php echo $carrito['id_cliente']; ?></li>
                        <li>ID Producto: <?php echo $carrito['id_producto']; ?></li>
                        <li>Cantidad: <?php echo $carrito['cantidad']; ?></li>
                        <li>Precio Unitario: <?php echo $carrito['precio_unitario']; ?></li>
                        <li>Subtotal: <?php echo $carrito['subtotal']; ?></li>
                    </ul>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <p class="no-carrito">No se encontraron carritos.</p>
        <?php endif; ?>
    </div>
    
    <a href="index.php" class="btn">Menu Principal</a>
</body>
</html>