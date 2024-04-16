<?php
include '../DAL/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['nombre_categoria']) && !empty($_POST['nombre_categoria'])) {
        $nombre_categoria = $_POST['nombre_categoria'];

        $conexion = Conecta();

        $consulta = "INSERT INTO Categorias (nombre_categoria) VALUES ('$nombre_categoria')";

        if (mysqli_query($conexion, $consulta)) {
            $mensaje = "La categoría se agregó correctamente.";
        } else {
            $error = "Error al agregar la categoría: " . mysqli_error($conexion);
        }

        Desconectar($conexion);
    } else {
        $error = "Por favor, ingrese el nombre de la categoría.";
    }
}

if (isset($mensaje)) {
    echo $mensaje;
} elseif (isset($error)) {
    echo $error;
}
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Agregar Categoría</title>
</head>

<body>
    <header id="formularios-header">
        <h1>Agregar Categoría</h1>
        <a id="volver" href="categorias.php">Volver</a>
    </header>
    <div class="container-formularios>
        <form id="agregarCategoriaForm" method="post" action="agregar_categoria.php">
            <label for="nombre_categoria">Nombre de la Categoría:</label><br>
            <input type="text" id="nombre_categoria" name="nombre_categoria"><br><br>
            <input type="submit" value="Agregar Categoría">
        </form>

        <div id="mensaje">
            <?php if (isset($mensaje)) : ?>
                <p><?php echo $mensaje; ?></p>
            <?php endif; ?>

            <?php if (isset($error)) : ?>
                <p><?php echo $error; ?></p>
            <?php endif; ?>
        </div>
    </div>

    

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../js/categorias.js"></script>
</body>

</html>
