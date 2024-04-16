<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Proveedor</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/styles.css">
    </head>

    <header id="formularios-header">
        <h1 id="titulo-formularios">Agregar Proveedor</h1>
        <a id="volver" href="proveedores.php">Volver</a>
    </header>
<body>
    
        

        <?php
        include '../DAL/conexion.php';

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nombre_proveedor = $_POST['nombre_proveedor'];
            $contacto_proveedor = $_POST['contacto_proveedor'];
            $email_proveedor = $_POST['email_proveedor'];
            $telefono_proveedor = $_POST['telefono_proveedor'];
            $direccion_proveedor = $_POST['direccion_proveedor'];

            $conexion = Conecta();
            $sql = "INSERT INTO Proveedores (nombre_proveedor, contacto_proveedor, email_proveedor, telefono_proveedor, direccion_proveedor) VALUES ('$nombre_proveedor', '$contacto_proveedor', '$email_proveedor', '$telefono_proveedor', '$direccion_proveedor')";

            if (mysqli_query($conexion, $sql)) {
                echo "Proveedor agregado correctamente.";
            } else {
                echo "Error al agregar el proveedor: " . mysqli_error($conexion);
            }

            Desconectar($conexion);
        }
        ?>
 <div class="container-formularios">
        <form method="post">
            <label for="nombre_proveedor">Nombre del Proveedor:</label>
            <input type="text" id="nombre_proveedor" name="nombre_proveedor" required><br><br>

            <label for="contacto_proveedor">Contacto del Proveedor:</label>
            <input type="text" id="contacto_proveedor" name="contacto_proveedor" required><br><br>

            <label for="email_proveedor">Correo Electrónico del Proveedor:</label>
            <input type="email" id="email_proveedor" name="email_proveedor" required><br><br>

            <label for="telefono_proveedor">Teléfono del Proveedor:</label>
            <input type="text" id="telefono_proveedor" name="telefono_proveedor" required><br><br>

            <label for="direccion_proveedor">Dirección del Proveedor:</label>
            <textarea id="direccion_proveedor" name="direccion_proveedor" required></textarea><br><br>

            <input type="submit" value="Agregar">
        </form>

        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../js/proveedores.js"></script>
</body>

</html>
