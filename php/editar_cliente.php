<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cliente</title>
</head>

<body>
    <h1>Editar Cliente</h1>

    <?php
    include 'conexion.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['cliente_id'])) {
        $cliente_id = $_POST['cliente_id'];

        $conexion = Conecta();
        $sql = "SELECT * FROM Clientes WHERE cliente_id = $cliente_id";
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
            $direccion = $_POST['direccion'];
            $ciudad = $_POST['ciudad'];
            $pais = $_POST['pais'];
            $correo = $_POST['correo'];
            $telefono = $_POST['telefono'];

            $sql = "UPDATE Clientes SET nombre='$nombre', apellido='$apellido', direccion='$direccion', ciudad='$ciudad', pais='$pais', correo_electronico='$correo', telefono='$telefono' WHERE cliente_id = $cliente_id";

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
            <input type="hidden" name="cliente_id" value="<?php echo $cliente['cliente_id']; ?>">

            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo $cliente['nombre']; ?>" required><br><br>

            <label for="apellido">Apellido:</label>
            <input type="text" id="apellido" name="apellido" value="<?php echo $cliente['apellido']; ?>" required><br><br>

            <label for="direccion">Dirección:</label>
            <input type="text" id="direccion" name="direccion" value="<?php echo $cliente['direccion']; ?>"><br><br>

            <label for="ciudad">Ciudad:</label>
            <input type="text" id="ciudad" name="ciudad" value="<?php echo $cliente['ciudad']; ?>"><br><br>

            <label for="pais">País:</label>
            <input type="text" id="pais" name="pais" value="<?php echo $cliente['pais']; ?>"><br><br>

            <label for="correo">Correo Electrónico:</label>
            <input type="email" id="correo" name="correo" value="<?php echo $cliente['correo_electronico']; ?>"><br><br>

            <label for="telefono">Teléfono:</label>
            <input type="text" id="telefono" name="telefono" value="<?php echo $cliente['telefono']; ?>"><br><br>

            <input type="submit" name="actualizar" value="Actualizar">
        </form>
    <?php endif; ?>

    <a href="clientes.php"><button>Volver a Clientes</button></a>
</body>

</html>