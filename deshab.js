function habilitarUsuario(button) {
    // Encontrar la fila del usuario correspondiente
    const row = button.parentElement.parentElement;
    
    // Eliminar la fila para simular la habilitación del usuario
    row.remove();

    // Mensaje de confirmación
    alert('El usuario ha sido habilitado.');
}

// Ejemplo de función para abrir la ventana de usuarios deshabilitados
function abrirVentanaUsuariosDeshabilitados() {
    window.open('usuarios-deshabilitados.html', '_blank', 'width=800,height=600');
}
