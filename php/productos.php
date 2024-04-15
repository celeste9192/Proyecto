<?php
include '../DAL/conexion.php';

$conexion = Conecta();

$sql = "SELECT * FROM Productos";
$resultado = mysqli_query($conexion, $sql);

$productos = array();

while ($row = mysqli_fetch_assoc($resultado)) {
    $productos[] = $row;
}

echo json_encode($productos);

mysqli_free_result($resultado);
Desconectar($conexion);
?>
