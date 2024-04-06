<?php
include '../DAL/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_producto = $_POST['id_producto'];
    $id_cliente = $_POST['id_cliente'];
    $calificacion = $_POST['calificacion'];
    $comentario = $_POST['comentario'];
    $fecha = date('Y-m-d'); 

    $conexion = Conecta();
    $consulta_cliente = "SELECT * FROM Clientes WHERE id_cliente = '$id_cliente'";
    $resultado_cliente = mysqli_query($conexion, $consulta_cliente);

    if (mysqli_num_rows($resultado_cliente) == 0) {
        echo "Error: El cliente con ID $id_cliente no existe.";
        exit();
    }

    $consulta = "INSERT INTO ReseñasProducto (id_producto, id_cliente, calificacion, comentario, fecha) VALUES ('$id_producto', '$id_cliente', '$calificacion', '$comentario', '$fecha')";

    if (mysqli_query($conexion, $consulta)) {
        header("Location: resenas_productos.php");
        exit();
    } else {
        echo "Error al agregar la reseña: " . mysqli_error($conexion);
    }

    Desconectar($conexion);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Reseña de Producto</title>
    <link rel="stylesheet" href="css/style.css">
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
<h1>Agregar Reseña de Producto</h1>
    <form method="post">
        <label for="id_producto">ID Producto:</label>
        <input type="number" id="id_producto" name="id_producto" required><br><br>

        <label for="id_cliente">ID Cliente:</label>
        <input type="number" id="id_cliente" name="id_cliente" required><br><br>

        <label for="calificacion">Calificación:</label>
        <input type="number" id="calificacion" name="calificacion" required><br><br>

        <label for="comentario">Comentario:</label>
        <textarea id="comentario" name="comentario" required></textarea><br><br>

        <input type="hidden" name="fecha" value="<?php echo date('Y-m-d'); ?>">
        
        <input type="submit" value="Agregar Reseña">
    </form>
    <a href="resenas_productos.php">Volver a la lista de reseñas</a>
</body>
</html>
