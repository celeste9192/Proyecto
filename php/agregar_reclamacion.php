<?php
include '../DAL/conexion.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idCliente = $_SESSION['id_cliente'];
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
        <p>ID del Cliente: <?php echo $_SESSION['id_cliente']; ?></p>
        <p>Nombre y Apellido del Cliente: <?php echo $_SESSION['nombre_cliente']; ?></p>
        <form id="form-agregar-reclamacion" method="post">
            <label for="motivo">Motivo:</label>
            <textarea id="motivo" name="motivo" rows="4" required></textarea><br><br>
            <input type="hidden" id="id_cliente" name="id_cliente" value="<?php echo $_SESSION['id_cliente']; ?>">
            <input type="hidden" name="estado" value="Pendiente">
        </form>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../js/ventas.js"></script>
</body>

</html>
