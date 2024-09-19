const cursos = [
    { titulo: 'Curso de League of Legends', etiqueta: 'estrategia', precio: '$49.99', accion: 'comprar', fechaPublicacion: '2023-05-10', instructor: 'John Doe' },
    { titulo: 'Curso de Valorant', etiqueta: 'accion', precio: '$39.99', accion: 'ver', fechaPublicacion: '2023-06-01', instructor: 'Jane Smith' },
    { titulo: 'Curso de Fortnite', etiqueta: 'accion', precio: '$29.99', accion: 'comprar', fechaPublicacion: '2023-04-20', instructor: 'Carlos Pérez' },
    { titulo: 'Curso de The Witcher 3', etiqueta: 'aventura', precio: '$59.99', accion: 'ver', fechaPublicacion: '2022-12-25', instructor: 'John Doe' },
    { titulo: 'Curso de FIFA 21', etiqueta: 'deportes', precio: '$19.99', accion: 'comprar', fechaPublicacion: '2021-11-30', instructor: 'Juan García' },
    { titulo: 'Curso de Skyrim', etiqueta: 'rpg', precio: '$44.99', accion: 'ver', fechaPublicacion: '2022-10-15', instructor: 'Jane Smith' }
];


// Mostrar todos los cursos al cargar la página
window.onload = function() {
    mostrarTodosLosCursos();
};

function mostrarTodosLosCursos() {
    const contenedorCursos = document.getElementById('cursos-container');
    contenedorCursos.innerHTML = ''; // Limpiar cursos previos

    // Mostrar todos los cursos
    cursos.forEach(curso => {
        const cursoDiv = document.createElement('div');
        cursoDiv.classList.add('curso-card');
        cursoDiv.innerHTML = `
            <h3>${curso.titulo}</h3>
            <p>Etiqueta: ${curso.etiqueta.charAt(0).toUpperCase() + curso.etiqueta.slice(1)}</p>
            <p class="precio">${curso.precio}</p>
            ${obtenerBotonAccion(curso.accion)}
        `;
        contenedorCursos.appendChild(cursoDiv);
    });
}

function obtenerBotonAccion(accion) {
    if (accion === 'comprar') {
        return `<a href="curso.html" class="btn-accion comprar">Comprar</a>`;
    } else if (accion === 'ver') {
        return `<a href="CursoCom.html" class="btn-accion ver">Ver</a>`;
    }
}

function filtrarPorEtiqueta(etiqueta) {
    const contenedorCursos = document.getElementById('cursos-container');
    contenedorCursos.innerHTML = ''; // Limpiar cursos previos

    // Filtrar y mostrar los cursos por etiqueta
    const cursosFiltrados = cursos.filter(curso => curso.etiqueta === etiqueta);
    cursosFiltrados.forEach(curso => {
        const cursoDiv = document.createElement('div');
        cursoDiv.classList.add('curso-card');
        cursoDiv.innerHTML = `
            <h3>${curso.titulo}</h3>
            <p>Etiqueta: ${curso.etiqueta.charAt(0).toUpperCase() + curso.etiqueta.slice(1)}</p>
            <p class="precio">${curso.precio}</p>
            ${obtenerBotonAccion(curso.accion)}
        `;
        contenedorCursos.appendChild(cursoDiv);
    });
}

// Función para buscar cursos por título
function buscarCurso() {
    const input = document.getElementById('buscar').value.toLowerCase();
    const contenedorCursos = document.getElementById('cursos-container');
    contenedorCursos.innerHTML = ''; // Limpiar cursos previos

    // Mostrar solo los cursos que coincidan con la búsqueda
    const cursosFiltrados = cursos.filter(curso => curso.titulo.toLowerCase().includes(input));
    cursosFiltrados.forEach(curso => {
        const cursoDiv = document.createElement('div');
        cursoDiv.classList.add('curso-card');
        cursoDiv.innerHTML = `
            <h3>${curso.titulo}</h3>
            <p>Etiqueta: ${curso.etiqueta.charAt(0).toUpperCase() + curso.etiqueta.slice(1)}</p>
            <p class="precio">${curso.precio}</p>
            ${obtenerBotonAccion(curso.accion)}
        `;
        contenedorCursos.appendChild(cursoDiv);
    });
}

function filtrarPorFecha() {
    const fechaInicio = document.getElementById('fechaInicio').value;
    const fechaFin = document.getElementById('fechaFin').value;
    
    if (!fechaInicio || !fechaFin) {
        alert('Por favor selecciona ambas fechas.');
        return;
    }

    const contenedorCursos = document.getElementById('cursos-container');
    contenedorCursos.innerHTML = ''; // Limpiar cursos previos

    const cursosFiltrados = cursos.filter(curso => {
        const fechaPublicacion = new Date(curso.fechaPublicacion);
        return fechaPublicacion >= new Date(fechaInicio) && fechaPublicacion <= new Date(fechaFin);
    });

    // Mostrar cursos filtrados por fecha
    cursosFiltrados.forEach(curso => {
        const cursoDiv = document.createElement('div');
        cursoDiv.classList.add('curso-card');
        cursoDiv.innerHTML = `
            <h3>${curso.titulo}</h3>
            <p>Etiqueta: ${curso.etiqueta.charAt(0).toUpperCase() + curso.etiqueta.slice(1)}</p>
            <p class="precio">${curso.precio}</p>
            ${obtenerBotonAccion(curso.accion)}
        `;
        contenedorCursos.appendChild(cursoDiv);
    });
}

// Función para filtrar los cursos por instructor
function filtrarPorInstructor() {
    const instructorSeleccionado = document.getElementById('instructor').value;
    
    if (!instructorSeleccionado) {
        alert('Por favor selecciona un instructor.');
        return;
    }

    const contenedorCursos = document.getElementById('cursos-container');
    contenedorCursos.innerHTML = ''; // Limpiar cursos previos

    const cursosFiltrados = cursos.filter(curso => curso.instructor === instructorSeleccionado);

    // Mostrar cursos filtrados por instructor
    cursosFiltrados.forEach(curso => {
        const cursoDiv = document.createElement('div');
        cursoDiv.classList.add('curso-card');
        cursoDiv.innerHTML = `
            <h3>${curso.titulo}</h3>
            <p>Instructor: ${curso.instructor}</p>
            <p>Etiqueta: ${curso.etiqueta.charAt(0).toUpperCase() + curso.etiqueta.slice(1)}</p>
            <p class="precio">${curso.precio}</p>
            ${obtenerBotonAccion(curso.accion)}
        `;
        contenedorCursos.appendChild(cursoDiv);
    });
    
    if (cursosFiltrados.length === 0) {
        contenedorCursos.innerHTML = '<p>No se encontraron cursos con este instructor.</p>';
    }
}


