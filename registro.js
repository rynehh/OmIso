// script.js

document.addEventListener('DOMContentLoaded', () => {
    const registerForm = document.getElementById('registerForm');
    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');
    const confirmPasswordInput = document.getElementById('confirm-password');
    const nameInput = document.getElementById('name');
    const errorMessage = document.getElementById('error-message');

    registerForm.addEventListener('submit', (event) => {
        event.preventDefault(); // Evita que el formulario se envíe inmediatamente

        const name = nameInput.value.trim();
        const email = emailInput.value.trim();
        const password = passwordInput.value.trim();
        const confirmPassword = confirmPasswordInput.value.trim();

        if (name === '' || email === '' || password === '' || confirmPassword === '') {
            errorMessage.textContent = 'Por favor, completa todos los campos.';
            errorMessage.style.display = 'block';
        } else if (password !== confirmPassword) {
            errorMessage.textContent = 'Las contraseñas no coinciden.';
            errorMessage.style.display = 'block';
        } else {
            errorMessage.style.display = 'none';
            // Aquí puedes agregar la lógica para enviar los datos del formulario
            // Por ejemplo, usar fetch para enviar los datos a un servidor
            alert('Registro exitoso');
        }
    });
});
