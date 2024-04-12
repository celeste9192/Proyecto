$(document).ready(function() {
    $("#form-agregar-proveedor").submit(function(event) {
        event.preventDefault();
        $.ajax({
            type: "POST",
            url: "agregar_proveedor.php",
            data: $(this).serialize(),
            success: function(response) {
                if (response.indexOf('<!DOCTYPE html>') !== -1) {
                    alert("Proveedor agregado correctamente.");
                } else {
                    alert(response);
                }
                $("#form-agregar-proveedor")[0].reset();
                $("#lista-proveedores").load(" #lista-proveedores");
            }
        });
    });
});

function eliminarProveedor(id) {
    if(confirm("¿Estás seguro de eliminar este proveedor?")) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "eliminar_proveedor.php", true);
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
        xhr.send("id_proveedor=" + id + "&confirmar_eliminar=1");
    }
}

document.getElementById("editForm").addEventListener("submit", function() {
    window.location.href = "proveedores.php";
});
