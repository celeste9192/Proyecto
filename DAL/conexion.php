<?php

function Conecta()
{
    $server = "localhost";
    $user = "root";
    $password = "";
    $database = "electric";

    $conexion = mysqli_connect($server, $user, $password, $database);

    if (!$conexion) {
        echo "Ocurrió un problema al establecer la conexión " . mysqli_connect_error();
    }
    return $conexion;
}

function Desconectar($conexion)
{
    mysqli_close($conexion);
}
