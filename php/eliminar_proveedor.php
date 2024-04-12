<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Proveedor</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body>
    <header>
        <h1>Eliminar Proveedor</h1>
        <nav>
            <ul>
                <li><a href="proveedores.php">Volver a Proveedores</a></li>
            </ul>
        </nav>
    </header>

    <div class="container">
        <?php
        include '../DAL/conexion.php';

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id_proveedor = $_POST['id_proveedor'];

            $conexion = Conecta();
            $sql = "DELETE FROM Proveedores WHERE id_proveedor = $id_proveedor";

            if (mysqli_query($conexion, $sql)) {
                echo "Proveedor eliminado correctamente.";
            } else {
                echo "Error al eliminar el proveedor: " . mysqli_error($conexion);
            }

            Desconectar($conexion);
        }
        ?>

        <form method="post" onsubmit="return confirmarEliminar()">
            <label for="id_proveedor">ID del Proveedor a Eliminar:</label>
            <input type="text" id="id_proveedor" name="id_proveedor" required><br><br>
            <input type="submit" value="Eliminar">
        </form>
    </div>

    <script>
        function confirmarEliminar() {
            return confirm("¿Está seguro de que desea eliminar este proveedor?");
        }
    </script>
</body>

</html>
