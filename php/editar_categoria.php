<?php
include '../DAL/conexion.php';

// Obtener la lista de categorías disponibles
$conexion = Conecta();
$consulta_categorias = "SELECT * FROM Categorias";
$resultado_categorias = mysqli_query($conexion, $consulta_categorias);
$categorias = [];

if ($resultado_categorias && mysqli_num_rows($resultado_categorias) > 0) {
    while ($row = mysqli_fetch_assoc($resultado_categorias)) {
        $categorias[] = $row;
    }
}

// Inicializar la variable del mensaje de éxito
$mensaje_exito = "";

// Manejar la búsqueda y edición de categoría
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['categoria_id'])) {
    $categoria_id = $_POST['categoria_id'];

    $consulta = "SELECT * FROM Categorias WHERE id_categoria = $categoria_id";
    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        $categoria = mysqli_fetch_assoc($resultado);
        $nombre_categoria = $categoria['nombre_categoria'];
    } else {
        $nombre_categoria = "";
    }
} else {
    $nombre_categoria = "";
}

// Manejar la actualización de categoría
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['actualizar']) && $_POST['actualizar'] == 'Actualizar Categoría') {
    $categoria_id = $_POST['categoria_id'];
    $nombre_categoria = $_POST['nombre_categoria'];

    $conexion = Conecta();
    $consulta_actualizar = "UPDATE Categorias SET nombre_categoria='$nombre_categoria' WHERE id_categoria = $categoria_id";

    if (mysqli_query($conexion, $consulta_actualizar)) {
        // Establecer el mensaje de éxito
        $mensaje_exito = "Categoría actualizada correctamente.";
    } else {
        echo "Error al actualizar la categoría: " . mysqli_error($conexion);
    }

    Desconectar($conexion);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Editar Categoría</title>
</head>
<body>
    <h1>Editar Categoría</h1>
    <div class="container">
        <form id="buscarCategoriaForm" action="" method="POST">
            <label for="categoria_id">Seleccione una categoría:</label><br>
            <select id="categoria_id" name="categoria_id" required>
                <option value="">Seleccione una categoría</option>
                <?php foreach ($categorias as $categoria) : ?>
                    <option value="<?php echo $categoria['id_categoria']; ?>"><?php echo $categoria['nombre_categoria']; ?></option>
                <?php endforeach; ?>
            </select><br><br>
            <input type="submit" value="Buscar">
        </form>

        <div id="resultadoCategoria" style="display: <?php echo $nombre_categoria ? 'block' : 'none'; ?>;">
           
            <form id="editarCategoriaForm" action="" method="POST">
                <label for="nombre_categoria">Nombre de la Categoría:</label><br>
                <input type="text" id="nombre_categoria" name="nombre_categoria" value="<?php echo $nombre_categoria; ?>" required><br><br>
                <input type="hidden" name="categoria_id" value="<?php echo $_POST['categoria_id']; ?>">
                <?php if ($mensaje_exito) : ?>
                <p><?php echo $mensaje_exito; ?></p>
            <?php endif; ?>
                <input type="submit" name="actualizar" value="Actualizar Categoría">
            </form>
        </div>
    </div>

    <a href="categorias.php"><button>Volver a Categorías</button></a>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../js/categorias.js"></script>
</body>
</html>
