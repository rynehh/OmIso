document.addEventListener("DOMContentLoaded", () => {
    const chatMessages = document.getElementById("chat-messages");
    const messageInput = document.getElementById("message-input");
    const sendMessageButton = document.getElementById("send-message");
    const userButtons = document.querySelectorAll(".user-btn");
    let selectedUserId = null;

    // Función para cargar el historial de mensajes
    const fetchMessages = () => {
        if (!selectedUserId) return;

        fetch("00cargar_historial.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ destinatario: selectedUserId }),
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.error) {
                    console.error("Error al cargar mensajes:", data.error);
                    return;
                }

                // Limpiar mensajes previos
                chatMessages.innerHTML = "";
                if (data.length === 0) {
                    chatMessages.innerHTML = "<p>No hay mensajes todavía.</p>";
                } else {
                    data.forEach((message) => {
                        const messageElement = document.createElement("div");
                        messageElement.className =
                            message.REMITENTE === selectedUserId ? "message other" : "message self";

                        const name = document.createElement("span");
                        name.className = "message-name";
                        name.textContent =
                            message.REMITENTE === selectedUserId
                                ? message.NOMBRE_REMITENTE
                                : "Tú";

                        const text = document.createElement("p");
                        text.textContent = message.TEXT;

                        messageElement.appendChild(name);
                        messageElement.appendChild(text);
                        chatMessages.appendChild(messageElement);
                    });
                }
                chatMessages.scrollTop = chatMessages.scrollHeight; // Desplazar hacia abajo
            })
            .catch((err) => console.error("Error al cargar historial:", err));
    };

    // Enviar mensaje
    sendMessageButton.addEventListener("click", () => {
        const message = messageInput.value.trim();
        if (!message || !selectedUserId) {
            alert("Por favor selecciona un usuario y escribe un mensaje.");
            return;
        }

        fetch("00enviar_mensaje.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ destinatario: selectedUserId, mensaje: message }),
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.error) {
                    alert("Error al enviar mensaje: " + data.error);
                } else {
                    messageInput.value = ""; // Limpiar el campo de entrada
                    fetchMessages(); // Actualizar mensajes
                }
            })
            .catch((err) => console.error("Error al enviar mensaje:", err));
    });

    // Manejar selección de usuario
    userButtons.forEach((button) => {
        button.addEventListener("click", () => {
            selectedUserId = button.getAttribute("data-id");
            document.getElementById("chat-title").textContent = `Chat con ${button.textContent}`;
            fetchMessages(); // Cargar historial al seleccionar un usuario
        });
    });

    // Configurar actualización en tiempo real
    setInterval(fetchMessages, 3000); // Actualizar cada 3 segundos
});
