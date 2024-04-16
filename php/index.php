<?php
include '../DAL/conexion.php';

session_start();

$rol = 'cliente'; 

if (isset($_SESSION['rol'])) {
    $rol = $_SESSION['rol'];
}

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


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['agregar_carrito']) && isset($_SESSION['id_cliente'])) {
    $producto_id = $_POST['producto_id'];
    $cliente_id = $_SESSION['id_cliente'];

 
    $conexion = Conecta();

    
    $consulta_producto = "SELECT * FROM Productos WHERE id_producto = $producto_id";
    $resultado_producto = mysqli_query($conexion, $consulta_producto);

    if ($resultado_producto && mysqli_num_rows($resultado_producto) > 0) {
        $producto = mysqli_fetch_assoc($resultado_producto);
        $precio_unitario = $producto['precio'];


        $subtotal = $precio_unitario;

        $consulta_carrito = "INSERT INTO Carrito (id_cliente, id_producto, cantidad, precio_unitario, subtotal) 
                             VALUES ($cliente_id, $producto_id, 1, $precio_unitario, $subtotal)";
        if (mysqli_query($conexion, $consulta_carrito)) {
            $mensaje = "El producto se agregó al carrito correctamente.";
        } else {
            $error = "Error al agregar el producto al carrito: " . mysqli_error($conexion);
        }
    } else {
        $error = "Error: No se encontró el producto en la base de datos.";
    }

    Desconectar($conexion);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda Electric</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <header id="header">
        <h1>Tienda Electric</h1>
        <div id="top-header">
            <?php if (isset($_SESSION['rol'])) : ?>
                <a href="cerrar_sesion.php" id="cerrar-sesion">Cerrar Sesión</a>
            <?php else : ?>
                <a href="inicio_sesion.php" id="iniciar-sesion">Iniciar Sesión</a>
            <?php endif; ?>
        </div>
        </div>
        <nav id="main-nav">
            <?php if ($rol == 'administrador') : ?>
                <li><a href="clientes.php">Clientes</a></li>
                <li><a href="categorias.php">Categorías</a></li>
                <li><a href="compras.php">Compras</a></li>
                <li><a href="ventas.php">Ventas</a></li>
                <li><a href="empleados.php">Empleados</a></li>
                <li><a href="proveedores.php">Proveedores</a></li>
                <li><a href="reabastecimiento.php">Reabastecimiento</a></li>
                <li><a href="promociones.php">Promociones</a></li>
                <li><a href="resenas_productos.php">Reseñas de Productos</a></li>
                <li><a href="reclamaciones.php">Reclamaciones</a></li> 
                <li><a href="agregar_producto.php" id="agregar-producto">Agregar Producto</a></li>
            <?php elseif ($rol == 'cliente') : ?>
                <li><a href="index.php">Catálogo</a></li>
                <li><a href="promociones.php">Promociones</a></li>
                <li><a href="resenas_productos.php">Reseñas de Productos</a></li>
                <li><a href="reclamaciones.php">Reclamaciones</a></li>
                <li><a href="carrito2.php">Carrito</a></li>
            <?php endif; ?>
        </nav>
    </header>
    <div id="container">
        <?php foreach ($productos as $producto) : ?>
            <div class="product-item">
                <img src="<?php echo $producto['imagen']; ?>" alt="<?php echo $producto['nombre_producto']; ?>">
                <p id="nombre-producto"><strong><?php echo $producto['nombre_producto']; ?></strong></p>
                <p><strong>Categoria:</strong><?php echo $producto['nombre_categoria']; ?></p>
                <p><strong>Descripción:</strong> <?php echo $producto['descripcion_producto']; ?></p>
                <p><strong>Precio:</strong> $<?php echo $producto['precio']; ?></p>
                <?php if ($rol == 'administrador') : ?>
                    <form action="eliminar_producto.php" method="post" class="botones-form">
                        <input type="hidden" name="producto_id" value="<?php echo $producto['id_producto']; ?>">
                        <button type="submit" id="eliminar-producto">Eliminar</button>
                    </form>
                    <form action="editar_producto.php" method="get" class="botones-form">
                        <input type="hidden" name="producto_id" value="<?php echo $producto['id_producto']; ?>">
                        <button type="submit" id="editar-producto">Editar</button>
                    </form>
                <?php elseif (isset($_SESSION['rol'])) : ?>
                    <?php if (isset($_SESSION['id_cliente'])) : ?>
                        <form action="" method="post">
                            <input type="hidden" name="producto_id" value="<?php echo $producto['id_producto']; ?>">
                            <button type="submit" name="agregar_carrito">Agregar al carrito</button>
                        </form>
                    <?php else : ?>
                        <p id="mensaje-iniciar-sesion">Por favor, inicia sesión para agregar productos al carrito.</p>
                    <?php endif; ?>
                <?php else : ?>
                    <p id="mensaje-iniciar-sesion">Por favor, inicia sesión para agregar productos al carrito.</p>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
    <?php if ($rol == 'administrador') : ?>
        <form action="agregar_producto.php" method="get" id="agregar-producto-form">
            <button type="submit" id="agregar-producto">Agregar Producto</button>
        </form>
    <?php endif; ?>
</body>
</html>

