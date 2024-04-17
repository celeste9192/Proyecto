<?php
include '../DAL/conexion.php';

// Suponiendo que tienes una función para verificar el rol del usuario
session_start();
$rol = $_SESSION['rol']; // Obtén el rol del usuario desde la sesión

function obtenerPromociones()
{
    $conexion = Conecta();
    $consulta = "SELECT * FROM Promociones";
    $resultado = mysqli_query($conexion, $consulta);

    $promociones = array();

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        while ($fila = mysqli_fetch_assoc($resultado)) {
            $promociones[] = $fila;
        }
    }

    Desconectar($conexion);

    return $promociones;
}

$promociones = obtenerPromociones();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Promociones</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

        .promo-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .promo-card {
            background-color: #FFF;
            border: 1px solid #D1C8C1;
            border-radius: 5px;
            padding: 20px;
            position: relative;
        }

        .promo-card h2 {
            margin-bottom: 10px;
            font-size: 24px;
        }

        .promo-card p {
            margin-bottom: 10px;
        }

        .promo-card button {
            padding: 8px 16px;
            margin-right: 10px;
            border: none;
            border-radius: 5px;
            background-color: #D1C8C1;
            color: #FFF;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .promo-card button:hover {
            background-color: #31241E;
        }

        .no-promo {
            text-align: center;
            margin-top: 20px;
        }

        .edit-promo-btn {
            position: absolute;
            top: 10px;
            right: 10px;
        }
    </style>
</head>

<body>
    <header>
        <h1>Promociones</h1>
        <a id="volver" href="index.php">Volver</a>
    </header>
    <div class="container">
        <div class="btn-container">
            <?php if ($rol == 'administrador') : ?>
                <a href="agregar_promocion.php" class="btn">Agregar Promoción</a>
            <?php endif; ?>
            
        </div>

        <div class="promo-container" id="promociones-container">
            <?php if (!empty($promociones)) : ?>
                <?php foreach ($promociones as $promocion) : ?>
                    <div class="promo-card" data-id="<?php echo $promocion['id_promocion']; ?>">
                        <h2><?php echo $promocion['nombre_promocion']; ?></h2>
                        <p><?php echo $promocion['descripcion_promocion']; ?></p>
                        <p>Fecha de Inicio: <?php echo $promocion['fecha_inicio']; ?></p>
                        <p>Fecha de Fin: <?php echo $promocion['fecha_fin']; ?></p>
                        <p>Descuento: <?php echo $promocion['descuento']; ?>%</p>
                        <?php if ($rol == 'administrador') : ?>
                            <button class="eliminar-promocion-btn" data-id="<?php echo $promocion['id_promocion']; ?>">Eliminar</button>
                            <button class="edit-promo-btn">Editar</button>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p class="no-promo">No hay promociones disponibles.</p>
            <?php endif; ?>
        </div>
    </div>

    <div class="modal" id="eliminar-modal">
        <div class="modal-content">
            <h2>Eliminar Promoción</h2>
            <p>¿Estás seguro de que deseas eliminar esta promoción?</p>
            <input type="hidden" id="id_promocion" name="id_promocion">
            <button id="eliminar-promocion-btn">Eliminar</button>
            <button class="btn" id="cancelar-eliminar">Cancelar</button>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.eliminar-promocion-btn').click(function() {
                var idPromocion = $(this).data('id');
                $('#id_promocion').val(idPromocion);
                $('#eliminar-modal').modal();
            });

            $('#eliminar-promocion-btn').click(function() {
                var idPromocion = $('#id_promocion').val();
                $.ajax({
                    url: 'eliminar_promocion.php',
                    method: 'POST',
                    data: {
                        id_promocion: idPromocion
                    },
                    success: function(response) {
                        if (response.trim() === 'ok') {
                            window.location.reload();
                        } else {
                            alert('Error al eliminar la promoción.');
                        }
                    }
                });
            });

            $('#cancelar-eliminar').click(function() {
                $.modal.close();
            });

            $('.edit-promo-btn').click(function() {
                var idPromocion = $(this).closest('.promo-card').data('id');
                var nombrePromocion = $(this).closest('.promo-card').find('h2').text();
                window.location.href = 'editar_promocion.php?id=' + idPromocion + '&nombre=' + nombrePromocion;
            });
        });
    </script>
</body>

</html>
