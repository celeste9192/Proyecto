<?php
include 'conexion.php';

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['eliminar_producto'])) {
    $producto_id = $_POST['producto_id'];

    function obtenerProducto($conexion, $producto_id)
    {
        $consulta = "SELECT * FROM Productos WHERE id_producto = $producto_id";
        $resultado = mysqli_query($conexion, $consulta);
        return mysqli_fetch_assoc($resultado);
    }

    function eliminarProducto($conexion, $producto_id)
    {
        $consulta = "DELETE FROM Productos WHERE id_producto = $producto_id";
        $resultado = mysqli_query($conexion, $consulta);
        return $resultado;
    }

    $conexion = Conecta();
    $producto = obtenerProducto($conexion, $producto_id);
    Desconectar($conexion);

    if (!$producto) {
        $mensaje = "Producto no encontrado.";
    } else {
        if (isset($_POST['confirmar_eliminar'])) {
            $conexion = Conecta();
            if (eliminarProducto($conexion, $producto_id)) {
                $mensaje = "El producto ha sido eliminado correctamente.";
            } else {
                $mensaje = "Error al eliminar el producto.";
            }
            Desconectar($conexion);
        } else {
            $mensaje = "¿Estás seguro de que quieres eliminar este producto?";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Producto</title>
        <style>
        body,h1,h2,h3,h4,h5,h6,p,ul,li,button,input,form,label {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            color: #31241E;
            background-color: #F6F4F3;
        }
        h1,h2,h3,h4,h5,h6 {
            font-family: 'Montserrat', sans-serif;
            font-weight: bold;
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
            font-family: 'Montserrat', sans-serif;
            font-weight: bold;
            font-size: 16px;
            color: #31241E;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="number"],
        input[type="email"],
        input[type="url"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #D1C8C1;
        }

        input[type="submit"],
        button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #D1C8C1;
            color: #FFF;
            font-family: 'Montserrat', sans-serif;
            font-weight: bold;
            font-size: 18px;
            cursor: pointer;
        }

        button {
            background-color: transparent;
            color: #31241E;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        ul {
            margin-top: 20px;
            padding-left: 20px;
        }

        ul li {
            margin-bottom: 20px;
        }
        </style>
    <script>
        function confirmarEliminar() {
            return confirm("¿Estás seguro de que quieres eliminar este producto?");
        }
    </script>
</head>
<body>
       <?php if (!empty($mensaje)) { ?>
        <h2><?php echo $mensaje; ?></h2>
    <?php } ?>
    <?php if (!empty($producto)) { ?>
        <h2>Información del Producto</h2>
        <p><strong>ID:</strong> <?php echo $producto['id_producto']; ?></p>
        <p><strong>Nombre:</strong> <?php echo $producto['nombre_producto']; ?></p>
        <p><strong>Descripción:</strong> <?php echo $producto['descripcion_producto']; ?></p>
        <p><strong>Precio:</strong> <?php echo $producto['precio']; ?></p>
        <p><strong>Categoría:</strong> <?php echo $producto['id_categoria']; ?></p>
        <p><strong>Imagen:</strong> <?php echo $producto['imagen']; ?></p>
    <?php } ?>
    <form action="" method="post">
        <input type="hidden" name="producto_id" value="<?php echo isset($_POST['producto_id']) ? $_POST['producto_id'] : ''; ?>">
        <input type="submit" name="eliminar_producto" value="Eliminar Producto" onclick="return confirmarEliminar();">
        <?php if (isset($_POST['eliminar_producto']) && isset($_POST['producto_id'])) { ?>
            <input type="hidden" name="confirmar_eliminar" value="true">
        <?php } ?>
    </form>
    <a href="index.php">Volver al menú principal</a>
</body>
</html>