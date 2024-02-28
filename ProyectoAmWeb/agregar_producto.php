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
