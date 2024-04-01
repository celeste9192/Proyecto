<?php
include 'conexion.php';

function obtenerProductos()
{
    $conexion = Conecta();
    $consulta = "SELECT Productos.*, Categorias.nombre_categoria 
                 FROM Productos 
                 INNER JOIN Categorias 
                 ON Productos.id_categoria = Categorias.id_categoria";
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
            background-color: #31241E;
            color: #FFF;
            padding: 20px;
            text-align: center;
            border-bottom: 2px solid #FFF;
        }

        h1 {
            font-size: 36px;
            margin-bottom: 10px;
            text-transform: uppercase;
        }

        nav ul {
            list-style-type: none;
            padding: 0;
        }

        nav ul li {
            display: inline-block;
            margin-right: 20px;
        }

        nav ul li a {
            text-decoration: none;
            font-weight: bold;
            font-size: 16px;
            color: #FFF;
            transition: color 0.3s ease;
        }

        nav ul li a:hover {
            color: #D1C8C1;
        }

        .product-list {
            list-style-type: none;
            padding: 0;
            margin-top: 20px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .product-item {
            background-color: #FFF;
            border: 1px solid #D1C8C1;
            border-radius: 5px;
            padding: 20px;
            display: flex;
            flex-direction: column;
        }

        .product-item img {
            width: 100%;
            max-height: 200px;
            object-fit: cover;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .product-item p {
            margin-bottom: 10px;
        }

        .product-item form {
            margin-top: auto;
            display: flex;
            justify-content: space-between;
        }

        .product-item form button {
            padding: 8px 16px;
            border: none;
            border-radius: 5px;
            background-color: #D1C8C1;
            color: #FFF;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .product-item form button:hover {
            background-color: #31241E;
        }

        .no-products {
            text-align: center;
            margin-top: 20px;
        }

        .add-product-btn {
            text-align: center;
            margin-top: 20px;
        }

        .add-product-btn button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #D1C8C1;
            color: #FFF;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .add-product-btn button:hover {
            background-color: #31241E;
        }
    </style>
</head>

<body>
    <header>
        <h1>Lista de Productos</h1>
        <nav>
            <ul>
                <li><a href="index.php">Catálogo</a></li>
                <li><a href="promociones.php">Promociones</a></li>
                <li><a href="clientes.php">Clientes</a></li>
                <li><a href="categorias.php">Categorías</a></li>
                <li><a href="compras.php">Compras</a></li>
                <li><a href="ventas.php">Ventas</a></li>
                <li><a href="empleados.php">Empleados</a></li>
                <li><a href="proveedores.php">Proveedores</a></li>
                <li><a href="reabastecimiento.php">Reabastecimiento</a></li>
                <li><a href="resenas_productos.php">Reseñas de Productos</a></li>
                <li><a href="reclamaciones.php">Reclamaciones</a></li>
            </ul>
        </nav>
    </header>
    <div class="container">
        <?php if (!empty($productos)) : ?>
            <ul class="product-list">
                <?php foreach ($productos as $producto) : ?>
                    <li class="product-item">
                        <img src="<?php echo $producto['imagen']; ?>" alt="<?php echo $producto['nombre_producto']; ?>">
                        <p><strong><?php echo $producto['nombre_categoria']; ?></strong> </p>
                        <p><strong>Nombre:</strong> <?php echo $producto['nombre_producto']; ?></p>
                        <p><strong>Descripción:</strong> <?php echo $producto['descripcion_producto']; ?></p>
                        <p><strong>Precio:</strong> $<?php echo $producto['precio']; ?></p>
                        <form action="eliminar_producto.php" method="post">
                            <input type="hidden" name="producto_id" value="<?php echo $producto['id_producto']; ?>">
                            <button type="submit">Eliminar</button>
                        </form>
                        <form action="editar_producto.php" method="get">
                            <input type="hidden" name="producto_id" value="<?php echo $producto['id_producto']; ?>">
                            <button type="submit">Editar</button>
                        </form>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else : ?>
            <p class="no-products">No se encontraron productos.</p>
        <?php endif; ?>

        <div class="add-product-btn">
            <a href="agregar_producto.php"><button>Agregar Producto</button></a>
        </div>
    </div>
</body>
</html>
