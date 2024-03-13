<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Agregar Producto</title>
</head>

<body>
    <h2>Agregar Producto</h2>
    <form action="agregar_producto.php" method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br><br>

        <label for="descripcion">Descripción:</label>
        <input type="text" id="descripcion" name="descripcion"><br><br>

        <label for="precio">Precio:</label>
        <input type="number" id="precio" name="precio" min="0" step="0.01" required><br><br>

        <label for="cantidad_stock">Cantidad en stock:</label>
        <input type="number" id="cantidad_stock" name="cantidad_stock" min="0" required><br><br>

        <label for="imagen">URL de la Imagen:</label>
        <input type="url" id="imagen" name="imagen"><br><br>

        <input type="submit" value="Agregar Producto">
    </form>
    <a href="index.php"><button>Menu principal</button></a>

</body>

</html>




<?php
include 'conexion.php';

$conexion = Conecta();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $descripcion = $_POST["descripcion"];
    $precio = $_POST["precio"];
    $cantidad_stock = $_POST["cantidad_stock"];

    $sql = "INSERT INTO Productos (nombre, descripcion, precio, cantidad_stock) VALUES (?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ssdi", $nombre, $descripcion, $precio, $cantidad_stock);

    if ($stmt->execute()) {
        echo "Producto agregado correctamente.";
    } else {
        echo "Error al agregar el producto: " . $conexion->error;
    }

    $stmt->close();
}

Desconectar($conexion);
