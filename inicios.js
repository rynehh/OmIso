// script.js

document.addEventListener('DOMContentLoaded', () => {
    const buttons = document.querySelectorAll('.course-card button');

    buttons.forEach(button => {
        button.addEventListener('click', (event) => {
            const courseName = event.target.closest('.course-card').querySelector('h3').textContent;
            alert(`Has seleccionado el curso: ${courseName}`);
            // Aquí puedes agregar la lógica para manejar la compra del curso
            // Por ejemplo, redirigir a una página de pago o añadir el curso al carrito
        });
    });
});
/* Animación para el botón al hacer clic */
@keyframes buttonClick {
    from {
        transform: scale(1);
    }
    to {
        transform: scale(0.9);
    }
}

button.animate {
    animation: buttonClick 0.1s ease-in-out;
}
