<?php
include 'conexion.php';

$mensaje = "";

if (isset($_GET['producto_id'])) {
    $producto_id = $_GET['producto_id'];

    function obtenerProducto($conexion, $producto_id)
    {
        $consulta = "SELECT * FROM productos WHERE product_id = $producto_id";
        $resultado = mysqli_query($conexion, $consulta);
        return mysqli_fetch_assoc($resultado);
    }

    $conexion = Conecta();
    $producto = obtenerProducto($conexion, $producto_id);
    Desconectar($conexion);

    if (!$producto) {
        echo "Producto no encontrado.";
        exit();
    }

    if (isset($_POST['editar_producto'])) {
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $precio = $_POST['precio'];
        $cantidad_stock = $_POST['cantidad_stock'];
        $imagen_url = $_POST['imagen_url'];
        $conexion = Conecta();
        $consulta = "UPDATE productos SET nombre='$nombre', descripcion='$descripcion', precio=$precio, cantidad_stock=$cantidad_stock, imagen='$imagen_url' WHERE product_id=$producto_id";
        $resultado = mysqli_query($conexion, $consulta);
        Desconectar($conexion);

        if ($resultado) {
            $mensaje = "Producto editado correctamente.";
        } else {
            $mensaje = "Error al editar el producto.";
        }
    }
} else {
    $mensaje = "ID de producto no proporcionado.";
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
    <script>
        function mostrarMensaje() {
            alert("<?php echo $mensaje; ?>");
        }
    </script>
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
</head>

<body onload="mostrarMensaje()">
    <h1>Editar Producto</h1>
    <form action="" method="post">
        <input type="hidden" name="producto_id" value="<?php echo $producto_id; ?>">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" value="<?php echo $producto['nombre']; ?>"><br>
        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion"><?php echo $producto['descripcion']; ?></textarea><br>
        <label for="precio">Precio:</label>
        <input type="text" name="precio" value="<?php echo $producto['precio']; ?>"><br>
        <label for="cantidad_stock">Cantidad en Stock:</label>
        <input type="text" name="cantidad_stock" value="<?php echo $producto['cantidad_stock']; ?>"><br>
        <label for="imagen_url">URL de la Imagen:</label>
        <input type="text" name="imagen_url" value="<?php echo $producto['imagen']; ?>"><br>

        <input type="submit" name="editar_producto" value="Guardar Cambios">
    </form>
    <a href="index.php"><button>Menu principal</button></a>
</body>

</html>