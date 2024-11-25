document.addEventListener("DOMContentLoaded", () => {
    const messageInput = document.getElementById("message-input");
    const sendMessageButton = document.getElementById("send-message");
    const chatMessages = document.getElementById("chat-messages");
    const userList = document.getElementById("user-list");
    let selectedUserId = null;

    // Función para manejar la selección de usuario
    const handleUserSelection = (btn) => {
        selectedUserId = btn.dataset.id;

        if (!selectedUserId) {
            alert("Error: No se seleccionó un usuario válido.");
            return;
        }

        // Cargar historial del chat
        fetch("00cargar_historial.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ destinatario: selectedUserId }),
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.error) {
                    alert("Error al cargar historial: " + data.error);
                } else {
                    chatMessages.innerHTML = ""; // Limpia los mensajes previos
                    if (data.length === 0) {
                        chatMessages.innerHTML = "<p>No hay mensajes todavía.</p>";
                    } else {
                        data.forEach((message) => {
                            const messageElement = document.createElement("div");
                            messageElement.className = "message";
                            messageElement.textContent = `${message.REMITENTE}: ${message.TEXT}`;
                            chatMessages.appendChild(messageElement);
                        });
                    }
                }
            })
            .catch((err) => console.error("Error al cargar historial:", err));
    };

    // Agregar evento de clic a cada botón de usuario
    document.querySelectorAll(".user-btn").forEach((btn) => {
        btn.addEventListener("click", () => handleUserSelection(btn));
    });

    // Enviar mensaje
    sendMessageButton.addEventListener("click", () => {
        const messageText = messageInput.value.trim();

        if (!messageText) {
            alert("Por favor escribe un mensaje.");
            return;
        }

        if (!selectedUserId) {
            alert("Por favor selecciona un usuario.");
            return;
        }

        fetch("00enviar_mensaje.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({
                destinatario: selectedUserId,
                mensaje: messageText,
            }),
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.error) {
                    alert("Error al enviar mensaje: " + data.error);
                } else {
                    const messageElement = document.createElement("div");
                    messageElement.className = "message self";
                    messageElement.textContent = `Tú: ${messageText}`;
                    chatMessages.appendChild(messageElement);
                    messageInput.value = ""; // Limpiar el campo de entrada
                }
            })
            .catch((err) => console.error("Error al enviar mensaje:", err));
    });
});
