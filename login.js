// script.js

document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('loginForm');
    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');
    const errorMessage = document.getElementById('error-message');

    form.addEventListener('submit', (event) => {
        event.preventDefault(); // Evita que el formulario se envíe inmediatamente

        const email = emailInput.value.trim();
        const password = passwordInput.value.trim();

        if (email === '' || password === '') {
            errorMessage.textContent = 'Por favor, completa todos los campos.';
            errorMessage.style.display = 'block';
        } else {
            errorMessage.style.display = 'none';
            // Aquí puedes agregar la lógica para enviar los datos del formulario
            // Por ejemplo, usar fetch para enviar los datos a un servidor
            alert('Sesion Iniciada');
            document.getElementById('btnini').addEventListener('click', function() {
    
                window.location.href = 'inicio.php';
            });
        }
    });
});
