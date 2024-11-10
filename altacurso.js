document.addEventListener("DOMContentLoaded", function() {
    let nivelCount = 0;

    function actualizarNumeroDeNiveles() {
        document.getElementById('niveles').value = nivelCount;
    }

    window.agregarNiveles = function() {
        const nivelesContainer = document.getElementById('nivelesContainer');
        const nivelDiv = document.createElement('div');
        nivelDiv.classList.add('nivel');
        nivelDiv.innerHTML = `
            <h4>Nivel ${nivelCount + 1}</h4>
            <label for="nivel${nivelCount + 1}Titulo" class="form-label">Título</label>
            <input type="text" class="form-control" name="niveles[${nivelCount}][titulo]" placeholder="Título del Nivel">

            <label for="nivel${nivelCount + 1}Texto" class="form-label">Contenido</label>
            <textarea class="form-control" name="niveles[${nivelCount}][texto]" rows="3" placeholder="Contenido del Nivel"></textarea>

            <label for="nivel${nivelCount + 1}Costo" class="form-label">Costo del nivel</label>
            <input type="number" class="form-control" name="niveles[${nivelCount}][costo]" placeholder="Costo del nivel si es independiente">
        `;
        nivelesContainer.appendChild(nivelDiv);
        nivelCount++;
        actualizarNumeroDeNiveles();
    };

    document.getElementById('nuevoCursoForm').addEventListener('submit', function(event) {
        event.preventDefault();
        const formData = new FormData(this);

        fetch("00guardar_curso.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === "success") {
                alert(data.message);
                window.location.href = 'perfil_instructor.php';
            } else {
                alert("Ocurrió un error al guardar el curso: " + data.message);
            }
        })
        .catch(error => {
            alert("Ocurrió un error al guardar el curso.");
            console.error("Error al guardar el curso:", error);
        });
    });

    document.getElementById('btnCancelar').addEventListener('click', function() {
        window.location.href = 'perfil_instructor.php';
    });
});
