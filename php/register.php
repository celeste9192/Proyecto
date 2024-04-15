<?php
include '../DAL/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email_reg'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];
    $password = $_POST['password_reg'];  
    $rol = 'cliente';

    $conn = Conecta();

    $stmt = $conn->prepare("SELECT id_cliente FROM Clientes WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "Ya existe un usuario con ese correo electrónico.";
    } else {
        $stmt = $conn->prepare("INSERT INTO Clientes (nombre_cliente, apellido_cliente, rol, pass, email, telefono, direccion, imagen) VALUES (?, ?, ?, ?, ?, ?, ?, '')");
        $stmt->bind_param("sssssss", $nombre, $apellido, $rol, $password, $email, $telefono, $direccion);
        $stmt->execute();

        echo "Usuario creado correctamente.";
    }

    $stmt->close();
    Desconectar($conn);
}
?>
