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

    $id_empleado = 1;
    $queryVenta = "INSERT INTO Venta (id_cliente, id_empleado, fecha, total) VALUES (?, ?, NOW(), ?)";
    $stmtVenta = $conexion->prepare($queryVenta);
    $stmtVenta->bind_param('iid', $id_cliente, $id_empleado, $total);
    $stmtVenta->execute();

    $id_venta = $stmtVenta->insert_id;

    $query = "SELECT c.id_carrito, p.id_producto, p.nombre_producto, c.cantidad, c.precio_unitario, c.subtotal 
              FROM Carrito c 
              JOIN Productos p ON c.id_producto = p.id_producto 
              WHERE c.id_cliente = ?";

    $stmt = $conexion->prepare($query);
    $stmt->bind_param('i', $id_cliente);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $carrito = $resultado->fetch_all(MYSQLI_ASSOC);

    foreach ($carrito as $item) {
        $queryDetalle = "INSERT INTO DetalleVenta (id_venta, id_producto, cantidad, precio_unitario, subtotal) VALUES (?, ?, ?, ?, ?)";
        $stmtDetalle = $conexion->prepare($queryDetalle);
        $stmtDetalle->bind_param('iiidd', $id_venta, $item['id_producto'], $item['cantidad'], $item['precio_unitario'], $item['subtotal']);
        $stmtDetalle->execute();
    }

    $query = "DELETE FROM Carrito WHERE id_cliente = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param('i', $id_cliente);
    $stmt->execute();

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

if (empty($carrito)) {
    echo json_encode(['status' => 'empty', 'totalCarrito' => 0]);
} else {
    echo json_encode(['status' => 'success', 'carrito' => $carrito, 'totalCarrito' => $totalCarrito]);
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            color: #31241E;
            background-color: #F6F4F3;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        header {
            background-color: #F6F4F3;
            padding: 20px;
            border-bottom: 1px solid #31241E;
            text-align: center;
        }

        h1 {
            font-size: 36px;
            margin-bottom: 20px;
            text-transform: uppercase;
        }

        .btn-container {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .btn-container a {
            margin: 0 10px;
            text-decoration: none;
        }

        .btn {
            padding: 10px 20px;
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

        .btn:hover {
            background-color: #31241E;
        }

        #tabla {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        #tabla th,
        #tabla td {
            border: 1px solid #31241E;
            padding: 10px;
            text-align: left;
        }

        #tabla th {
            background-color: #31241E;
            color: #FFF;
            text-transform: uppercase;
        }

        #tabla td button {
            padding: 8px 16px;
            border: none;
            border-radius: 5px;
            background-color: #D1C8C1;
            color: #FFF;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        #tabla td button:hover {
            background-color: #31241E;
        }

        #tabla tfoot {
            background-color: #D1C8C1;
            color: #FFF;
        }

        #tabla tfoot button {
            background-color: #31241E;
        }

    </style>
</head>

<body>
    <header id="header">
        <h1>Carrito de Compras</h1>
    </header>

    <div class="container">
        <div class="btn-container">
            <a href="index.php" class="btn">Ir a Index</a>
        </div>

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
                        <button id="vaciar-carrito" class="btn">Vaciar Carrito</button>
                    </td>
                </tr>
            </tfoot>
        </table>

        <input type="hidden" id="totalCarrito" value="<?php echo $totalCarrito; ?>">
        <button id="finalizar-compra" class="btn">Finalizar Compra</button>
    </div>

    <div class="modal" id="eliminar-modal">
        <div class="modal-content">
            <h2>Eliminar Producto</h2>
            <p>¿Estás seguro de que deseas eliminar este producto del carrito?</p>
            <input type="hidden" id="id_producto" name="id_producto">
            <button id="eliminar-producto-btn" class="btn">Eliminar</button>
            <button class="btn" id="cancelar-eliminar">Cancelar</button>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.eliminar-producto').click(function() {
                var idProducto = $(this).data('id');
                $('#id_producto').val(idProducto);
                $('#eliminar-modal').modal();
            });

            $('#eliminar-producto-btn').click(function() {
                var idProducto = $('#id_producto').val();

                $.ajax({
                    url: 'carrito.php',
                    type: 'POST',
                    data: { eliminarProducto: idProducto },
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            location.reload();
                        }
                    },
                    error: function(error) {
                        alert("Error al eliminar el producto: " + error);
                    }
                });
            });

            $('#vaciar-carrito').click(function() {
                $.ajax({
                    url: 'carrito.php',
                    type: 'POST',
                    data: { vaciarCarrito: true },
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            location.reload();
                        }
                    },
                    error: function(error) {
                        alert("Error al vaciar el carrito: " + error);
                    }
                });
            });

            $('#finalizar-compra').click(function() {
                var total = $('#totalCarrito').val();

                $.ajax({
                    url: 'carrito.php',
                    type: 'POST',
                    data: { finalizarCompra: true, total: total },
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'confirm') {
                            var confirmar = confirm("El total de la compra es: $" + response.total + ". ¿Desea continuar con la compra?");
                            if (confirmar) {
                                alert("Compra finalizada con éxito");
                            }
                        }
                    },
                    error: function(error) {
                        alert("Error al finalizar la compra: " + error);
                    }
                });
            });
        });
    </script>
</body>

</html>
