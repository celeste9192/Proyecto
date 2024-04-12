$(document).ready(function() {
    $("#form-agregar-empleado").submit(function(event) {
        event.preventDefault();
        $.ajax({
            type: "POST",
            url: "agregar_empleado.php",
            data: $(this).serialize(),
            success: function(response) {
                if (response.indexOf('<!DOCTYPE html>') !== -1) {
                    alert("Empleado agregado correctamente.");
                } else {
                    alert(response);
                }
                $("#form-agregar-empleado")[0].reset();
                $("#lista-empleados").load(" #lista-empleados");
            }
        });
    });
});

function eliminarEmpleado(id) {
    if(confirm("¿Estás seguro de eliminar este empleado?")) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "eliminar_empleado.php", true);
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
        xhr.send("id_empleado=" + id + "&confirmar_eliminar=1");
    }
}

document.getElementById("editForm").addEventListener("submit", function() {
    window.location.href = "empleados.php";
});
