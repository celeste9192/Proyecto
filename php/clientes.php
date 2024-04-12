<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes</title>
    <link rel="stylesheet" href="../css/styles.css">
   
</head>
<body>
<div class="container">
    <h1>Clientes</h1>

    <?php
    include '../DAL/conexion.php';

    function leerClientes()
    {
        $conexion = Conecta();
        $sql = "SELECT * FROM Clientes";
        $resultado = mysqli_query($conexion, $sql);

        if ($resultado && mysqli_num_rows($resultado) > 0) {
            echo "<h2>Listado de Clientes</h2>";
            echo "<table>";
            echo "<tr><th>ID</th><th>Nombre</th><th>Apellido</th><th>Email</th><th>Teléfono</th><th>Dirección</th><th>Imagen</th></tr>";

            while ($fila = mysqli_fetch_assoc($resultado)) {
                echo "<tr>";
                echo "<td>" . $fila['id_cliente'] . "</td>";
                echo "<td>" . $fila['nombre_cliente'] . "</td>";
                echo "<td>" . $fila['apellido_cliente'] . "</td>";
                echo "<td>" . $fila['email'] . "</td>";
                echo "<td>" . $fila['telefono'] . "</td>";
                echo "<td>" . $fila['direccion'] . "</td>";
                echo "<td><img src='" . $fila['imagen'] . "' alt='Imagen de cliente' style='max-width: 100px;'></td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "No se encontraron clientes.";
        }

        Desconectar($conexion);
    }

    ?>
    
    <div class="btn-container">
        <a href="agregar_cliente.php" class="btn">Agregar Cliente</a>
        <a href="eliminar_cliente.php" class="btn">Eliminar Cliente</a>
        <a href="editar_cliente.php" class="btn">Editar Cliente</a>
    </div>

    <?php leerClientes(); ?>
</div>
</body>
</html>
