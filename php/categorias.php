<?php
include '../DAL/conexion.php';

function obtenerCategorias()
{
    $conexion = Conecta();
    $consulta = "SELECT * FROM Categorias";
    $resultado = mysqli_query($conexion, $consulta);

    $categorias = array();

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        while ($fila = mysqli_fetch_assoc($resultado)) {
            $categorias[] = $fila;
        }
    }

    Desconectar($conexion);

    return $categorias;
}

function mostrarCategorias()
{
    $categorias = obtenerCategorias();

    if (!empty($categorias)) {
        echo "<h2>Listado de Categorías</h2>";
        echo "<ul>";
        foreach ($categorias as $categoria) {
            echo "<li>ID: " . $categoria['id_categoria'] . " - Nombre: " . $categoria['nombre_categoria'] . "</li>";
        }
        echo "</ul>";
    } else {
        echo "<p class='no-categories'>No se encontraron categorías.</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>  Categorías</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="../css/styles.css">
    
    <script>
        $(document).ready(function() {
            $.ajax({
                url: "obtener_categorias.php",
                method: "GET",
                success: function(data) {
                    $("#categorias-container").html(data);
                }
            });
        });
    </script>
</head>

<body>
    <header id="titulo">
        <h1>Categorías</h1>
    </header>
    <div class="container" id="container">
        <div class="btn-container" id="btn-container">
            <a href="agregar_categoria.php" class="btn" id="btn-agregar">Agregar Categoría</a>
            <a href="eliminar_categoria.php" class="btn" id="btn-eliminar">Eliminar Categoría</a>
            <a href="editar_categoria.php" class="btn" id="btn-editar">Editar Categoría</a>
        </div>
        <div id="categorias-container">
            <?php mostrarCategorias(); ?>
        </div>
    </div>
    <a href="index.php" class="btn" id="btn-menu-principal">Menú Principal</a>
</body>

</html>

