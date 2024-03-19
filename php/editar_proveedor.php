<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Editar Proveedor</title>
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
    <h1>Editar Proveedor</h1>

    <?php
    include 'conexion.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['proveedor_id'])) {
        $proveedor_id = $_POST['proveedor_id'];

        $conexion = Conecta();
        $sql = "SELECT * FROM Proveedores WHERE id_proveedor = $proveedor_id";
        $resultado = mysqli_query($conexion, $sql);

        if ($resultado && mysqli_num_rows($resultado) > 0) {
            $proveedor = mysqli_fetch_assoc($resultado);
        } else {
            echo "No se encontró ningún proveedor con el ID proporcionado.";
            exit; 
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['actualizar'])) {
            $nombre = $_POST['nombre'];
            $contacto = $_POST['contacto'];
            $email = $_POST['email'];
            $telefono = $_POST['telefono'];
            $direccion = $_POST['direccion'];

            $sql = "UPDATE Proveedores SET nombre_proveedor='$nombre', contacto_proveedor='$contacto', email_proveedor='$email', telefono_proveedor='$telefono', direccion_proveedor='$direccion' WHERE id_proveedor = $proveedor_id";

            if (mysqli_query($conexion, $sql)) {
                echo "Proveedor actualizado correctamente.";
            } else {
                echo "Error al actualizar el proveedor: " . mysqli_error($conexion);
            }
        }

        Desconectar($conexion);
    }
    ?>

    <form method="post">
        <label for="proveedor_id">ID del Proveedor a Editar:</label>
        <input type="number" id="proveedor_id" name="proveedor_id" required><br><br>

        <input type="submit" value="Buscar">
    </form>

    <?php if (isset($proveedor)) : ?>
        <form method="post">
            <input type="hidden" name="proveedor_id" value="<?php echo $proveedor['id_proveedor']; ?>">

            <label for="nombre">Nombre del Proveedor:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo $proveedor['nombre_proveedor']; ?>" required><br><br>

            <label for="contacto">Contacto del Proveedor:</label>
            <input type="text" id="contacto" name="contacto" value="<?php echo $proveedor['contacto_proveedor']; ?>" required><br><br>

            <label for="email">Correo Electrónico:</label>
            <input type="email" id="email" name="email" value="<?php echo $proveedor['email_proveedor']; ?>" required><br><br>

            <label for="telefono">Teléfono del Proveedor:</label>
            <input type="text" id="telefono" name="telefono" value="<?php echo $proveedor['telefono_proveedor']; ?>" required><br><br>

            <label for="direccion">Dirección del Proveedor:</label>
            <textarea id="direccion" name="direccion" required><?php echo $proveedor['direccion_proveedor']; ?></textarea><br><br>

            <input type="submit" name="actualizar" value="Actualizar">
        </form>
    <?php endif; ?>

   
    <a href="proveedores.php"><button>Volver a proveedores</button></a>
</body>

</html>
