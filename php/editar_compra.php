<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Editar Compra</title>
</head>

<body>

    <header id="formularios-header">
        <h1 id="titulo-formularios">Editar Compra</h1>
        <a id="volver" href="compras.php">Volver</a>
    </header>

    <?php
    include '../DAL/conexion.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id_compra = $_POST['id_compra'] ?? '';
        $id_proveedor = $_POST['id_proveedor'] ?? '';
        $detalles = $_POST['detalles'] ?? '';
        $fecha = $_POST['fecha'] ?? '';
        $total = $_POST['total'] ?? '';
        
        if (!empty($id_compra) && !empty($id_proveedor) && !empty($detalles) && !empty($fecha) && !empty($total)) {
            $conexion = Conecta();
            $sql = "UPDATE Compras SET id_proveedor=?, detalles=?, fecha_compra=?, total_compra=? WHERE id_compra=?";
            
            $stmt = mysqli_prepare($conexion, $sql);
            
            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "isssi", $id_proveedor, $detalles, $fecha, $total, $id_compra);
                
                if (mysqli_stmt_execute($stmt)) {
                    echo "<p>La compra se actualizó correctamente.</p>";
                } else {
                    echo "<p>Error al actualizar la compra: " . mysqli_error($conexion) . "</p>";
                }
                
                mysqli_stmt_close($stmt);
            } else {
                echo "<p>Error en la preparación de la consulta: " . mysqli_error($conexion) . "</p>";
            }

            Desconectar($conexion);
        } else {
            echo "<p>Por favor, completa todos los campos.</p>";
        }
        
    } else {
        echo '<form method="post">';
        echo '<label for="id_compra">Número de Compra a Editar:</label>';
        echo '<input type="number" id="id_compra" name="id_compra" required><br><br>';
        echo '<label for="id_proveedor">Proveedor:</label>';
        echo '<input type="number" id="id_proveedor" name="id_proveedor" required><br><br>';
        echo '<label for="detalles">Detalles:</label>';
        echo '<input type="text" id="detalles" name="detalles" required><br><br>';
        echo '<label for="fecha">Fecha:</label>';
        echo '<input type="datetime-local" id="fecha" name="fecha" required><br><br>';
        echo '<label for="total">Total:</label>';
        echo '<input type="number" id="total" name="total" required><br><br>';
        echo '<input type="submit" value="Guardar Cambios">';
        echo '</form>';
    }
    ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../js/compras.js"></script>
    
</body>

</html>
