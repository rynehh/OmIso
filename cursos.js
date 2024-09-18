const cursos = [
    { titulo: 'Curso de League of Legends', etiqueta: 'estrategia', precio: '$49.99', accion: 'comprar' },
    { titulo: 'Curso de Valorant', etiqueta: 'accion', precio: '$39.99', accion: 'ver' },
    { titulo: 'Curso de Fortnite', etiqueta: 'accion', precio: '$29.99', accion: 'comprar' },
    { titulo: 'Curso de The Witcher 3', etiqueta: 'aventura', precio: '$59.99', accion: 'ver' },
    { titulo: 'Curso de FIFA 21', etiqueta: 'deportes', precio: '$19.99', accion: 'comprar' },
    { titulo: 'Curso de Skyrim', etiqueta: 'rpg', precio: '$44.99', accion: 'ver' }
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
