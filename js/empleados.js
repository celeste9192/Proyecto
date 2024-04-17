$(document).ready(function() {
    // Evento para el formulario de agregar empleado
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

    // Evento para el botón de eliminar empleado
    $(document).on("click", ".btn-eliminar", function() {
        var idEmpleado = $(this).data("id");
        if(confirm("¿Estás seguro de eliminar este empleado?")) {
            eliminarEmpleado(idEmpleado);
        }
    });

    // Función para eliminar empleado
    function eliminarEmpleado(id) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "eliminar_empleado.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if(xhr.readyState === XMLHttpRequest.DONE) {
                if(xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    if(response.success) {
                        alert(response.message);
                        // Recargar la lista de empleados después de eliminar uno
                        $("#lista-empleados").load(" #lista-empleados", function() {
                            // Recargar la página después de un breve retraso
                            setTimeout(function() {
                                window.location.reload();
                            }, 1000);
                        });
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

    // Redirección al editar empleado
    $(document).on("click", ".btn-editar", function() {
        var empleadoId = $(this).data('id');
        window.location.href = "editar_empleado.php?empleadoId=" + empleadoId;
    });

    // Función para manejar la edición de empleado
    $(document).on("submit", "#editForm", function(event) {
        event.preventDefault();
        var form = $(this);
        $.ajax({
            type: form.attr('method'),
            url: form.attr('action'),
            data: form.serialize(),
            success: function(response) {
                if (response.indexOf('<!DOCTYPE html>') !== -1) {
                    alert("Empleado actualizado correctamente.");
                } else {
                    alert(response);
                }
                // Redireccionar a la página de empleados después de la edición
                window.location.href = "empleados.php";
            },
            error: function() {
                alert("Error al comunicarse con el servidor.");
            }
        });
    });
});
