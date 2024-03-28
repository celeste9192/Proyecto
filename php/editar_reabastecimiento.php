<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Editar Reabastecimiento</title>
    <style>
        body,h1,h2,h3,h4,h5,h6,p,ul,li,button,input,form,label,select {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            color: #31241E;
            background-color: #F6F4F3;
        }

        h1,h2,h3,h4,h5,h6 {
            font-family: 'Montserrat', sans-serif;
            font-weight: bold;
        }

        header {
            background-color: #F6F4F3;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #31241E;
        }

        h1 {
            font-size: 36px;
            text-transform: uppercase;
        }

        nav ul {
            list-style-type: none;
            padding: 0;
        }

        nav ul li {
            display: inline-block;
            margin-right: 20px;
        }

        nav ul li a {
            text-decoration: none;
            font-family: 'Montserrat', sans-serif;
            font-weight: bold;
            font-size: 16px;
            color: #31241E;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="number"],
        input[type="email"],
        input[type="url"],
        textarea,
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #D1C8C1;
        }

        input[type="submit"],
        button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #D1C8C1;
            color: #FFF;
            font-family: 'Montserrat', sans-serif;
            font-weight: bold;
            font-size: 18px;
            cursor: pointer;
        }

        button {
            background-color: transparent;
            color: #31241E;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        ul {
            margin-top: 20px;
            padding-left: 20px;
        }

        ul li {
            margin-bottom: 20px;
        } 
    </style>
    <script>
        function confirmarEditar() {
            return confirm("¿Está seguro de que desea editar este reabastecimiento?");
        }
    </script>
</head>

<body>

    <h1>Editar Reabastecimiento</h1>

    <form method="get">
        <label for="id_reabastecimiento">ID del Reabastecimiento a Editar:</label>
        <input type="text" id="id_reabastecimiento" name="id_reabastecimiento" required><br><br>
        <input type="submit" value="Buscar">
    </form>

    <?php
    include 'conexion.php';

    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id_reabastecimiento'])) {
        $id_reabastecimiento = $_GET['id_reabastecimiento'];

        $conexion = Conecta();
        $sql = "SELECT * FROM ReabastecimientoStock WHERE id_reabastecimiento = $id_reabastecimiento";
        $resultado = mysqli_query($conexion, $sql);

        if ($resultado && mysqli_num_rows($resultado) > 0) {
            $fila = mysqli_fetch_assoc($resultado);
            $id_producto = $fila['id_producto'];
            $cantidad = $fila['cantidad'];

            
            $sql_productos = "SELECT id_producto, nombre_producto FROM Productos";
            $resultado_productos = mysqli_query($conexion, $sql_productos);

            echo "<form method='post' onsubmit='return confirmarEditar()'>";
            echo "<input type='hidden' name='id_reabastecimiento' value='$id_reabastecimiento'>";
            echo "<label for='producto'>Producto:</label>";
            echo "<select id='producto' name='id_producto' required>";
            while ($fila_producto = mysqli_fetch_assoc($resultado_productos)) {
                $selected = ($fila_producto['id_producto'] == $id_producto) ? 'selected' : '';
                echo "<option value='" . $fila_producto['id_producto'] . "' $selected>" . $fila_producto['nombre_producto'] . "</option>";
            }
            echo "</select><br><br>";
            echo "<label for='cantidad'>Cantidad a Reabastecer:</label>";
            echo "<input type='number' id='cantidad' name='cantidad' value='$cantidad' required><br><br>";
            echo "<input type='submit' value='Actualizar'>";
            echo "</form>";
        } else {
            echo "No se encontró ningún reabastecimiento con el ID proporcionado.";
        }

        Desconectar($conexion);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id_reabastecimiento = $_POST['id_reabastecimiento'];
        $id_producto = $_POST['id_producto'];
        $cantidad = $_POST['cantidad'];

        $conexion = Conecta();
        $sql = "UPDATE ReabastecimientoStock SET id_producto = '$id_producto', cantidad = '$cantidad' WHERE id_reabastecimiento = $id_reabastecimiento";

        if (mysqli_query($conexion, $sql)) {
            echo "Reabastecimiento actualizado correctamente.";
        } else {
            echo "Error al actualizar el reabastecimiento: " . mysqli_error($conexion);
        }

        Desconectar($conexion);
    }
    ?>

    <a href="reabastecimiento.php"><button>Volver a Reabastecimiento</button></a>
</body>

</html>
