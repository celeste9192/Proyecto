<?php
include '../DAL/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];
    $imagen = $_POST['imagen'];

 
    $conexion = Conecta();

    
    $sql = "INSERT INTO Clientes (nombre_cliente, apellido_cliente, email, telefono, direccion, imagen) VALUES ('$nombre', '$apellido', '$email', '$telefono', '$direccion', '$imagen')";

    
    if (mysqli_query($conexion, $sql)) {
        
        echo "Cliente agregado correctamente.";
    } else {
        
        echo "Error al agregar el cliente: " . mysqli_error($conexion);
    }

    
    Desconectar($conexion);
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Cliente</title>
    <link rel="stylesheet" href="../css/styles.css">
    
</head>
<body>
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

    <label for="imagen">URL de la Imagen:</label>
    <input type="text" id="imagen" name="imagen"><br><br>

    <input type="submit" value="Guardar">
</form>

<a href="clientes.php"><button>Volver a Clientes</button></a>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="../js/clientes.js"></script>
</body>
</html>
