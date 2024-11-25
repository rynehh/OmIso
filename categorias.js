document.getElementById("crearCatBtn").addEventListener("click", function () {
    const nombre = document.getElementById("nombreCat").value.trim();
    const descripcion = document.getElementById("descCat").value.trim();

    if (!nombre || !descripcion) {
        alert("Por favor, completa todos los campos.");
        return;
    }

    fetch("00nueva_categoria.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded",
        },
        body: `nombre=${encodeURIComponent(nombre)}&descripcion=${encodeURIComponent(descripcion)}`,
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message);
                location.reload(); // Recargar la página para actualizar la tabla
            } else {
                alert(data.message);
            }
        })
        .catch(error => {
            console.error("Error:", error);
            alert("Hubo un problema al crear la categoría.");
        });
});
