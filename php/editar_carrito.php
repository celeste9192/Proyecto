<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Editar Carrito</title>
    <style>
        body,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p,
        ul,
        li,
        button,
        input,
        form,
        label {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            color: #31241E;
            background-color: #F6F4F3;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
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
<h1>Editar Carrito</h1>

<?php
include '../DAL/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_carrito'])) {
    $id_carrito = $_POST['id_carrito'];

    $conexion = Conecta();
    $sql = "SELECT * FROM Carrito WHERE id_carrito = $id_carrito";
    $resultado = mysqli_query($conexion, $sql);

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        $carrito = mysqli_fetch_assoc($resultado);
    } else {
        echo "No se encontró el carrito.";
        exit;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['editar'])) {
        $id_carrito = $_POST['id_carrito'];
        $id_cliente = $_POST['id_cliente'];
        $id_producto = $_POST['id_producto'];
        $cantidad = $_POST['cantidad'];
        $precio_unitario = $_POST['precio_unitario'];
        $subtotal = $_POST['subtotal'];

        $sql = "UPDATE Carrito SET id_cliente = $id_cliente, id_producto = $id_producto, cantidad = $cantidad, precio_unitario = $precio_unitario, subtotal = $subtotal WHERE id_carrito = $id_carrito";
        if (mysqli_query($conexion, $sql)) {
            echo "Carrito editado correctamente.";
        } else {
            echo "Error al editar carrito: " . mysqli_error($conexion);
        }
    }

    Desconectar($conexion);
}
?>

<form method="post">
    <label for="id_carrito">Numero de Carrito a Editar:</label>
    <input type="number" id="id_carrito" name="id_carrito" required><br><br>
    <input type="submit" value="Buscar">
</form>

<?php if (isset($carrito)): ?>
    <form method="post">
        <input type="hidden" name="id_carrito" value="<?php echo $carrito['id_carrito']; ?>">

        <label for="id_cliente">ID Cliente:</label>
        <input type="number" id="id_cliente" name="id_cliente" value="<?php echo $carrito['id_cliente']; ?>" required><br><br>

        <label for="id_producto">ID Producto:</label>
        <input type="number" id="id_producto" name="id_producto" value="<?php echo $carrito['id_producto']; ?>" required><br><br>

        <label for="cantidad">Cantidad:</label>
        <input type="number" id="cantidad" name="cantidad" value="<?php echo $carrito['cantidad']; ?>" required><br><br>

        <label for="precio_unitario">Precio Unitario:</label>
        <input type="number" id="precio_unitario" name="precio_unitario" value="<?php echo $carrito['precio_unitario']; ?>" required><br><br>

        <label for="subtotal">Subtotal:</label>
        <input type="number" id="subtotal" name="subtotal" value="<?php echo $carrito['subtotal']; ?>" required><br><br>

        <input type="submit" name="editar" value="Editar">
    </form>
<?php endif; ?>

<a href="carrito.php"><button>Volver a Carrito</button></a>
</body>

</html>