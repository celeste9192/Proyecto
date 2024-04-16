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
                echo "<td>" . $fila['estado'] . "</td>";
                echo "<td>" . $fila['fecha'] . "</td>";
                echo "<td>";
                if ($_SESSION['rol'] !== 'administrador') {
                    echo "<a href='eliminar_reclamacion.php?id_reclamacion=" . $fila['id_reclamacion'] . "' class='btn'>Eliminar</a><br>";
                    echo "<a href='editar_reclamacion.php?id_reclamacion=" . $fila['id_reclamacion'] . "&id_cliente=" . $fila['id_cliente'] . "' class='btn edit-btn'>Editar</a><br>";
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
</head>

<body>
    <header id="titulo">
        <h1>Reclamos</h1>
    </header>
    <div id="container">
        <div id="btn-container">
            <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] !== 'administrador'): ?>
                <a href="agregar_reclamacion.php" class="btn">Agregar Reclamo</a>
            <?php endif; ?>
        </div>

        <?php obtenerReclamaciones(); ?>

        <a href="index.php" id="btn-menu-principal" class="btn">Menú Principal</a>
        <a href="agregar_reclamacion.php" id="btn-menu-principal" class="btn">Agregar Reclamo</a>
    </div>

    <script>
        
        function limpiarParametroId() {
            if (window.history.replaceState) {
                
                var nuevaURL = window.location.href.split('?')[0];
                window.history.replaceState(null, null, nuevaURL);
            }
        }
        
        
        document.querySelectorAll('.edit-btn').forEach(btn => {
            btn.addEventListener('click', limpiarParametroId);
        });
    </script>
</body>

</html>
