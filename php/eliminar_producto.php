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
</head>
<body>
    <?php
    include 'conexion.php';

    if (isset($_POST['producto_id'])) {
        $producto_id = $_POST['producto_id'];

        function obtenerProducto($conexion, $producto_id)
        {
            $consulta = "SELECT * FROM productos WHERE product_id = $producto_id";
            $resultado = mysqli_query($conexion, $consulta);
            return mysqli_fetch_assoc($resultado);
        }

        function eliminarProducto($conexion, $producto_id)
        {
            $consulta = "DELETE FROM productos WHERE product_id = $producto_id";
            $resultado = mysqli_query($conexion, $consulta);
            return $resultado;
        }

        if (isset($_POST['confirmar_eliminar'])) {
            $conexion = Conecta();
            if (eliminarProducto($conexion, $producto_id)) {
                echo "<script>alert('El producto ha sido eliminado correctamente');</script>";
            } else {
                echo "<script>alert('Error al eliminar el producto');</script>";
            }
            Desconectar($conexion);
        } else {
            $conexion = Conecta();
            $producto = obtenerProducto($conexion, $producto_id);
            Desconectar($conexion);

            echo "<h2>Eliminar Producto</h2>";
            echo "<strong>ID:</strong> " . $producto['product_id'] . "<br>";
            echo "<strong>Nombre:</strong> " . $producto['nombre'] . "<br>";
            echo "<strong>Descripción:</strong> " . $producto['descripcion'] . "<br>";
            echo "<strong>Precio:</strong> $" . $producto['precio'] . "<br>";
            echo "<strong>Cantidad en Stock:</strong> " . $producto['cantidad_stock'] . "<br>";
            echo "<strong>Imagen:</strong> <img src='" . $producto['imagen'] . "' width='100' height='100'><br>";

            echo "<form action='eliminar_producto.php' method='post'>";
            echo "<input type='hidden' name='producto_id' value='" . $producto['product_id'] . "'>";
            echo "<input type='hidden' name='confirmar_eliminar' value='true'>";
            echo "<input type='submit' value='Eliminar'>";
            echo "</form>";
        }
    }

    echo "<a href='index.php'><button>Volver al menú principal</button></a>";
    ?>
</body>
</html>
