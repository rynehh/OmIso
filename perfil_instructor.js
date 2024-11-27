function mostrarDetallesCurso(cursoId) {
    fetch(`obtenerDetallesCurso.php?curso_id=${cursoId}`)
        .then(response => response.json())
        .then(data => {
            let detallesCurso = document.getElementById('detalles-curso');
            let contenido = `
                <div class="curso-detalle-header">
                    <h2>${data.curso.TITULO}</h2>
                    <div class="curso-detalle-botones">
                        <button class="btn-editar" onclick="editarCurso(${data.curso.ID_CURSO})">Editar Curso</button>
                        <button class="btn-eliminar" onclick="eliminarCurso(${data.curso.ID_CURSO})">Eliminar Curso</button>
                    </div>
                </div>
                <p>Alumnos inscritos:</p>
                <ul>`;
            
            if (data.alumnos.length > 0) {
                data.alumnos.forEach(alumno => {
                    contenido += `
                        <li>
                            <button class="btn-alumno" onclick="mostrarDetallesAlumno('${alumno.NOMBRE}', '${alumno.NIVEL_COMPLETADO}')">
                                ${alumno.NOMBRE} - $${alumno.PAGO ?? '0.00'} - <strong>Actividades asignadas: ${alumno.ACTIVIDADES ? 'Sí' : 'No'}</strong>
                            </button>
                        </li>`;
                });
            } else {
                contenido += `<li>No hay alumnos inscritos en este curso.</li>`;
            }
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

function eliminarCurso(cursoId) {
    console.log("Intentando eliminar curso con ID:", cursoId);
    if (confirm("¿Estás seguro de que deseas eliminar este curso?")) {
        fetch('00eliminar_curso.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `curso_id=${cursoId}`, // Enviar curso_id en el cuerpo
        })
        .then(response => response.text())
        .then(data => {
            alert(data); // Mostrar mensaje del servidor
            location.reload(); // Recargar la página para actualizar la lista
        })
        .catch(error => {
            console.error("Error al eliminar el curso:", error);
        });
    }
}

function editarCurso(cursoId) {
    window.location.href = `EditarCurso.php?curso_id=${cursoId}`;
}
