<?php
include '../DAL/conexion.php';

// Realizar una consulta SQL para obtener todos los productos
$sql = "SELECT * FROM Productos";
$resultado = mysqli_query($conexion, $sql);

$productos = array();

// Iterar sobre los resultados y almacenarlos en un array
while ($row = mysqli_fetch_assoc($resultado)) {
    $productos[] = $row;
}

// Convertir el array de productos a formato JSON y devolverlo como respuesta
echo json_encode($productos);

// Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>
