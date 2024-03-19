<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Editar Cliente</title>
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
<h1>Editar Cliente</h1>

<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['cliente_id'])) {
    $cliente_id = $_POST['cliente_id'];

    $conexion = Conecta();
    $sql = "SELECT * FROM Clientes WHERE id_cliente = $cliente_id";
    $resultado = mysqli_query($conexion, $sql);

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        $cliente = mysqli_fetch_assoc($resultado);
    } else {
        echo "No se encontró ningún cliente con el ID proporcionado.";
        exit; 
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['actualizar'])) {
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $email = $_POST['email'];
        $telefono = $_POST['telefono'];
        $direccion = $_POST['direccion'];
        $imagen = $_POST['imagen'];

        $sql = "UPDATE Clientes SET nombre_cliente='$nombre', apellido_cliente='$apellido', email='$email', telefono='$telefono', direccion='$direccion', imagen='$imagen' WHERE id_cliente = $cliente_id";

        if (mysqli_query($conexion, $sql)) {
            echo "Cliente actualizado correctamente.";
        } else {
            echo "Error al actualizar el cliente: " . mysqli_error($conexion);
        }
    }

    Desconectar($conexion);
}
?>

<form method="post">
    <label for="cliente_id">ID del Cliente a Editar:</label>
    <input type="number" id="cliente_id" name="cliente_id" required><br><br>

    <input type="submit" value="Buscar">
</form>

<?php if (isset($cliente)) : ?>
    <form method="post">
        <input type="hidden" name="cliente_id" value="<?php echo $cliente['id_cliente']; ?>">

        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="<?php echo $cliente['nombre_cliente']; ?>" required><br><br>

        <label for="apellido">Apellido:</label>
        <input type="text" id="apellido" name="apellido" value="<?php echo $cliente['apellido_cliente']; ?>" required><br><br>

        <label for="email">Correo Electrónico:</label>
        <input type="email" id="email" name="email" value="<?php echo $cliente['email']; ?>"><br><br>

        <label for="telefono">Teléfono:</label>
        <input type="text" id="telefono" name="telefono" value="<?php echo $cliente['telefono']; ?>"><br><br>

        <label for="direccion">Dirección:</label>
        <textarea id="direccion" name="direccion"><?php echo $cliente['direccion']; ?></textarea><br><br>

        <label for="imagen">URL de la Imagen:</label>
        <input type="text" id="imagen" name="imagen" value="<?php echo $cliente['imagen']; ?>"><br><br>

        <input type="submit" name="actualizar" value="Actualizar">
    </form>
<?php endif; ?>

<a href="clientes.php"><button>Volver a Clientes</button></a>
</body>
</html>