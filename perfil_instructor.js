function mostrarDetallesCurso(cursoId) {
    fetch(`obtenerDetallesCurso.php?curso_id=${cursoId}`)
        .then(response => response.json())
        .then(data => {
            let detallesCurso = document.getElementById('detalles-curso');
            let contenido = `<h2>${data.curso.TITULO}</h2><p>Alumnos inscritos:</p><ul>`;

            data.alumnos.forEach(alumno => {
                contenido += `
                    <li>
                        <button class="btn-alumno" onclick="mostrarDetallesAlumno('${alumno.NOMBRE}', '${alumno.NIVEL_COMPLETADO}')">
                            ${alumno.NOMBRE} - $${alumno.PAGO} - <strong>Actividades asignadas: ${alumno.ACTIVIDADES ? 'Sí' : 'No'}</strong>
                        </button>
                    </li>`;
            });

            contenido += `</ul>`;

            // Actualizar el contenido en el div de detalles del curso
            detallesCurso.innerHTML = contenido;
        })
        .catch(error => {
            console.error("Error al obtener los detalles del curso:", error);
        });
}

function mostrarDetallesAlumno(nombre, nivel) {
    let detallesAlumno = document.getElementById('detalles-alumno');
    let contenido = `
        <h3>Detalles del Alumno: ${nombre}</h3>
        <p>Nivel completado: ${nivel}</p>
    `;

    // Actualizar el contenido en el div de detalles del alumno
    detallesAlumno.innerHTML = contenido;
}
