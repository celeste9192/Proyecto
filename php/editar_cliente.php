<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Editar Cliente</title>
    
    
</head>

<header id="formularios-header">
        <h1 id="titulo-formularios">Editar Cliente</h1>
        <a id="volver" href="clientes.php">Volver</a>
    </header>
<body>

   

    <?php
    
    require_once '../DAL/conexion.php';

    
    if (isset($_GET['clienteId'])) {
        $clienteId = $_GET['clienteId'];

        
        $conexion = Conecta();
        $sql = "SELECT * FROM Clientes WHERE id_cliente = $clienteId";
        $resultado = mysqli_query($conexion, $sql);

        
        if ($resultado && mysqli_num_rows($resultado) > 0) {
            $cliente = mysqli_fetch_assoc($resultado);
           
            echo '<form id="editForm" method="POST">';
            echo '<input type="hidden" name="clienteId" value="' . $clienteId . '">';
            echo '<label for="nombre">Nombre:</label>';
            echo '<input type="text" id="nombre" name="nombre" value="' . $cliente['nombre_cliente'] . '"><br>';
            echo '<label for="apellido">Apellido:</label>';
            echo '<input type="text" id="apellido" name="apellido" value="' . $cliente['apellido_cliente'] . '"><br>';
            echo '<label for="email">Email:</label>';
            echo '<input type="email" id="email" name="email" value="' . $cliente['email'] . '"><br>';
            echo '<label for="telefono">Teléfono:</label>';
            echo '<input type="tel" id="telefono" name="telefono" value="' . $cliente['telefono'] . '"><br>';
            echo '<label for="direccion">Dirección:</label>';
            echo '<input type="text" id="direccion" name="direccion" value="' . $cliente['direccion'] . '"><br>';
            echo '<button type="submit" name="guardar">Guardar</button>';
            
            echo '</form>';
        } else {
            echo "Cliente no encontrado.";
        }

        
        Desconectar($conexion);
    } else {
       
        echo '<form id="searchForm" action="" method="GET">';
        echo '<label for="clienteId">ID del Cliente:</label>';
        echo '<input type="text" id="clienteId" name="clienteId">';
        echo '<button type="submit">Buscar</button>';
        echo '</form>';
    }

   
    if (isset($_POST['guardar'])) {
        
        $clienteId = $_POST['clienteId'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $email = $_POST['email'];
        $telefono = $_POST['telefono'];
        $direccion = $_POST['direccion'];

       
        $conexion = Conecta();
        $sql = "UPDATE Clientes SET nombre_cliente='$nombre', apellido_cliente='$apellido', email='$email', telefono='$telefono', direccion='$direccion' WHERE id_cliente=$clienteId";
        $resultado = mysqli_query($conexion, $sql);

        
        if ($resultado) {
            echo "<p>Los datos del cliente se han actualizado correctamente.</p>";
        } else {
            echo "<p>Error al actualizar los datos del cliente: " . mysqli_error($conexion) . "</p>";
        }

        
        Desconectar($conexion);
    }
    ?>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="../js/clientes.js"></script>

</body>
</html>
