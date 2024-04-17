$("#form-agregar-reclamacion").submit(function(event) {
    event.preventDefault();
    $.ajax({
        type: "POST",
        url: "agregar_reclamacion.php",
        data: $(this).serialize(),
        success: function(response) {
            if (response.indexOf('<!DOCTYPE html>') !== -1) {
                alert("Reclamo guardado correctamente.");
            } else {
                alert(response);
            }
            $("#form-agregar-reclamacion")[0].reset();
            $("#lista-reclamaciones").load(" #lista-reclamaciones");
        }
    });
});

function eliminarReclamacion(id) {
    if (confirm("¿Estás seguro que quieres eliminar el reclamo?")) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "eliminar_reclamacion.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        alert(response.message);
                        
                        $("#lista-reclamaciones").load(" #lista-reclamaciones");
                    } else {
                        alert(response.message);
                    }
                } else {
                    alert("Error al comunicarse con el servidor.");
                }
            }
        };
        xhr.send("id_reclamacion=" + id + "&confirmar_eliminar=1");
    }
}



$(document).ready(function() {
    $(".guardar-btn").click(function() {
        var idReclamacion = $("#id_reclamacion").val();
        var nuevoEstado = $("#estado").val();
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
                    
                    location.reload();
                },
                error: function(xhr, status, error) {
                    alert("Error al guardar los cambios: " + error);
                }
            });
        }
        return false; 
    });

    document.getElementById("editForm").addEventListener("submit", function() {
        window.location.href = "reclamaciones.php";
    });

});
