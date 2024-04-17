<?php
include '../DAL/conexion.php';

session_start();

if (!isset($_SESSION['id_cliente'])) {
    header('Location: inicio_sesion.php');
    exit;
}

$conexion = Conecta();

$id_cliente = $_SESSION['id_cliente'];
$total = $_GET['total'];

$id_empleado = 1;  

$query = "INSERT INTO Venta (id_cliente, id_empleado, total) VALUES (?, ?, ?)";
$stmt = $conexion->prepare($query);
$stmt->bind_param('iid', $id_cliente, $id_empleado, $total);

try {
    $stmt->execute();
} catch (mysqli_sql_exception $e) {
    die("Error al insertar la venta: " . $e->getMessage());
}

$query = "DELETE FROM Carrito WHERE id_cliente = ?";
$stmt = $conexion->prepare($query);
$stmt->bind_param('i', $id_cliente);

try {
    $stmt->execute();
} catch (mysqli_sql_exception $e) {
    die("Error al vaciar el carrito: " . $e->getMessage());
}

Desconectar($conexion);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Confirmar Compra</title>
    <link rel="stylesheet" href="../css/styles.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../js/categorias.js"></script>
</head>

<body>
    <header id="header">
        <h1>Compra Confirmada</h1>
    </header>

    <div id="container">
        <p>Tu compra ha sido confirmada.</p>
        <a href="index.php" id="btn-menu-principal">Volver al inicio</a>
    </div>

</body>

</html>
