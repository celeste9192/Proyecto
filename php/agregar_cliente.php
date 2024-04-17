<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Cliente</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/agregar_cliente_styles.css">
</head>
<body>
    <header id="formularios-header">
        <h1>Agregar cliente</h1>
        <a id="volver" href="categorias.php">Volver</a>
    </header>
    <div id="container">
        <h1>Agregar Cliente</h1>
        <form id="form-agregar-cliente" method="post">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required><br><br>

            <label for="apellido">Apellido:</label>
            <input type="text" id="apellido" name="apellido" required><br><br>

            <label for="email">Correo Electrónico:</label>
            <input type="email" id="email" name="email"><br><br>

            <label for="telefono">Teléfono:</label>
            <input type="text" id="telefono" name="telefono"><br><br>

            <label for="direccion">Dirección:</label>
            <input type="text" id="direccion" name="direccion"><br><br>

            <label for="rol">Rol:</label>
            <input type="text" id="rol" name="rol"><br><br>

            <label for="pass">Contraseña:</label>
            <input type="text" id="pass" name="pass"><br><br>

            <label for="imagen">URL de la Imagen:</label>
            <input type="text" id="imagen" name="imagen"><br><br>

            <input type="submit" value="Guardar">
        </form>

        <a href="clientes.php"><button>Volver a Clientes</button></a>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../js/clientes.js"></script>
</body>
</html>

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        include '../DAL/conexion.php';
        
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $email = $_POST['email'];
        $telefono = $_POST['telefono'];
        $direccion = $_POST['direccion'];
        $rol = $_POST['rol'];
        $pass = $_POST['pass'];
        $imagen = $_POST['imagen'];
        
        $conexion = Conecta();
        
        $sql = "INSERT INTO Clientes (nombre_cliente, apellido_cliente, email, telefono, direccion, rol, pass, imagen) 
                VALUES ('$nombre', '$apellido', '$email', '$telefono', '$direccion', '$rol', '$pass', '$imagen')";
        
        if (mysqli_query($conexion, $sql)) {
            echo "<script>alert('Cliente guardado correctamente.');</script>";
        } else {
            echo "<script>alert('Error al guardar el cliente: " . mysqli_error($conexion) . "');</script>";
        }
        
        Desconectar($conexion);
    }
?>
