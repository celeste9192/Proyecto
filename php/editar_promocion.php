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
    </head>

    
<body>
<header id="formularios-header">
        <h1 id="titulo-formularios">Editar Promoción</h1>
        <a id="volver" href="promociones.php">Volver</a>
    </header>
    
        
       
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
