
<?php
/* Este archivo tampoco se utiliza
include '../DAL/conexion.php';

function obtenerDetallesVenta()
{
    $conexion = Conecta();
    $sql = "SELECT dv.id_detalle_venta, dv.id_venta, p.nombre_producto, dv.cantidad, dv.precio_unitario, dv.subtotal 
            FROM DetalleVenta dv 
            JOIN Productos p ON dv.id_producto = p.id_producto";
    $stmt = $conexion->prepare($sql);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        echo "<h2 id='subtitulo'>Listado de Detalles de Ventas</h2>";
        echo "<div id='container'>";
        echo "<table id='tabla'>";
        echo "<tr><th>Número de Detalle</th><th>Producto</th><th>Cantidad</th><th>Precio Unitario</th><th>Subtotal</th><th>Acciones</th></tr>";

        while ($fila = mysqli_fetch_assoc($resultado)) {
            echo "<tr>";
            echo "<td>" . $fila['id_detalle_venta'] . "</td>";
            echo "<td>" . $fila['nombre_producto'] . "</td>";
            echo "<td>" . $fila['cantidad'] . "</td>";
            echo "<td>" . $fila['precio_unitario'] . "</td>";
            echo "<td>" . $fila['subtotal'] . "</td>";
            echo "<td><button onclick='eliminarDetallesVenta(" . $fila['id_detalle_venta'] . ")'>Eliminar</button></td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "</div>";
    } else {
        echo "<p id='no-products-msg'>No se encontraron detalles de ventas.</p>";
    }

    Desconectar($conexion);
}

?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de Venta</title>
    <link rel="stylesheet" href="../css/styles.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<header>
    <h1>Detalles de Venta</h1>
</header>
<div class="container">
    <div class="btn-container">
        <a href="editar_detalle_venta.php" class="btn">Editar Detalle de Venta</a>
    </div>

    <?php obtenerDetallesVenta(); ?>
    
    <a href="index.php" class="btn">Menú Principal</a>
</div>
<script>
    function eliminarDetallesVenta(id) {
        if(confirm("¿Estás seguro que quiere eliminar los detalles de la venta?")) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "eliminar_detallesventa.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if(xhr.readyState === XMLHttpRequest.DONE) {
                    if(xhr.status === 200) {
                        var response = JSON.parse(xhr.responseText);
                        if(response.success) {
                            alert(response.message);
                            location.reload();
                        } else {
                            alert(response.message);
                        }
                    } else {
                        alert("Error al comunicarse con el servidor.");
                    }
                }
            };
            xhr.send("id_detalle_venta=" + id + "&confirmar_eliminar=1");
        }
    }
</script>
</body>
</html>
