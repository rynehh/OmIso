// Crear nueva categoría y agregarla a la tabla
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('nuevaCategoriaForm');
    const crearCatBtn = document.getElementById('crearCatBtn');
    const table = document.getElementById('categorias-table').getElementsByTagName('tbody')[0];

    crearCatBtn.addEventListener('click', function(event) {
        event.preventDefault();
        const nombre = document.getElementById('nombreCat').value;
        const descripcion = document.getElementById('descCat').value;

        if (nombre && descripcion) {
            const newRow = table.insertRow();
            newRow.innerHTML = `
                <td>${nombre}</td>
                <td>${descripcion}</td>
                <td><button class="editar-btn btn btn-primary">Editar</button></td>
                <td><button class="eliminar-btn btn btn-danger">Eliminar</button></td>
            `;
            form.reset(); // Limpiar el formulario
            const modal = new bootstrap.Modal(document.getElementById('modalNuevaCat')); 
            modal.hide(); // Cerrar el modal
        } else {
            alert('Por favor, llena todos los campos.');
        }
    });
});
