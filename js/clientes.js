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

    
    $(document).on("click", ".eliminar-cliente", function() {
        var clienteId = $(this).data('cliente-id');
        var clienteNombre = $(this).data('cliente-nombre');
        
        
        if (confirm("¿Estás seguro de eliminar al cliente " + clienteNombre + "?")) {
            
            eliminarCliente(clienteId);
        }
    });

    
    function eliminarCliente(clienteId) {
        $.ajax({
            type: "POST",
            url: "eliminar_cliente.php",
            data: { id_cliente: clienteId, confirmar_eliminar: 1 },
            success: function(response) {
                
                alert(response.message);
                location.reload();
            },
            error: function() {
                alert("Error al comunicarse con el servidor.");
            }
        });
    }

    
    $(document).on("click", ".eliminar-cliente", function() {
        var clienteId = $(this).data('cliente-id');
        var clienteNombre = $(this).data('cliente-nombre');
        
        
        if (confirm("¿Estás seguro de eliminar al cliente " + clienteNombre + "?")) {
            
            eliminarCliente(clienteId);
        }
    });
    

});
