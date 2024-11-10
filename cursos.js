function buscarCurso() {
    const searchTerm = document.getElementById('buscar').value.toLowerCase();
    const cursos = document.querySelectorAll('.course-card');

    cursos.forEach(curso => {
        const titulo = curso.querySelector('h3').textContent.toLowerCase();
        curso.style.display = titulo.includes(searchTerm) ? 'block' : 'none';
    });
}

function filtrarPorEtiqueta(categoria) {
    const cursos = document.querySelectorAll('.course-card');

    cursos.forEach(curso => {
        curso.style.display = curso.getAttribute('data-categoria') === categoria ? 'block' : 'none';
    });
}

function filtrarPorInstructor() {
    const instructor = document.getElementById('instructor').value;
    const cursos = document.querySelectorAll('.course-card');

    cursos.forEach(curso => {
        curso.style.display = curso.getAttribute('data-instructor') === instructor ? 'block' : 'none';
    });
}

function filtrarPorFecha() {
    const fechaInicio = new Date(document.getElementById('fechaInicio').value);
    const fechaFin = new Date(document.getElementById('fechaFin').value);
    const cursos = document.querySelectorAll('.course-card');

    cursos.forEach(curso => {
        const fechaCurso = new Date(curso.getAttribute('data-fecha'));
        curso.style.display = (fechaCurso >= fechaInicio && fechaCurso <= fechaFin) ? 'block' : 'none';
    });
}
