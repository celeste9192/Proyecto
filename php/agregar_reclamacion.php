<?php
include '../DAL/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idCliente = $_POST['id_cliente'];
    $motivo = $_POST['motivo'];
    $estado = $_POST['estado'];

    $conexion = Conecta();

    $insertarReclamacion = "INSERT INTO Reclamaciones (id_cliente, motivo, estado) VALUES ('$idCliente', '$motivo', '$estado')";

    if (mysqli_query($conexion, $insertarReclamacion)) {
        echo '<script>alert("Reclamación agregada exitosamente.");</script>';
    } else {
        echo '<script>alert("Error al agregar la reclamación: ' . mysqli_error($conexion) . '");</script>';
    }

    Desconectar($conexion);
}
?>




<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Reclamo</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<header id="formularios-header">
        <h1 id="titulo-formularios">Agregar Reclamo</h1>
        <a id="volver" href="reclamaciones.php">Volver</a>
    </header>
<body>
    
<div class="container-formularios">
    <form id="form-agregar-reclamacion" method="post">
        <label for="id_cliente">Cliente:</label>
        <input type="number" id="id_cliente" name="id_cliente" required><br><br>

        <label for="motivo">Motivo:</label>
        <textarea id="motivo" name="motivo" rows="4" required></textarea><br><br>

        <input type="submit" value="Agregar Reclamo">
    </form>
    </div>
   

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../js/ventas.js"></script>

</body>

</html>