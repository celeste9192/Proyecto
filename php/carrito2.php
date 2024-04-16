<?php
include '../DAL/conexion.php';

session_start();

if (!isset($_SESSION['id_cliente'])) {
    header('Location: inicio_sesion.php');
    exit;
}

$conexion = Conecta();

$id_cliente = $_SESSION['id_cliente'];

if (isset($_POST['eliminarProducto'])) {
    $id_carrito = $_POST['eliminarProducto'];

    $query = "DELETE FROM Carrito WHERE id_carrito = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param('i', $id_carrito);
    $stmt->execute();

    echo json_encode(['status' => 'success']);
    exit;
}

if (isset($_POST['vaciarCarrito'])) {
    $query = "DELETE FROM Carrito WHERE id_cliente = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param('i', $id_cliente);
    $stmt->execute();

    echo json_encode(['status' => 'success']);
    exit;
}

if (isset($_POST['finalizarCompra'])) {
    $total = $_POST['total'];

    echo json_encode(['status' => 'confirm', 'total' => $total]);
    exit;
}

$query = "SELECT c.id_carrito, p.id_producto, p.nombre_producto, c.cantidad, c.precio_unitario, c.subtotal 
          FROM Carrito c 
          JOIN Productos p ON c.id_producto = p.id_producto 
          WHERE c.id_cliente = ?";

$stmt = $conexion->prepare($query);
$stmt->bind_param('i', $id_cliente);
$stmt->execute();
$resultado = $stmt->get_result();
$carrito = $resultado->fetch_all(MYSQLI_ASSOC);

$totalCarrito = 0;
foreach ($carrito as $item) {
    $totalCarrito += $item['subtotal'];
}

Desconectar($conexion);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Carrito de Compras</title>
    <link rel="stylesheet" href="../css/styles.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../js/carrito.js"></script>
</head>

<body>
    <header id="header">
        <h1>Carrito de Compras</h1>
    </header>

    <div id="container">
        <table id="tabla">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Subtotal</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($carrito as $item): ?>
                    <tr>
                        <td><?php echo $item['id_carrito']; ?></td>
                        <td><?php echo $item['nombre_producto']; ?></td>
                        <td><?php echo $item['cantidad']; ?></td>
                        <td><?php echo $item['precio_unitario']; ?></td>
                        <td><?php echo $item['subtotal']; ?></td>
                        <td>
                            <button class="eliminar-producto" data-id="<?php echo $item['id_carrito']; ?>">Eliminar</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" style="text-align: right;">Total:</td>
                    <td><?php echo number_format($totalCarrito, 2); ?></td>
                    <td>
                        <button id="vaciar-carrito">Vaciar Carrito</button>
                    </td>
                </tr>
            </tfoot>
        </table>

        <input type="hidden" id="totalCarrito" value="<?php echo $totalCarrito; ?>">
        <button id="finalizar-compra">Finalizar Compra</button>
    </div>

</body>

</html>
