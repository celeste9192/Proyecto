<?php

include '../DAL/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_compra']) && !isset($_POST['confirmar_eliminar'])) {
    $id_compra = $_POST['id_compra'];

    $conexion = Conecta();
    $sql = "SELECT * FROM Compras WHERE id_compra = ?";
    $stmt = mysqli_prepare($conexion, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $id_compra);
        mysqli_stmt_execute($stmt);
        $resultado = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($resultado) > 0) {
            $compra = mysqli_fetch_assoc($resultado);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Eliminar Compra</title>
</head>

<body>
    <div class="container">
        <h1>Eliminar Compra:</h1>
        <p>Compra:</p>
        <p>Proveedor: <?php echo $compra['id_proveedor']; ?></p>
        <p>Detalles: <?php echo $compra['detalles']; ?></p>
        <p>Fecha: <?php echo $compra['fecha_compra']; ?></p>
        <p>Total: <?php echo $compra['total_compra']; ?></p>
        <p><button class="eliminar-compra" onclick="eliminarCompra(<?php echo $compra['id_compra']; ?>);">Eliminar Compra</button></p>
    </div>

    <a href="compras.php"><button>Volver a Compras</button></a>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../js/compras.js"></script>

</body>

</html>

<?php

        } else {
            echo json_encode(array("success" => false, "message" => "No se encontró la compra."));
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "<p>Error en la preparación de la consulta: " . mysqli_error($conexion) . "</p>";
    }

    Desconectar($conexion);

} elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirmar_eliminar'])) {
    $id_compra = $_POST['id_compra'];

    $conexion = Conecta();
    $sql = "DELETE FROM Compras WHERE id_compra = ?";
    $stmt = mysqli_prepare($conexion, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $id_compra);
        
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
    <title>Eliminar Compra</title>
</head>

<body>

    <form method="post">
        <label for="id_compra">Numero de Compra:</label>
        <input type="number" id="id_compra" name="id_compra" required><br><br>

        <input type="submit" value="Eliminar">
    </form>

    <a href="compras.php"><button>Volver a Compras</button></a>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../js/compras.js"></script>

</body>

</html>

<?php
}
?>

