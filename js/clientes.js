$(document).ready(function() {
    $("#form-agregar-cliente").submit(function(event) {
        event.preventDefault();
        $.ajax({
            type: "POST",
            url: "agregar_cliente.php",
            data: $(this).serialize(),
            success: function(response) {
                
                if (response.indexOf('<!DOCTYPE html>') !== -1) {
                   
                    alert("Cliente guardado correctamente.");
                } else {
                  
                    alert(response);
                }
                $("#form-agregar-cliente")[0].reset();
                $("#lista-clientes").load(" #lista-clientes");
            }
        });
    });
});



function eliminarCliente(id) {
    if(confirm("¿Estás seguro de eliminar este cliente?")) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "eliminar_cliente.php", true);
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
        xhr.send("id_cliente=" + id + "&confirmar_eliminar=1");
    }
}

document.getElementById("editForm").addEventListener("submit", function() {
    window.location.href = "clientes.php";
});

