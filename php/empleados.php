<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Empleados</title>
    <link rel="stylesheet" href="../css/styles.css">
    <style>
        <?php include '../css/empleados.css'; ?>
    </style>
</head>

<body>
    <header id="header">
        <h1>Empleados</h1>
    </header>

    <div id="container">
        <div class="btn-container">
            <a href="agregar_empleado.php" id="btn-agregar" class="btn">Agregar Empleado</a>
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
                echo "<tr><th>ID</th><th>Nombre</th><th>Apellido</th><th>Email</th><th>Teléfono</th><th>Dirección</th><th>Imagen</th><th>Acciones</th></tr>";

                while ($fila = mysqli_fetch_assoc($resultado)) {
                    echo "<tr>";
                    echo "<td>" . $fila['id_empleado'] . "</td>";
                    echo "<td>" . $fila['nombre_empleado'] . "</td>";
                    echo "<td>" . $fila['apellido_empleado'] . "</td>";
                    echo "<td>" . $fila['email'] . "</td>";
                    echo "<td>" . $fila['telefono'] . "</td>";
                    echo "<td>" . $fila['direccion'] . "</td>";
                    echo "<td><img src='" . $fila['imagen'] . "' alt='Imagen de empleado' class='imagen-empleado'></td>";
                    echo "<td><button class='btn-editar' data-id='" . $fila['id_empleado'] . "'>Editar</button> <button class='btn-eliminar' data-id='" . $fila['id_empleado'] . "'>Eliminar</button></td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "<p id='no-products-msg'>No se encontraron empleados.</p>";
            }

            Desconectar($conexion);
        }

        leerEmpleados();
        ?>

        <a href="index.php" id="btn-menu-principal" class="btn">Menu Principal</a>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="../js/empleados.js"></script>
    <script>
        $(document).ready(function() {
            $(document).on("click", ".btn-eliminar", function() {
                var empleadoId = $(this).data('id');
                if (confirm("¿Estás seguro de eliminar este empleado?")) {
                    eliminarEmpleado(empleadoId);
                }
            });

            $(document).on("click", ".btn-editar", function() {
                var empleadoId = $(this).data('id');
                window.location.href = "editar_empleado.php?empleadoId=" + empleadoId;
            });
        });

        function eliminarEmpleado(id) {
            $.ajax({
                type: "POST",
                url: "eliminar_empleado.php",
                data: { id_empleado: id, confirmar_eliminar: 1 },
                success: function(response) {
                    alert(response); // Maneja la respuesta según tu lógica
                    // Recargar la página o actualizar la lista de empleados si es necesario
                },
                error: function() {
                    alert("Error al comunicarse con el servidor.");
                }
            });
        }
    </script>
</body>

</html>
