// Variables para manejar los usuarios y el chat
let activeUser = null;

// Función para cambiar el usuario activo
document.querySelectorAll(".user-btn").forEach(button => {
    button.addEventListener("click", function() {
        activeUser = this.getAttribute("data-username");
        document.getElementById("chat-username").textContent = activeUser;
        document.getElementById("messages").innerHTML = ''; // Limpiar los mensajes previos
    });
});

// Función para minimizar el chat sin desaparecer
document.getElementById("chat-header").addEventListener("click", function() {
    const chatBody = document.getElementById("chat-body");
    const toggleBtn = document.getElementById("chat-toggle");

    if (chatBody.classList.contains("minimized")) {
        chatBody.classList.remove("minimized");
        toggleBtn.textContent = "-";
    } else {
        chatBody.classList.add("minimized");
        toggleBtn.textContent = "+";
    }
});

// Función para minimizar la lista de usuarios sin desaparecer
document.getElementById("users-header").addEventListener("click", function() {
    const chatUsers = document.getElementById("chat-users");
    const toggleBtn = document.getElementById("users-toggle");

    if (chatUsers.classList.contains("minimized")) {
        chatUsers.classList.remove("minimized");
        toggleBtn.textContent = "-";
    } else {
        chatUsers.classList.add("minimized");
        toggleBtn.textContent = "+";
    }
});

// Función para enviar mensajes
document.getElementById("chat-form").addEventListener("submit", function(event) {
    event.preventDefault();

    const inputField = document.getElementById("chat-input");
    const messagesContainer = document.getElementById("messages");

    if (inputField.value.trim() !== "" && activeUser !== null) {
        const userMessage = document.createElement("div");
        userMessage.classList.add("message");
        userMessage.innerHTML = `<span><strong>Tú:</strong> ${inputField.value}</span>`;
        messagesContainer.appendChild(userMessage);
        inputField.value = "";
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    }
});
