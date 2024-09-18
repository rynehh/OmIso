function mostrarDetallesCurso(curso) {
    let detallesCurso = document.getElementById('detalles-curso');
    let contenido = '';

    if (curso === 'lol') {
        contenido = `
            <h2>Curso de League of Legends</h2>
            <p>Alumnos inscritos:</p>
            <ul>
                <li><button class="btn-alumno" onclick="mostrarDetallesAlumno('Juan Pérez', 'Nivel 3')">Juan Pérez - $49.99 - <strong>Actividades asignadas: Sí</strong></button></li>
                <li><button class="btn-alumno" onclick="mostrarDetallesAlumno('María López', 'Nivel 2')">María López - $49.99 - <strong>Actividades asignadas: No</strong></button></li>
            </ul>
        `;
    } else if (curso === 'valorant') {
        contenido = `
            <h2>Curso de Valorant</h2>
            <p>Alumnos inscritos:</p>
            <ul>
                <li><button class="btn-alumno" onclick="mostrarDetallesAlumno('Carlos García', 'Nivel 5')">Carlos García - $39.99 - <strong>Actividades asignadas: Sí</strong></button></li>
                <li><button class="btn-alumno" onclick="mostrarDetallesAlumno('Ana Martínez', 'Nivel 4')">Ana Martínez - $39.99 - <strong>Actividades asignadas: No</strong></button></li>
            </ul>
        `;
    } else if (curso === 'fortnite') {
        contenido = `
            <h2>Curso de Fortnite</h2>
            <p>Alumnos inscritos:</p>
            <ul>
                <li><button class="btn-alumno" onclick="mostrarDetallesAlumno('Roberto Gómez', 'Nivel 6')">Roberto Gómez - $29.99 - <strong>Actividades asignadas: Sí</strong></button></li>
                <li><button class="btn-alumno" onclick="mostrarDetallesAlumno('Laura Sánchez', 'Nivel 3')">Laura Sánchez - $29.99 - <strong>Actividades asignadas: No</strong></button></li>
            </ul>
        `;
    }

    // Actualiza el contenido en el div de detalles del curso
    detallesCurso.innerHTML = contenido;
}

function mostrarDetallesAlumno(nombre, nivel) {
    let detallesAlumno = document.getElementById('detalles-alumno');
    let contenido = `
        <h3>Detalles del Alumno: ${nombre}</h3>
        <p>Nivel completado: ${nivel}</p>
    `;

    // Actualiza el contenido en el div de detalles del alumno
    detallesAlumno.innerHTML = contenido;
}
