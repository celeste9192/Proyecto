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

$categorias = obtenerCategorias();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorías</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            color: #31241E;
            background-color: #F6F4F3;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        header {
            background-color: #F6F4F3;
            padding: 20px;
            border-bottom: 1px solid #31241E;
            text-align: center;
        }

        h1 {
            font-size: 36px;
            margin-bottom: 20px;
            text-transform: uppercase;
        }

        .btn-container {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .btn-container a {
            margin: 0 10px;
            text-decoration: none;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #D1C8C1;
            color: #FFF;
            font-family: 'Montserrat', sans-serif;
            font-weight: bold;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #31241E;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            margin-bottom: 10px;
            background-color: #FFF;
            border: 1px solid #D1C8C1;
            border-radius: 5px;
            padding: 10px;
        }

        .no-categories {
            text-align: center;
            margin-top: 20px;
        }
    </style>
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
    <header>
        <h1>Categorías</h1>
    </header>
    <div class="container">
        <div class="btn-container">
            <a href="agregar_categoria.php" class="btn">Agregar Categoría</a>
            <a href="eliminar_categoria.php" class="btn">Eliminar Categoría</a>
            <a href="editar_categoria.php" class="btn">Editar Categoría</a>
        </div>
        <div id="categorias-container"></div>
    </div>
    <a href="index.php" class="btn">Menu Principal</a>
</body>

</html>