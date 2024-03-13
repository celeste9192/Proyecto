<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Eliminar Cliente</title>
    <script>
        function confirmarEliminar() {
            return confirm("¿Está seguro de que desea eliminar este cliente?");
        }
    </script>
</head>

<body>
    <h1>Eliminar Cliente</h1>

    <?php
    include 'conexion.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['cliente_id'])) {
        $cliente_id = $_POST['cliente_id'];

        if ($cliente_id < 0) {
            echo "Error: El ID del cliente no puede ser negativo.";
        } else {
            $conexion = Conecta();
            $sql = "DELETE FROM Clientes WHERE cliente_id = $cliente_id";

            if (mysqli_query($conexion, $sql)) {
                echo "Cliente eliminado correctamente.";
            } else {
                echo "Error al eliminar el cliente: " . mysqli_error($conexion);
            }

            Desconectar($conexion);
        }
    }
    ?>

    <form method="post" onsubmit="return confirmarEliminar();">
        <label for="cliente_id">ID del Cliente a Eliminar:</label>
        <input type="number" id="cliente_id" name="cliente_id" required><br><br>

        <input type="submit" value="Eliminar">
    </form>

    <a href="clientes.php"><button>Volver a Clientes</button></a>
</body>

</html>