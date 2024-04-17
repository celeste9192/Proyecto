
/* Este archivo no es esta utilizando
$("#form-agregar-detallesventa").submit(function(event) {
    event.preventDefault();
    $.ajax({
        type: "POST",
        url: "agregar_detallesventa.php",
        data: $(this).serialize(),
        success: function(response) {
            
            if (response.indexOf('<!DOCTYPE html>') !== -1) {
               
                alert("Detalles de la Venta guardados correctamente.");
            } else {
              
                alert(response);
            }
            $("#form-agregar-detallesventa")[0].reset();
            $("#lista-detallesventa").load(" #lista-detallesventa");
        }
    });
});

function eliminarDetallesVenta(id) {
if(confirm("¿Estás seguro que quiere eliminar los dettales de la venta?")) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "eliminar_detallesventa.php", true);
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
    xhr.send("id_detalle_venta=" + id + "&confirmar_eliminar=1");
}
}

document.getElementById("editForm").addEventListener("submit", function() {
window.location.href = "detalles_ventas.php";
}); */