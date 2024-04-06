<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Proveedores</title>
    <style>
           body {
            font-family: 'Poppins', sans-serif;
            color: #31241E;
            background-color: #F6F4F3;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        header {
            background-color: #F6F4F3;
            padding: 20px;
            border-bottom: 1px solid #31241E;
        }

        h1 {
            font-size: 36px;
            text-align: center;
            margin-bottom: 20px;
            text-transform: uppercase;
        }

        .btn-container {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .btn-container a {
            margin: 0 10px;
            text-decoration: none;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #D1C8C1;
            color: #FFF;
            font-family: 'Montserrat', sans-serif;
            font-weight: bold;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #31241E;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #31241E;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #31241E;
            color: #FFF;
            text-transform: uppercase;
        }

        td a {
            color: #31241E;
            font-weight: bold;
            text-decoration: none;
        }

        td a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <header>
        <h1>Proveedores</h1>
    </header>
    <div class="container">
        <div class="btn-container">
            <a href="agregar_proveedor.php" class="btn">Agregar Proveedor</a>
            <a href="eliminar_proveedor.php" class="btn">Eliminar Proveedor</a>
            <a href="editar_proveedor.php" class="btn">Editar Proveedor</a>
        </div>

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

        <a href="index.php" class="btn">Menu Principal</a>
    </div>
</body>

</html>
