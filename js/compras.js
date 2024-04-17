$("#form-agregar-compra").submit(function(event) {
    event.preventDefault();
    $.ajax({
        type: "POST",
        url: "agregar_compra.php",
        data: $(this).serialize(),
        success: function(response) {
            
            if (response.indexOf('<!DOCTYPE html>') !== -1) {
               
                alert("Compra guardada correctamente.");
            } else {
              
                alert(response);
            }
            $("#form-agregar-compra")[0].reset();
            $("#lista-compras").load(" #lista-compras");
        }
    });
});

function eliminarCompra(id) {
    if(confirm("¿Estás seguro que quiere eliminar la compra?")) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "eliminar_compra.php", true);
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
        xhr.send("id_compra=" + id + "&confirmar_eliminar=1");
    }
}

$(document).ready(function() {
    $('#editForm').submit(function(e) {
        e.preventDefault(); 
        $.ajax({
            type: 'POST',
            url: 'editar_compra.php', 
            data: $(this).serialize(), 
            success: function(response) {
                alert('Cambios guardados exitosamente.');
            },
            error: function(xhr, status, error) {
                alert('Error al guardar los cambios: ' + error);
            }
        });
    });
});
