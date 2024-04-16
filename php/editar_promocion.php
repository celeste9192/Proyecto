<?php
include '../DAL/conexion.php';


session_start();
$rol = $_SESSION['rol']; 

function obtenerPromocionPorId($idPromocion)
{
    $conexion = Conecta();
    $consulta = "SELECT * FROM Promociones WHERE id_promocion = $idPromocion";
    $resultado = mysqli_query($conexion, $consulta);

    $promocion = mysqli_fetch_assoc($resultado);

    Desconectar($conexion);

    return $promocion;
}


if (isset($_GET['id']) && isset($_GET['nombre'])) {
    $idPromocion = $_GET['id'];
    $nombrePromocion = $_GET['nombre'];

   
    $promocion = obtenerPromocionPorId($idPromocion);
} else {
   
    header("Location: promociones.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Promoción</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            color: #31241E;
            background-color: #F6F4F3;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #FFF;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 32px;
            margin-bottom: 20px;
            text-transform: uppercase;
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="date"],
        input[type="number"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #D1C8C1;
            border-radius: 5px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
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

        input[type="submit"]:hover {
            background-color: #31241E;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Editar Promoción: <?php echo $nombrePromocion; ?></h1>
        <form action="actualizar_promocion.php" method="POST">
            <input type="hidden" name="id_promocion" value="<?php echo $idPromocion; ?>">
            <label for="nombre">Nombre de la Promoción:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo $promocion['nombre_promocion']; ?>" required>

            <label for="descripcion">Descripción:</label>
            <input type="text" id="descripcion" name="descripcion" value="<?php echo $promocion['descripcion_promocion']; ?>" required>

            <label for="fecha_inicio">Fecha de Inicio:</label>
            <input type="date" id="fecha_inicio" name="fecha_inicio" value="<?php echo $promocion['fecha_inicio']; ?>" required>

            <label for="fecha_fin">Fecha de Fin:</label>
            <input type="date" id="fecha_fin" name="fecha_fin" value="<?php echo $promocion['fecha_fin']; ?>" required>

            <label for="descuento">Descuento (%):</label>
            <input type="number" id="descuento" name="descuento" value="<?php echo $promocion['descuento']; ?>" required>

            <input type="submit" value="Guardar Cambios">
        </form>
    </div>
</body>

</html>
