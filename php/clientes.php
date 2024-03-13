<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes</title>
</head>

<body>
    <h1>Clientes</h1>

    <a href="agregar_cliente.php"><button>Agregar Cliente</button></a>
    <a href="eliminar_cliente.php"><button>Eliminar Cliente</button></a>
    <a href="editar_cliente.php"><button>Editar Cliente</button></a>

    <?php
    include 'conexion.php';

    function leerClientes()
    {
        $conexion = Conecta();
        $sql = "SELECT * FROM Clientes";
        $resultado = mysqli_query($conexion, $sql);

        if ($resultado && mysqli_num_rows($resultado) > 0) {
            echo "<h2>Listado de Clientes</h2>";
            echo "<table border='1'>";
            echo "<tr><th>ID</th><th>Nombre</th><th>Apellido</th><th>Dirección</th><th>Ciudad</th><th>País</th><th>Correo Electrónico</th><th>Teléfono</th></tr>";

            while ($fila = mysqli_fetch_assoc($resultado)) {
                echo "<tr>";
                echo "<td>" . $fila['cliente_id'] . "</td>";
                echo "<td>" . $fila['nombre'] . "</td>";
                echo "<td>" . $fila['apellido'] . "</td>";
                echo "<td>" . $fila['direccion'] . "</td>";
                echo "<td>" . $fila['ciudad'] . "</td>";
                echo "<td>" . $fila['pais'] . "</td>";
                echo "<td>" . $fila['correo_electronico'] . "</td>";
                echo "<td>" . $fila['telefono'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "No se encontraron clientes.";
        }

        Desconectar($conexion);
    }

    leerClientes();
    ?>
</body>

</html>