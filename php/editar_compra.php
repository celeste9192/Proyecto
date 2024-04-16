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

   
    function limpiarDatos($dato)
    {
        return htmlspecialchars(stripslashes(trim($dato)));
    }

    
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_compra'])) {
        $id_compra = limpiarDatos($_POST['id_compra']);

       
        $conexion = Conecta();

      
        $sql = "SELECT * FROM Compras WHERE id_compra = $id_compra";
        $resultado = mysqli_query($conexion, $sql);

        if ($resultado && mysqli_num_rows($resultado) > 0) {
            $compra = mysqli_fetch_assoc($resultado);

            echo '<form id="editForm" method="POST" action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '">';
            echo '<input type="hidden" name="id_compra" value="' . $id_compra . '">';
            echo '<label for="id_proveedor">Proveedor:</label>';
            echo '<input type="number" id="id_proveedor" name="id_proveedor" value="' . ($compra['id_proveedor'] ?? '') . '"><br>';
            echo '<label for="detalles">Detalles:</label>';
            echo '<input type="text" id="detalles" name="detalles" value="' . ($compra['detalles'] ?? '') . '"><br>';
            echo '<label for="fecha">Fecha:</label>';
            echo '<input type="datetime-local" id="fecha" name="fecha" value="' . date('Y-m-d\TH:i', strtotime($compra['fecha'] ?? '')) . '" required><br>';
            echo '<label for="total">Total:</label>';
            echo '<input type="number" id="total" name="total" value="' . ($compra['total'] ?? '') . '"><br>';
            echo '<input type="submit" name="guardar" value="Guardar Cambios">';
            echo '</form>';
        } else {
            echo "No se encontró la compra.";
        }

        Desconectar($conexion);
    } elseif (isset($_POST['guardar'])) {
        echo "<p>Faltan datos para procesar.</p>";
    } else {
        echo '<form method="post">';
        echo '<label for="id_compra">Número de Compra a Editar:</label>';
        echo '<input type="number" id="id_compra" name="id_compra" required><br><br>';
        echo '<input type="submit" value="Buscar">';
        echo '</form>';
    }
    ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../js/compras.js"></script>
</body>

</html>
