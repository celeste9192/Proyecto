<?php
include '../DAL/conexion.php';

function obtenerOrden_del_Dia()
{
    $conexion = Conecta();
    $consulta = "SELECT * FROM orden_del_dia";
    $resultado = mysqli_query($conexion, $consulta);

    $orden_del_dia = array();

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        while ($fila = mysqli_fetch_assoc($resultado)) {
            $orden_del_dia[] = $fila;
        }
    }

    Desconectar($conexion);

    return $orden_del_dia;
}

$orden_del_dia = obtenerOrden_del_Dia();

echo json_encode($orden_del_dia);
?>
