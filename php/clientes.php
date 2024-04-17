<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <h1 id="titulo">Clientes</h1>

    <?php
    include '../DAL/conexion.php';

    function leerClientes()
    {
        $conexion = Conecta();
        $sql = "SELECT * FROM Clientes";
        $resultado = mysqli_query($conexion, $sql);

        if ($resultado && mysqli_num_rows($resultado) > 0) {
            echo "<h2 id='subtitulo'>Listado de Clientes</h2>";
            echo "<table id='tabla'>";
            echo "<tr><th>ID</th><th>Nombre</th><th>Apellido</th><th>Email</th><th>Teléfono</th><th>Dirección</th><th>Rol</th><th>Imagen</th><th>Acciones</th></tr>";

            while ($fila = mysqli_fetch_assoc($resultado)) {
                echo "<tr>";
                echo "<td>" . $fila['id_cliente'] . "</td>";
                echo "<td>" . $fila['nombre_cliente'] . "</td>";
                echo "<td>" . $fila['apellido_cliente'] . "</td>";
                echo "<td>" . $fila['email'] . "</td>";
                echo "<td>" . $fila['telefono'] . "</td>";
                echo "<td>" . $fila['direccion'] . "</td>";
                echo "<td>" . $fila['rol'] . "</td>";
                echo "<td>"; 

                
                if (!empty($fila['imagen'])) {
                    echo "<img src='" . $fila['imagen'] . "' alt='Imagen del cliente' width='100'>";
                } else {
                    echo "Sin imagen";
                }

                echo "</td>"; 

                echo "<td>"; 

                echo "<div class='btn-group'>";
                echo "<a href='editar_cliente.php?clienteId=" . $fila['id_cliente'] . "' class='btn btn-editar'>Editar</a>"; 
                echo "<button class='btn btn-eliminar' data-cliente-id='" . $fila['id_cliente'] . "' data-cliente-nombre='" . $fila['nombre_cliente'] . "'>Eliminar</button>";
                echo "</div>";

                echo "</td>"; 
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "No se encontraron clientes.";
        }

        Desconectar($conexion);
    }

    ?>
    
    <div id="btn-container">
        <a href="agregar_cliente.php" id="btn-agregar">Agregar Cliente</a>
        <a href="index.php" id="btn-menu-principal" class="btn">Menú Principal</a>
    </div>

    <?php leerClientes(); ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $(document).on("click", ".btn-eliminar", function() {
                var clienteId = $(this).data('cliente-id');
                var clienteNombre = $(this).data('cliente-nombre');
                
                if (confirm("¿Estás seguro de eliminar al cliente " + clienteNombre + "?")) {
                    eliminarCliente(clienteId);
                }
            });
        });

        function eliminarCliente(clienteId) {
            $.ajax({
                type: "POST",
                url: "eliminar_cliente.php",
                data: { id_cliente: clienteId, confirmar_eliminar: 1 },
                success: function(response) {
                    var jsonResponse = JSON.parse(response);
                    if (jsonResponse.success) {
                        alert(jsonResponse.message);
                        location.reload();
                    } else {
                        alert(jsonResponse.message);
                    }
                },
                error: function() {
                    alert("Error al comunicarse con el servidor.");
                }
            });
        }
    </script>
</body>
</html>
