<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Agregar Reabastecimiento</title>
    <style>
           body,h1,h2,h3,h4,h5,h6,p,ul,li,button,input,form,label {
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
        textarea {
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
</head>

<body>
<h1>Agregar Reabastecimiento</h1>

<?php
include '../DAL/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_producto = $_POST['id_producto'];
    $cantidad = $_POST['cantidad'];
    
    $estado = isset($_POST['estado']) ? $_POST['estado'] : 'Pendiente';

    $conexion = Conecta();
    $sql = "INSERT INTO ReabastecimientoStock (id_producto, cantidad, estado) VALUES ('$id_producto', '$cantidad', '$estado')";

    if (mysqli_query($conexion, $sql)) {
        echo "Reabastecimiento agregado correctamente.";
    } else {
        echo "Error al agregar el reabastecimiento: " . mysqli_error($conexion);
    }

    Desconectar($conexion);
}
?>

<form method="post">
    <label for="producto">Producto:</label>
    <select id="producto" name="id_producto" required>
        <option value="">Seleccionar producto</option>
        <?php
        
        $conexion = Conecta();
        $sql = "SELECT id_producto, nombre_producto FROM Productos";
        $resultado = mysqli_query($conexion, $sql);

        if ($resultado && mysqli_num_rows($resultado) > 0) {
            while ($fila = mysqli_fetch_assoc($resultado)) {
                echo "<option value='" . $fila['id_producto'] . "'>" . $fila['nombre_producto'] . "</option>";
            }
        } else {
            echo "<option value=''>No hay productos disponibles</option>";
        }

        Desconectar($conexion);
        ?>
    </select><br><br>

    <label for="cantidad">Cantidad a Reabastecer:</label>
    <input type="number" id="cantidad" name="cantidad" required><br><br>

    <input type="hidden" name="estado" value="Pendiente">

    <input type="submit" value="Agregar">
</form>

<a href="reabastecimiento.php"><button>Volver a Reabastecimiento</button></a>
</body>

</html>