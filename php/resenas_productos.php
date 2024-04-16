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
    <link rel="stylesheet" href="../css/styles.css">
    
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
