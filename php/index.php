<?php
include 'conexion.php';

function obtenerProductos()
{
    $conexion = Conecta();
    $consulta = "SELECT * FROM productos";
    $resultado = mysqli_query($conexion, $consulta);

    $productos = array();

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        while ($fila = mysqli_fetch_assoc($resultado)) {
            $productos[] = $fila;
        }
    }

    Desconectar($conexion);

    return $productos;
}

$productos = obtenerProductos();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Productos</title>
    <style>
        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            margin-bottom: 20px;
        }

        form {
            display: inline;
        }
    </style>
</head>

<body>
    <header>
        <h1>Lista de Productos</h1>
        <nav>
            <ul>
                <li><a href="productos.php">Catálogo</a></li>
                <li><a href="clientes.php">Clientes</a></li>
            </ul>
        </nav>
    </header>

    <?php if (!empty($productos)) : ?>
        <ul>
            <?php foreach ($productos as $producto) : ?>
                <li>
                    <strong>ID:</strong> <?php echo $producto['product_id']; ?><br>
                    <strong>Nombre:</strong> <?php echo $producto['nombre']; ?><br>
                    <strong>Descripción:</strong> <?php echo $producto['descripcion']; ?><br>
                    <strong>Precio:</strong> $<?php echo $producto['precio']; ?><br>
                    <strong>Cantidad en Stock:</strong> <?php echo $producto['cantidad_stock']; ?><br>
                    <strong>Imagen:</strong> <img src="<?php echo $producto['imagen']; ?>" width="100" height="100"><br>
                    <form action="eliminar_producto.php" method="post">
                        <input type="hidden" name="producto_id" value="<?php echo $producto['product_id']; ?>">
                        <input type="submit" value="Eliminar">
                    </form>
                    <form action="editar_producto.php" method="get">
                        <input type="hidden" name="producto_id" value="<?php echo $producto['product_id']; ?>">
                        <input type="submit" value="Editar">
                    </form>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else : ?>
        <p>No se encontraron productos.</p>
    <?php endif; ?>

    <a href="agregar_producto.php"><button>Agregar Producto</button></a>
</body>

</html>