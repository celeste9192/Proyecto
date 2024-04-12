<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proveedores</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body>
    <div class="container">
        <h1>Proveedores</h1>

        <?php
        include '../DAL/conexion.php';

        function mostrarProveedores()
        {
            $conexion = Conecta();
            $sql = "SELECT * FROM Proveedores";
            $resultado = mysqli_query($conexion, $sql);

            if ($resultado && mysqli_num_rows($resultado) > 0) {
                echo "<h2>Listado de Proveedores</h2>";
                echo "<table>";
                echo "<tr><th>ID</th><th>Nombre</th><th>Contacto</th><th>Email</th><th>Teléfono</th><th>Dirección</th></tr>";

                while ($fila = mysqli_fetch_assoc($resultado)) {
                    echo "<tr>";
                    echo "<td>" . $fila['id_proveedor'] . "</td>";
                    echo "<td>" . $fila['nombre_proveedor'] . "</td>";
                    echo "<td>" . $fila['contacto_proveedor'] . "</td>";
                    echo "<td>" . $fila['email_proveedor'] . "</td>";
                    echo "<td>" . $fila['telefono_proveedor'] . "</td>";
                    echo "<td>" . $fila['direccion_proveedor'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "No se encontraron proveedores.";
            }

            Desconectar($conexion);
        }

        mostrarProveedores();
        ?>

        <div class="btn-container">
            <a href="agregar_proveedor.php" class="btn">Agregar Proveedor</a>
            <a href="eliminar_proveedor.php" class="btn">Eliminar Proveedor</a>
            <a href="editar_proveedor.php" class="btn">Editar Proveedor</a>
        </div>

        <a href="index.php" class="btn">Menu Principal</a>
    </div>
</body>

</html>
