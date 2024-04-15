<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Empleados</title>
    <link rel="stylesheet" href="../css/styles.css">
    
    
</head>
<body>
    <header>
        
        <h1 id="titulo">Empleados</h1>
    </header>
    
        <div class="btn-container">
            <a href="agregar_empleado.php"  id="btn-agregar">Agregar Empleado</a>
            <a href="eliminar_empleado.php" id="btn-eliminar">Eliminar Empleado</a>
            <a href="editar_empleado.php" id="btn-editar">Editar Empleado</a>


        </div>

        

        <?php
            include '../DAL/conexion.php';

            function leerEmpleados()
            {
                $conexion = Conecta();
                $sql = "SELECT * FROM Empleados";
                $resultado = mysqli_query($conexion, $sql);

                if ($resultado && mysqli_num_rows($resultado) > 0) {
                    echo "<h2>Listado de Empleados</h2>";
                    echo "<table id='tabla'>";
                    echo "<tr><th>ID</th><th>Nombre</th><th>Apellido</th><th>Email</th><th>Teléfono</th><th>Dirección</th><th>Imagen</th></tr>";

                    while ($fila = mysqli_fetch_assoc($resultado)) {
                        echo "<tr>";
                        echo "<td>" . $fila['id_empleado'] . "</td>";
                        echo "<td>" . $fila['nombre_empleado'] . "</td>";
                        echo "<td>" . $fila['apellido_empleado'] . "</td>";
                        echo "<td>" . $fila['email'] . "</td>";
                        echo "<td>" . $fila['telefono'] . "</td>";
                        echo "<td>" . $fila['direccion'] . "</td>";
                        echo "<td><img src='" . $fila['imagen'] . "' alt='Imagen de empleado' style='max-width: 100px;'></td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                } else {
                    echo "No se encontraron empleados.";
                }

                Desconectar($conexion);
            }

            leerEmpleados();
        ?>

<a href="index.php" id="btn-menu-principal" class="btn">Menu Principal</a>
    </div>
</body>
</html>