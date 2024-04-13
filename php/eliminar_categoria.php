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

// Manejar la eliminación de categoría
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['categoria_id'])) {
    $categoria_id = $_POST['categoria_id'];

    $conexion = Conecta();
    $consulta_eliminar = "DELETE FROM Categorias WHERE id_categoria = $categoria_id";

    if (mysqli_query($conexion, $consulta_eliminar)) {
        $mensaje = "Categoría eliminada correctamente.";
    } else {
        $mensaje = "Error al eliminar la categoría: " . mysqli_error($conexion);
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
    <title>Eliminar Categoría</title>
</head>
<body>
    <header>
        <h1>Eliminar Categoría</h1>
    </header>
    <div class="container">
        

        <form method="post" onsubmit="return confirmarEliminar();">
            <label for="categoria_id">Seleccione la categoría a eliminar:</label><br>
            <select id="categoria_id" name="categoria_id" required>
                <option value="">Seleccione una categoría</option>
                <?php foreach ($categorias as $categoria) : ?>
                    <option value="<?php echo $categoria['id_categoria']; ?>"><?php echo $categoria['nombre_categoria']; ?></option>
                <?php endforeach; ?>
            </select><br><br>
            <?php if (isset($mensaje)) : ?>
            <p><?php echo $mensaje; ?></p>
        <?php endif; ?>
            <p><button class="eliminar-cliente" onclick="eliminarCategoria(<?php echo $categoria['id_categoria']; ?>);">Eliminar Categoria</button></p>
        </form>
    </div>
    <a href="categorias.php"><button>Volver a Categorías</button></a>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../js/categorias.js"></script>
</body>
</html>
