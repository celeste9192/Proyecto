<?php
include '../DAL/conexion.php';

$conn = Conecta();

if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id_cliente, nombre_cliente, rol, pass FROM Clientes WHERE email = ?");
    
  
    if ($stmt === false) {
        die("Error de preparación de consulta: " . $conn->error);
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id_cliente, $nombre_cliente, $rol, $hashed_password);

    if ($stmt->num_rows > 0 && $stmt->fetch()) {
        echo "Hash guardado en la base de datos: " . $hashed_password . "<br>";
        echo "Contraseña ingresada: " . $password . "<br>";
        
        if ($password === $hashed_password) {  
            session_start();
            $_SESSION['id_cliente'] = $id_cliente;
            $_SESSION['nombre_cliente'] = $nombre_cliente;
            $_SESSION['rol'] = $rol;
            header("Location: index.php");
        } else {
            echo "La contraseña no coincide.";
        }
    } else {
        echo "Correo electrónico o contraseña incorrectos.";
    }

    $stmt->close();
    Desconectar($conn);
}
?>
