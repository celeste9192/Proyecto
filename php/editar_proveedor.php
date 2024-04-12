<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Editar Proveedor</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body>
    <h1>Editar Proveedor</h1>

    <?php
    include '../DAL/conexion.php';

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
        <form id="editForm" method="post">
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../js/proveedores.js"></script>
</body>

</html>
