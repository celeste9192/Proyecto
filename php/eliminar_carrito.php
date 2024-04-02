<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Eliminar Carrito</title>
    <style>
        body,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p,
        ul,
        li,
        button,
        input,
        form,
        label {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            color: #31241E;
            background-color: #F6F4F3;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
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
    <script>
        function confirmarEliminar() {
            return confirm("¿Está seguro de que desea eliminar el carrito?");
        }
    </script>
</head>

<body>
    <h1>Eliminar Carrito</h1>

    <?php
    include 'conexion.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_carrito'])) {
        $id_carrito = $_POST['id_carrito'];

        if ($id_carrito < 0) {
            echo "Error: El numero es negativo.";
        } 
        else {
            $conexion = Conecta();
            $sql = "DELETE FROM Carrito WHERE id_carrito = $id_carrito";

            if (mysqli_query($conexion, $sql)) {
                echo "Carrito eliminado.";
            } else {
                echo "Error al eliminar: " . mysqli_error($conexion);
            }

            Desconectar($conexion);
        }
    }
    ?>

    <form method="post" onsubmit="return confirmarEliminar();">
        <label for="id_carrito">Numero de Carrito:</label>
        <input type="number" id="id_carrito" name="id_carrito" required><br><br>

        <input type="submit" value="Eliminar">
    </form>

    <a href="carrito.php"><button>Volver a Carrito</button></a>
</body>

</html>