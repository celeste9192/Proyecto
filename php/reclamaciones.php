<?php
include '../DAL/conexion.php';

function obtenerReclamaciones()
{
    session_start();
    $conexion = Conecta();

    if (isset($_SESSION['rol'])) {
        if ($_SESSION['rol'] === 'cliente') {
            $idClienteSesion = $_SESSION['id_cliente'];
            $sql = "SELECT * FROM Reclamaciones WHERE id_cliente = $idClienteSesion";
        } else {
            $sql = "SELECT * FROM Reclamaciones";
        }

        $resultado = mysqli_query($conexion, $sql);

        if ($resultado && mysqli_num_rows($resultado) > 0) {
            echo "<h2 id='subtitulo'>Listado de Reclamos</h2>";
            echo "<div id='container'>";
            echo "<table id='tabla'>";
            echo "<tr><th>Número de Reclamo</th><th>Cliente</th><th>Motivo</th><th>Estado</th><th>Fecha</th><th>Acciones</th></tr>";

            while ($fila = mysqli_fetch_assoc($resultado)) {
                echo "<tr>";
                echo "<td>" . $fila['id_reclamacion'] . "</td>";
                echo "<td>" . $fila['id_cliente'] . "</td>";
                echo "<td>" . $fila['motivo'] . "</td>";
                echo "<td>";
                if ($_SESSION['rol'] !== 'administrador') {
                    echo $fila['estado'];
                } else {
                    echo "<select class='estado-select' data-id='" . $fila['id_reclamacion'] . "'>";
                    echo "<option value='Pendiente' " . ($fila['estado'] === 'Pendiente' ? 'selected' : '') . ">Pendiente</option>";
                    echo "<option value='En Proceso' " . ($fila['estado'] === 'En Proceso' ? 'selected' : '') . ">En Proceso</option>";
                    echo "<option value='Finalizado' " . ($fila['estado'] === 'Finalizado' ? 'selected' : '') . ">Finalizado</option>";
                    echo "</select>";
                }
                echo "</td>";
                echo "<td>" . $fila['fecha'] . "</td>";
                echo "<td>";
                if ($_SESSION['rol'] === 'administrador') {
                    echo "<button class='guardar-btn' data-id='" . $fila['id_reclamacion'] . "'>Guardar Cambios</button>";
                } else {
                    echo "<a href='editar_reclamacion.php?id_reclamacion=" . $fila['id_reclamacion'] . "' class='btn-editar'>Editar</a>";
                    echo "<button onclick='eliminarReclamacion(" . $fila['id_reclamacion'] . ")' class='btn-eliminar'>Eliminar</button>";
                }
                echo "</td>";
                echo "</tr>";
            }
            echo "</table>";
            echo "</div>";
        } else {
            echo "<p id='no-products-msg'>No se encontraron reclamaciones.</p>";
        }
    } else {
        echo "<p id='no-products-msg'>No se encontraron reclamaciones.</p>";
    }

    Desconectar($conexion);
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reclamos</title>
    <link rel="stylesheet" href="../css/styles.css">
    <script src="../js/reclamaciones.js"></script>
</head>

<body>
    <header id="titulo">
        <h1>Reclamos</h1>
    </header>
    <div id="container">
        <div id="btn-container">
            <?php if (isset($_SESSION['rol']) && ($_SESSION['rol']) !== 'administrador' && ($_SESSION['rol']) == 'cliente'): ?>
                <a href="agregar_reclamacion.php" class="btn">Agregar Reclamo</a>
            <?php endif; ?>
        </div>
        
        <?php obtenerReclamaciones(); ?>

        <a href="index.php" id="btn-menu-principal" class="btn">Menú Principal</a>
        <a href="agregar_reclamacion.php" id="btn-menu-principal" class="btn">Agregar reclamo</a>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".guardar-btn").click(function() {
                var idReclamacion = $(this).data("id");
                var nuevoEstado = $(".estado-select[data-id='" + idReclamacion + "']").val();
                if (confirm("¿Estás seguro de guardar los cambios?")) {
                    $.ajax({
                        type: "POST",
                        url: "editar_reclamacion.php",
                        data: {
                            id_reclamacion: idReclamacion,
                            estado: nuevoEstado,
                            guardar: true
                        },
                        success: function(response) {
                            alert(response);
                            
                        },
                        error: function(xhr, status, error) {
                            alert("Error al guardar los cambios: " + error);
                        }
                    });
                }
                return false; 
            });
        });
    </script>
</body>

</html>
