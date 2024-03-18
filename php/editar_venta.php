<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Editar Venta</title>
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
</head>

<body>
    <h1>Editar Venta</h1>

    <?php
    include 'conexion.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset ($_POST['id_venta'])) {
        $id_venta = $_POST['id_venta'];

        $conexion = Conecta();
        $sql = "SELECT * FROM Ventas WHERE id_venta = $id_venta";
        $resultado = mysqli_query($conexion, $sql);

        if ($resultado && mysqli_num_rows($resultado) > 0) {
            $cliente = mysqli_fetch_assoc($resultado);
        } else {
            echo "No se encontró la venta.";
            exit;
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset ($_POST['editar'])) {
            $id_venta = $_POST['id_venta'];
            $id_cliente = $_POST['id_cliente'];
            $id_empleado = $_POST['id_empleado'];
            $fecha = $_POST['fecha'];
            $total = $_POST['total'];

            $sql = "INSERT INTO Ventas VALUES ($id_venta, $id_cliente, $id_empleado, $fecha, $total)";
            if (mysqli_query($conexion, $sql)) {
                echo "Venta editada correctamente.";
            } else {
                echo "Error al editar venta: " . mysqli_error($conexion);
            }
        }

        Desconectar($conexion);
    }
    ?>

    <form method="post">
        <label for="id_venta">Numero de Venta a Editar:</label>
        <input type="number" id="id_venta" name="id_venta" required><br><br>
        <input type="submit" value="Buscar">
    </form>

    <?php if (isset ($venta)): ?>
        <form method="post">
            <input type="hidden" name="id_venta" value="<?php echo $venta['id_venta']; ?>">

            <label for="id_venta">Numero de Venta:</label>
            <input type="number" id="id_venta" name="id_venta" value="<?php echo $venta['id_venta']; ?>" required><br><br>

            <label for="id_cliente">ID Cliente:</label>
            <input type="number" id="id_cliente" name="id_cliente" value="<?php echo $venta['id_cliente']; ?>"
                required><br><br>

            <label for="id_empleado">ID Empleado:</label>
            <input type="number" id="id_empleado" name="id_empleado" value="<?php echo $venta['id_empleado']; ?>"
                required><br><br>

            <label for="fecha">Fecha:</label>
            <input type="date" id="fecha" name="fecha" value="<?php echo $venta['fecha']; ?>" required><br><br>

            <label for="total">Total:</label>
            <input type="number" id="total" name="total" value="<?php echo $venta['total']; ?>" required><br><br>

            <input type="submit" name="editar" value="Editar">
        </form>
    <?php endif; ?>

    <a href="ventas.php"><button>Volver a Ventas</button></a>
</body>

</html>