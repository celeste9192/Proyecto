$("#form-agregar-venta").submit(function(event) {
    event.preventDefault();
    $.ajax({
        type: "POST",
        url: "agregar_venta.php",
        data: $(this).serialize(),
        success: function(response) {
            
            if (response.indexOf('<!DOCTYPE html>') !== -1) {
               
                alert("Venta guardada correctamente.");
            } else {
              
                alert(response);
            }
            $("#form-agregar-venta")[0].reset();
            $("#lista-ventas").load(" #lista-ventas");
        }
    });
});

function eliminarVenta(id) {
if(confirm("¿Estás seguro que quiere eliminar la venta?")) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "eliminar_venta.php", true);
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
    xhr.send("id_venta=" + id + "&confirmar_eliminar=1");
}
}

document.getElementById("editForm").addEventListener("submit", function() {
window.location.href = "ventas.php";
});
