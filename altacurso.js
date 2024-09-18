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
    
    // Aquí puedes agregar la lógica para guardar el curso si es necesario
    console.log("Curso guardado.");

    // Redirigir al perfil de instructor después de guardar
    window.location.href = 'perfil_instructor.html';
});

// Manejar el evento del botón "Cancelar"
document.getElementById('btnCancelar').addEventListener('click', function() {
    // Redirigir al perfil de instructor al hacer clic en Cancelar
    window.location.href = 'perfil_instructor.html';
});

// Función para agregar niveles dinámicos (ejemplo si se necesita)
function agregarNiveles() {
    const nivelesContainer = document.getElementById('nivelesContainer');
    const numeroDeNiveles = document.getElementById('niveles');
    
    // Incrementar el número de niveles y agregar un nuevo nivel al contenedor
    const nuevoNivel = document.createElement('div');
    nuevoNivel.classList.add('mb-3');
    nuevoNivel.innerHTML = `
        <label for="nivel${numeroDeNiveles.value}" class="form-label">Nivel ${parseInt(numeroDeNiveles.value) + 1}</label>
        <input type="text" class="form-control" id="nivel${numeroDeNiveles.value}" placeholder="Título del Nivel">
    `;
    
    nivelesContainer.appendChild(nuevoNivel);
    numeroDeNiveles.value = parseInt(numeroDeNiveles.value) + 1;
}
