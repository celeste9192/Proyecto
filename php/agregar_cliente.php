<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Agregar Cliente</title>
</head>

<body>
    <h1>Agregar Cliente</h1>

    <?php
    include 'conexion.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $direccion = $_POST['direccion'];
        $ciudad = $_POST['ciudad'];
        $pais = $_POST['pais'];
        $correo = $_POST['correo'];
        $telefono = $_POST['telefono'];

        $conexion = Conecta();
        $sql = "INSERT INTO Clientes (nombre, apellido, direccion, ciudad, pais, correo_electronico, telefono) VALUES ('$nombre', '$apellido', '$direccion', '$ciudad', '$pais', '$correo', '$telefono')";

        if (mysqli_query($conexion, $sql)) {
            echo "Cliente agregado correctamente.";
        } else {
            echo "Error al agregar el cliente: " . mysqli_error($conexion);
        }

        Desconectar($conexion);
    }
    ?>

    <form method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br><br>

        <label for="apellido">Apellido:</label>
        <input type="text" id="apellido" name="apellido" required><br><br>

        <label for="direccion">Dirección:</label>
        <input type="text" id="direccion" name="direccion"><br><br>

        <label for="ciudad">Ciudad:</label>
        <input type="text" id="ciudad" name="ciudad"><br><br>

        <label for="pais">País:</label>
        <input type="text" id="pais" name="pais"><br><br>

        <label for="correo">Correo Electrónico:</label>
        <input type="email" id="correo" name="correo"><br><br>

        <label for="telefono">Teléfono:</label>
        <input type="text" id="telefono" name="telefono"><br><br>

        <input type="submit" value="Guardar">
    </form>

    <a href="clientes.php"><button>Volver a Clientes</button></a>
</body>

</html>