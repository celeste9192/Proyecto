<?php
include '../DAL/conexion.php';


if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['producto_id'])) {
    $producto_id = $_GET['producto_id'];

    $conexion = Conecta();
    $consulta = "SELECT * FROM Productos WHERE id_producto = ?";
    $stmt = $conexion->prepare($consulta);
    $stmt->bind_param("i", $producto_id);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado && $resultado->num_rows > 0) {
        $producto = $resultado->fetch_assoc();
    } else {
        $mensaje = "No se encontró el producto.";
    }

    $stmt->close();
    Desconectar($conexion);
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['editar_producto'])) {
    $producto_id = $_POST['producto_id'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $imagen_url = $_POST['imagen_url'];

    $conexion = Conecta();
    $consulta = "UPDATE Productos SET nombre_producto=?, descripcion_producto=?, precio=?, imagen=? WHERE id_producto=?";
    $stmt = $conexion->prepare($consulta);
    $stmt->bind_param("ssdsi", $nombre, $descripcion, $precio, $imagen_url, $producto_id);
    
    if ($stmt->execute()) {
        echo "¡Producto editado correctamente!";
    } else {
        echo "Error al editar el producto: " . $conexion->error;
    }

    $stmt->close();
    Desconectar($conexion);
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>

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
    <h1>Editar Producto</h1>
    <?php if (!empty($mensaje)): ?>
    <script>
        alert("<?php echo $mensaje; ?>");
    </script>
    <?php endif; ?>
    <form action="" method="post">
        <input type="hidden" name="producto_id" value="<?php echo $producto_id; ?>">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" value="<?php echo $producto['nombre_producto']; ?>"><br>
        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion"><?php echo $producto['descripcion_producto']; ?></textarea><br>
        <label for="precio">Precio:</label>
        <input type="text" name="precio" value="<?php echo $producto['precio']; ?>"><br>
        <label for="imagen_url">URL de la Imagen:</label>
        <input type="text" name="imagen_url" value="<?php echo $producto['imagen']; ?>"><br>

        <input type="submit" name="editar_producto" value="Guardar Cambios">
    </form>
    <a href="index.php"><button>Menu principal</button></a>
    
    
    <script>
        function cargarProductos() {
            $.ajax({
                url: "../php/productos.php",
                method: "GET",
                dataType: "json",
                success: function(response) {
                    mostrarProductos(response);
                },
                error: function(xhr, status, error) {
                    console.error("Error al cargar los productos:", error);
                }
            });
        }
    </script>
</body>

</html>
