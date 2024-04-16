<?php
include '../DAL/conexion.php';


$conexion = Conecta();
$sql_categorias = "SELECT id_categoria, nombre_categoria FROM Categorias";
$resultado = $conexion->query($sql_categorias);
$categorias = array();
if ($resultado->num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        $categorias[] = $row;
    }
}
Desconectar($conexion);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $descripcion = $_POST["descripcion"];
    $precio = $_POST["precio"];
    $id_categoria = $_POST["id_categoria"]; 
    $imagen = $_POST["imagen"]; 

    $conexion = Conecta();
    $sql = "INSERT INTO Productos (nombre_producto, descripcion_producto, precio, id_categoria, imagen) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ssdis", $nombre, $descripcion, $precio, $id_categoria, $imagen);
    
    if ($stmt->execute()) {
        echo "<script>alert('Producto agregado correctamente.'); window.location.href = 'index.php';</script>";
    } else {
        echo "Error al agregar el producto: " . $stmt->error;
    }

    $stmt->close();
    Desconectar($conexion);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Producto</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<header id="formularios-header">
        <h1 id="titulo-formularios">Agregar Producto</h1>
        <a id="volver" href="productos.php">Volver</a>
    </header>
<body>
<div class="container-formularios">
    <form action="agregar_producto.php" method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br><br>

        <label for="descripcion">Descripción:</label>
        <input type="text" id="descripcion" name="descripcion"><br><br>

        <label for="precio">Precio:</label>
        <input type="number" id="precio" name="precio" min="0" step="0.01" required><br><br>

        <label for="id_categoria">Categoría:</label>
        <select id="id_categoria" name="id_categoria">
            <?php foreach ($categorias as $categoria) : ?>
                <option value="<?php echo $categoria['id_categoria']; ?>"><?php echo $categoria['nombre_categoria']; ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <label for="imagen">URL de la Imagen:</label>
        <input type="url" id="imagen" name="imagen"><br><br>

        <input type="submit" value="Agregar Producto">
    </form>
    </div>
    
</body>
</html>