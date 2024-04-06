<?php
include '../DAL/conexion.php';

function obtenerCategorias()
{
    $conexion = Conecta();
    $consulta = "SELECT id_categoria, nombre_categoria FROM Categorias";
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

$categorias = obtenerCategorias();

if (!empty($categorias)) {
    echo '<ul>';
    foreach ($categorias as $categoria) {
        echo '<li>' . $categoria['nombre_categoria'];
    }
    echo '</ul>';
} else {
    echo '<p class="no-categories">No se encontraron categorías.</p>';
}
?>
