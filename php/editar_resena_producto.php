<?php
include '../DAL/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_resena_producto = $_POST['id_resena_producto'];
    $id_producto = $_POST['id_producto'];
}

if (isset($_GET['id'])) {
    mysqli_stmt_bind_param($statement, "i", $id_resena_producto);
    mysqli_stmt_execute($statement);
    $resultado = mysqli_stmt_get_result($statement);
}

if (isset($_GET['id'])) {
    $id_resena_producto = $_GET['id'];
    $conexion = Conecta();
    $consulta = "SELECT * FROM ReseñasProducto WHERE id_resena_producto='$id_resena_producto'";
    $resultado = mysqli_query($conexion, $consulta);
}

if ($resultado && mysqli_num_rows($resultado) > 0) {
    $resena = mysqli_fetch_assoc($resultado);
}

if (isset($_GET['id'])) {
    mysqli_stmt_close($statement);
    Desconectar($conexion);
} else {
    echo "ID de reseña no proporcionado.";
    exit;
}
?>