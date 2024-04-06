<?php
include '../DAL/conexion.php';

function obtenerResenasProductos()
{
    $conexion = Conecta();
    $consulta = "SELECT * FROM ReseñasProducto";
    $resultado = mysqli_query($conexion, $consulta);

    $resenas = array();

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        while ($fila = mysqli_fetch_assoc($resultado)) {
            $resenas[] = $fila;
        }
    }

    Desconectar($conexion);

    return $resenas;
}

$resenas = obtenerResenasProductos();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reseñas de Productos</title>
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
        }

        h1 {
            font-size: 36px;
            text-align: center;
            margin-bottom: 20px;
            text-transform: uppercase;
            position: relative;
        }

        h1::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 100%;
            height: 2px;
            background-color: #31241E;
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

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #31241E;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #31241E;
            color: #FFF;
            text-transform: uppercase;
        }

        td a {
            color: #31241E;
            font-weight: bold;
            text-decoration: none;
        }

        td a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1>Reseñas de Productos</h1>
    <div>
        <table>
            <thead>
                <tr>
                    <th>ID Reseña</th>
                    <th>ID Producto</th>
                    <th>ID Cliente</th>
                    <th>Calificación</th>
                    <th>Comentario</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($resenas as $resena) : ?>
                    <tr>
                        <td><?php echo $resena['id_resena_producto']; ?></td>
                        <td><?php echo $resena['id_producto']; ?></td>
                        <td><?php echo $resena['id_cliente']; ?></td>
                        <td><?php echo $resena['calificacion']; ?></td>
                        <td><?php echo $resena['comentario']; ?></td>
                        <td><?php echo $resena['fecha']; ?></td>
                        <td>
                            <a href="editar_resena_producto.php?id=<?php echo $resena['id_resena_producto']; ?>">Editar</a>
                            <a href="eliminar_resena_producto.php?id=<?php echo $resena['id_resena_producto']; ?>" onclick="return confirm('¿Está seguro de que desea eliminar esta reseña?')">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <a href="agregar_resena_producto.php" class="btn">Agregar Reseña</a>
    <a href="index.php" class="btn">Menu Principal</a>
    
</body>
</html>
