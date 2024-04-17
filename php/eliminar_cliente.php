<?php
include '../DAL/conexion.php';

if(isset($_POST['id_cliente']) && !isset($_POST['confirmar_eliminar'])) {
    $id_cliente = $_POST['id_cliente'];

    $conexion = Conecta();
    $sql = "SELECT * FROM Clientes WHERE id_cliente = '$id_cliente'";
    $resultado = mysqli_query($conexion, $sql);

    if(mysqli_num_rows($resultado) > 0) {
        $cliente = mysqli_fetch_assoc($resultado);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Cliente</title>
    <link rel="stylesheet" href="../css/styles.css"> 
</head>
<body>
<div class="container">
    <h1>Eliminar Cliente</h1>
    <p>Cliente:</p>
    <p>ID: <?php echo $cliente['id_cliente']; ?></p>
    <p>Nombre: <?php echo $cliente['nombre_cliente']; ?></p>
    <p>Apellido: <?php echo $cliente['apellido_cliente']; ?></p>
    <p>Email: <?php echo $cliente['email']; ?></p>
    <p>Teléfono: <?php echo $cliente['telefono']; ?></p>
    <p>Dirección: <?php echo $cliente['direccion']; ?></p>
    <p><button class="eliminar-cliente" onclick="eliminarCliente(<?php echo $cliente['id_cliente']; ?>);">Eliminar Cliente</button></p>

</div>
<a href="clientes.php"><button>Volver a Clientes</button></a>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="../js/clientes.js"></script>

</body>
</html>

<?php
    } else {
        echo json_encode(array("success" => false, "message" => "Cliente no encontrado."));
    }

    Desconectar($conexion);
} elseif(isset($_POST['confirmar_eliminar'])) {
    $id_cliente = $_POST['id_cliente'];

    $conexion = Conecta();
    $sql = "DELETE FROM Clientes WHERE id_cliente = '$id_cliente'";
    $resultado = mysqli_query($conexion, $sql);

    if($resultado) {
        echo json_encode(array("success" => true, "message" => "Cliente eliminado correctamente."));
    } else {
        echo json_encode(array("success" => false, "message" => "Error al eliminar cliente."));
    }

    Desconectar($conexion);
} else {
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Cliente</title>
    <link rel="stylesheet" href="../css/styles.css"> 
</head>
<body>
<div class="container">
    <h1>Eliminar Cliente</h1>
    
</div>
<a href="clientes.php"><button>Volver a Clientes</button></a>
</body>
</html>

<?php
}
?>
