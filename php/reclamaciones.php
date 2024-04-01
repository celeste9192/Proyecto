<?php
include 'conexion.php';

function obtenerReclamaciones()
{
    $conexion = Conecta();
    $consulta = "SELECT * FROM Reclamaciones";
    $resultado = mysqli_query($conexion, $consulta);

    $reclamaciones = array();

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        while ($fila = mysqli_fetch_assoc($resultado)) {
            $reclamaciones[] = $fila;
        }
    }

    Desconectar($conexion);

    return $reclamaciones;
}

$reclamaciones = obtenerReclamaciones();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reclamaciones</title>
    <link rel="stylesheet" href="css/style.css">
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
        }

        h1 {
            font-size: 36px;
            text-align: center;
            margin-bottom: 20px;
            text-transform: uppercase;
            position: relative;
        }

        h1::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 100%;
            height: 2px;
            background-color: #31241E;
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
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }

        .btn:hover {
            background-color: #31241E;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #31241E;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #31241E;
            color: #FFF;
            text-transform: uppercase;
        }

        .btn-editar {
            background-color: #4CAF50;
        }

        .btn-eliminar {
            background-color: #f44336;
        }

        td .btn {
            margin-right: 5px;
        }

        td .btn:hover {
            text-decoration: none;
        }
    </style>
</head>
<body>
    <h1>Reclamaciones</h1>
    <div>
        <table>
            <thead>
                <tr>
                    <th>ID Reclamación</th>
                    <th>ID Cliente</th>
                    <th>Motivo</th>
                    <th>Estado</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reclamaciones as $reclamacion) : ?>
                    <tr>
                        <td><?php echo $reclamacion['id_reclamacion']; ?></td>
                        <td><?php echo $reclamacion['id_cliente']; ?></td>
                        <td><?php echo $reclamacion['motivo']; ?></td>
                        <td><?php echo $reclamacion['estado']; ?></td>
                        <td><?php echo $reclamacion['fecha']; ?></td>
                        <td>
                            <a href="editar_reclamacion.php?id=<?php echo $reclamacion['id_reclamacion']; ?>" class="btn btn-editar">Editar</a>
                            <a href="eliminar_reclamacion.php?id=<?php echo $reclamacion['id_reclamacion']; ?>" onclick="return confirm('¿Está seguro de que desea eliminar esta reclamación?')" class="btn btn-eliminar">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <a href="index.php" class="btn">Volver al Menú Principal</a>
</body>
</html>
