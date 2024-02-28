<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Producto</title>
</head>
<body>
    <h2>Agregar Producto</h2>
    <form action="agregar_producto.php" method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br><br>
        
        <label for="descripcion">Descripción:</label>
        <input type="text" id="descripcion" name="descripcion"><br><br>
        
        <label for="precio">Precio:</label>
        <input type="number" id="precio" name="precio" min="0" step="0.01" required><br><br>
        
        <label for="cantidad_stock">Cantidad en stock:</label>
        <input type="number" id="cantidad_stock" name="cantidad_stock" min="0" required><br><br>
        
        <input type="submit" value="Agregar Producto">
    </form>
</body>
</html>
