$(document).ready(function() {
    $("#agregarCategoriaForm").submit(function(event) {
        event.preventDefault(); // Evita que se envíe el formulario de manera tradicional

        $.ajax({
            type: "POST",
            url: "agregar_categoria.php",
            data: $(this).serialize(), // Serializa los datos del formulario
            success: function(response) {
                if (response.indexOf('<!DOCTYPE html>') !== -1) {
                    alert("Categoría guardada correctamente.");
                } else {
                    alert(response);
                }
                $("#agregarCategoriaForm")[0].reset(); // Reinicia el formulario después de enviarlo
                // Recarga la lista de categorías
                $("#categorias-container").load(" #categorias-container");
            }
        });
    });
});

function eliminarCategoria(id) {
    if(confirm("¿Estás seguro de eliminar esta categoría?")) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "eliminar_categoria.php", true);
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
                    // Recarga la lista de categorías
                    $("#categorias-container").load(" #categorias-container");
                } else {
                    alert("Error al comunicarse con el servidor.");
                }
            }
        };
        xhr.send("id_categoria=" + id + "&confirmar_eliminar=1");
    }
}



document.getElementById("editForm").addEventListener("submit", function() {
    window.location.href = "categorias.php";
});
