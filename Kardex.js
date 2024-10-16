function abrirCertificado() {
    window.open('Certificado.php', '_blank', 'width=800,height=600');
}

// Cursos de ejemplo (se pueden reemplazar por datos dinámicos)
const kardexCursos = [
    { curso: 'LOL', nivel: 3, ultimaConexion: '2024-09-15', estado: 'En Curso', fechaInicio: '2024-08-01', fechaTermino: '-'},
    { curso: 'VALORANT', nivel: 5, ultimaConexion: '2024-09-12', estado: 'Completado', fechaInicio: '2024-03-15', fechaTermino: '2024-08-30' },
    { curso: 'The Witcher 3', nivel: 4, ultimaConexion: '2024-09-01', estado: 'En Curso', fechaInicio: '2024-06-10', fechaTermino: '-' },
];

// Filtrar por fecha
function filtrarPorFecha() {
    const fechaInicio = document.getElementById('fechaInicio').value;
    const fechaFin = document.getElementById('fechaFin').value;

    const cursosFiltrados = kardexCursos.filter(curso => {
        const fechaInicioCurso = new Date(curso.fechaInicio);
        const fechaTerminoCurso = curso.fechaTermino !== '-' ? new Date(curso.fechaTermino) : null;
        return (!fechaInicio || fechaInicioCurso >= new Date(fechaInicio)) && (!fechaFin || (fechaTerminoCurso && fechaTerminoCurso <= new Date(fechaFin)));
    });

    mostrarCursos(cursosFiltrados);
}

// Filtrar por categoría
function filtrarPorCategoria() {
    const categoria = document.getElementById('categoria').value;
    
    const cursosFiltrados = kardexCursos.filter(curso => {
        return categoria === 'todos' || curso.categoria.toLowerCase() === categoria.toLowerCase();
    });

    mostrarCursos(cursosFiltrados);
}

// Filtrar por estado (completado o en curso)
function filtrarPorEstado() {
    const estado = document.getElementById('estadoCurso').value;
    
    const cursosFiltrados = kardexCursos.filter(curso => {
        return estado === 'todos' || curso.estado.toLowerCase() === estado.toLowerCase();
    });

    mostrarCursos(cursosFiltrados);
}

// Mostrar cursos en la tabla
function mostrarCursos(cursos) {
    const tablaBody = document.querySelector('#kardex-table tbody');
    tablaBody.innerHTML = ''; // Limpiar la tabla

    cursos.forEach(curso => {
        const row = `
            <tr>
                <td>${curso.curso}</td>
                <td>${curso.nivel}</td>
                <td>${curso.ultimaConexion}</td>
                <td>${curso.estado}</td>
                <td>${curso.fechaInicio}</td>
                <td>${curso.fechaTermino}</td>
            </tr>
        `;
        tablaBody.innerHTML += row;
    });

    if (cursos.length === 0) {
        tablaBody.innerHTML = '<tr><td colspan="6">No se encontraron cursos.</td></tr>';
    }
}

// Cargar todos los cursos al cargar la página
window.onload = function() {
    mostrarCursos(kardexCursos);
};
