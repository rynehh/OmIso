// Ejemplo de datos
const instructores = [
    { usuario: 'instructor1', nombre: 'Juan Pérez', fechaIngreso: '2020-01-15', cursosOfrecidos: 5, ganancias: '$1500' },
    { usuario: 'instructor2', nombre: 'María López', fechaIngreso: '2019-05-10', cursosOfrecidos: 8, ganancias: '$2500' }
];

const estudiantes = [
    { usuario: 'estudiante1', nombre: 'Carlos García', fechaIngreso: '2021-09-20', cursosInscritos: 3, porcentajeTerminados: '67%' },
    { usuario: 'estudiante2', nombre: 'Ana Martínez', fechaIngreso: '2022-03-12', cursosInscritos: 4, porcentajeTerminados: '75%' }
];

// Función para mostrar el reporte según el tipo de usuario seleccionado
function mostrarReporte() {
    const tipoUsuario = document.getElementById('tipoUsuario').value;
    const reporteContainer = document.getElementById('reporteContainer');
    reporteContainer.innerHTML = ''; // Limpiar contenido previo

    if (tipoUsuario === 'instructor') {
        let table = `
            <table>
                <thead>
                    <tr>
                        <th>Usuario</th>
                        <th>Nombre</th>
                        <th>Fecha de Ingreso</th>
                        <th>Cursos Ofrecidos</th>
                        <th>Ganancias</th>
                    </tr>
                </thead>
                <tbody>
        `;
        instructores.forEach(instructor => {
            table += `
                <tr>
                    <td>${instructor.usuario}</td>
                    <td>${instructor.nombre}</td>
                    <td>${instructor.fechaIngreso}</td>
                    <td>${instructor.cursosOfrecidos}</td>
                    <td>${instructor.ganancias}</td>
                </tr>
            `;
        });
        table += `</tbody></table>`;
        reporteContainer.innerHTML = table;

    } else if (tipoUsuario === 'estudiante') {
        let table = `
            <table>
                <thead>
                    <tr>
                        <th>Usuario</th>
                        <th>Nombre</th>
                        <th>Fecha de Ingreso</th>
                        <th>Cursos Inscritos</th>
                        <th>% de Terminados</th>
                    </tr>
                </thead>
                <tbody>
        `;
        estudiantes.forEach(estudiante => {
            table += `
                <tr>
                    <td>${estudiante.usuario}</td>
                    <td>${estudiante.nombre}</td>
                    <td>${estudiante.fechaIngreso}</td>
                    <td>${estudiante.cursosInscritos}</td>
                    <td>${estudiante.porcentajeTerminados}</td>
                </tr>
            `;
        });
        table += `</tbody></table>`;
        reporteContainer.innerHTML = table;
    }
}
