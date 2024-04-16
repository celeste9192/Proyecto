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
if(confirm("¿Estás seguro que quiere eliminar el reclamo?")) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "eliminar_reclamacion.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if(xhr.readyState === XMLHttpRequest.DONE) {
            if(xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                if(response.success) {
                    alert(response.message);
                    
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

document.getElementById("editForm").addEventListener("submit", function() {
window.location.href = "reclamaciones.php";
});