let nivelCount = 0;  // Inicializamos el contador de niveles a 0

function actualizarNumeroDeNiveles() {
    document.getElementById('niveles').value = nivelCount;
}

function agregarNiveles() {
    const nivelesContainer = document.getElementById('nivelesContainer');

    // Creamos el nuevo nivel
    const nivelDiv = document.createElement('div');
    nivelDiv.classList.add('nivel');

    nivelDiv.innerHTML = `
        
        <h4>Nivel ${nivelCount + 1}</h4>
        <label for="nivel${nivelCount + 1}" class="form-label">Nivel</label>
        <input type="text" class="form-control" id="nivel${nivelCount + 1}" placeholder="Título del Nivel">


        <label for="videoNivel${nivelCount + 1}" class="form-label">Video</label>
        <input type="file" class="form-control" id="videoNivel${nivelCount + 1}">
        
        <label for="textoNivel${nivelCount + 1}" class="form-label">Texto</label>
        <textarea class="form-control" id="textoNivel${nivelCount + 1}" rows="3" placeholder="Descripción del nivel"></textarea>
        
        <label for="costoNivel${nivelCount + 1}" class="form-label">Costo del nivel</label>
        <input type="number" class="form-control" id="costoNivel${nivelCount + 1}" placeholder="Costo del nivel si es independiente">
        
        <button type="button" class="eliminar-btn" onclick="eliminarNivel(${nivelCount + 1})">Eliminar Nivel</button>
    `;

    nivelDiv.id = `nivel-${nivelCount + 1}`;
    nivelesContainer.appendChild(nivelDiv);

    // Incrementamos el contador de niveles y actualizamos el campo de "Número de Niveles"
    nivelCount++;
    actualizarNumeroDeNiveles();
}

function eliminarNivel(nivelId) {
    const nivel = document.getElementById(`nivel-${nivelId}`);
    if (nivel) {
        nivel.remove();
        nivelCount--;  // Reducimos el contador de niveles
        actualizarNumeroDeNiveles();
        // Reorganizamos los números de los niveles restantes
        reorganizarNiveles();
    }
}

function reorganizarNiveles() {
    const niveles = document.querySelectorAll('.nivel');
    niveles.forEach((nivel, index) => {
        const nivelNumero = index + 1;
        nivel.querySelector('h4').textContent = `Nivel ${nivelNumero}`;
        nivel.querySelector('label[for^="videoNivel"]').setAttribute('for', `videoNivel${nivelNumero}`);
        nivel.querySelector('input[type="file"]').id = `videoNivel${nivelNumero}`;
        nivel.querySelector('label[for^="textoNivel"]').setAttribute('for', `textoNivel${nivelNumero}`);
        nivel.querySelector('textarea').id = `textoNivel${nivelNumero}`;
        nivel.querySelector('label[for^="costoNivel"]').setAttribute('for', `costoNivel${nivelNumero}`);
        nivel.querySelector('input[type="number"]').id = `costoNivel${nivelNumero}`;
        nivel.querySelector('.eliminar-btn').setAttribute('onclick', `eliminarNivel(${nivelNumero})`);
        nivel.id = `nivel-${nivelNumero}`;
    });
}

// Manejar la validación del formulario
document.getElementById('nuevoCursoForm').addEventListener('submit', function(event) {
    event.preventDefault();
    alert('Curso guardado con éxito');
});

// Manejar el evento del botón "Guardar Curso"
document.getElementById('nuevoCursoForm').addEventListener('submit', function(event) {
    event.preventDefault();
    
    
    console.log("Curso guardado.");

    
    window.location.href = 'perfil_instructor.php';
});

// Manejar el evento del botón "Cancelar"
document.getElementById('btnCancelar').addEventListener('click', function() {
    
    window.location.href = 'perfil_instructor.php';
});