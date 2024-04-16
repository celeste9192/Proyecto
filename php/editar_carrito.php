<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Editar Carrito</title>
    <link rel="stylesheet" href="../css/styles.css">
  
</head>
<header id="formularios-header">
        <h1 id="titulo-formularios">Editar Carrito</h1>
        <a id="volver" href="carrito.php">Volver</a>
    </header>
<body>


<?php
include '../DAL/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_carrito'])) {
    $id_carrito = $_POST['id_carrito'];

    $conexion = Conecta();
    $sql = "SELECT * FROM Carrito WHERE id_carrito = $id_carrito";
    $resultado = mysqli_query($conexion, $sql);

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        $carrito = mysqli_fetch_assoc($resultado);
    } else {
        echo "No se encontró el carrito.";
        exit;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['editar'])) {
        $id_carrito = $_POST['id_carrito'];
        $id_cliente = $_POST['id_cliente'];
        $id_producto = $_POST['id_producto'];
        $cantidad = $_POST['cantidad'];
        $precio_unitario = $_POST['precio_unitario'];
        $subtotal = $_POST['subtotal'];

        $sql = "UPDATE Carrito SET id_cliente = $id_cliente, id_producto = $id_producto, cantidad = $cantidad, precio_unitario = $precio_unitario, subtotal = $subtotal WHERE id_carrito = $id_carrito";
        if (mysqli_query($conexion, $sql)) {
            echo "Carrito editado correctamente.";
        } else {
            echo "Error al editar carrito: " . mysqli_error($conexion);
        }
    }

    Desconectar($conexion);
}
?>

<form method="post">
    <label for="id_carrito">Numero de Carrito a Editar:</label>
    <input type="number" id="id_carrito" name="id_carrito" required><br><br>
    <input type="submit" value="Buscar">
</form>

<?php if (isset($carrito)): ?>
    <form method="post">
        <input type="hidden" name="id_carrito" value="<?php echo $carrito['id_carrito']; ?>">

        <label for="id_cliente">ID Cliente:</label>
        <input type="number" id="id_cliente" name="id_cliente" value="<?php echo $carrito['id_cliente']; ?>" required><br><br>

        <label for="id_producto">ID Producto:</label>
        <input type="number" id="id_producto" name="id_producto" value="<?php echo $carrito['id_producto']; ?>" required><br><br>

        <label for="cantidad">Cantidad:</label>
        <input type="number" id="cantidad" name="cantidad" value="<?php echo $carrito['cantidad']; ?>" required><br><br>

        <label for="precio_unitario">Precio Unitario:</label>
        <input type="number" id="precio_unitario" name="precio_unitario" value="<?php echo $carrito['precio_unitario']; ?>" required><br><br>

        <label for="subtotal">Subtotal:</label>
        <input type="number" id="subtotal" name="subtotal" value="<?php echo $carrito['subtotal']; ?>" required><br><br>

        <input type="submit" name="editar" value="Editar">
    </form>
<?php endif; ?>

</body>

</html>