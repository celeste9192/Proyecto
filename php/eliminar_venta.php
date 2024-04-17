<?php

include '../DAL/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_venta']) && !isset($_POST['confirmar_eliminar'])) {
    $id_venta = $_POST['id_venta'];

    $conexion = Conecta();
    $sql = "SELECT * FROM Venta WHERE id_venta = ?";
    $stmt = mysqli_prepare($conexion, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $id_venta);
        mysqli_stmt_execute($stmt);
        $resultado = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($resultado) > 0) {
            $venta = mysqli_fetch_assoc($resultado);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Eliminar Venta</title>
</head>

<body>
    <div class="container">
        <h1>Eliminar Venta:</h1>
        <p>Venta:</p>
        <p>Cliente: <?php echo $venta['id_cliente']; ?></p>
        <p>Empleado: <?php echo $venta['id_empleado']; ?></p>
        <p>Fecha: <?php echo $venta['fecha']; ?></p>
        <p>Total: <?php echo $venta['total']; ?></p>
        <p><button class="eliminar-venta" onclick="eliminarVenta(<?php echo $venta['id_venta']; ?>);">Eliminar Venta</button></p>
    </div>

    <a href="ventas.php"><button>Volver a Ventas</button></a>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../js/ventas.js"></script>

</body>

</html>

<?php
        } else {
            echo json_encode(array("success" => false, "message" => "No se encontró la venta."));
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "<p>Error en la preparación de la consulta: " . mysqli_error($conexion) . "</p>";
    }

    Desconectar($conexion);

} elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirmar_eliminar'])) {
    $id_venta = $_POST['id_venta'];

    $conexion = Conecta();
    $sql = "DELETE FROM Venta WHERE id_venta = ?";
    $stmt = mysqli_prepare($conexion, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $id_venta);
        
        if (mysqli_stmt_execute($stmt)) {
            echo json_encode(array("success" => true, "message" => "Se eliminó correctamente."));
        } else {
            echo json_encode(array("success" => false, "message" => "Error al eliminar."));
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "<p>Error en la preparación de la consulta: " . mysqli_error($conexion) . "</p>";
    }

    Desconectar($conexion);
} else {
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Eliminar Venta</title>
</head>

<body>

    <form method="post">
        <label for="id_venta">Numero de Venta:</label>
        <input type="number" id="id_venta" name="id_venta" required><br><br>

        <input type="submit" value="Eliminar">
    </form>

    <a href="ventas.php"><button>Volver a Ventas</button></a>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../js/ventas.js"></script>

</body>

</html>

<?php
}
?>
