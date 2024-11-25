document.addEventListener("DOMContentLoaded", () => {
    const userButtons = document.querySelectorAll(".user-btn");
    const chatTitle = document.getElementById("chat-title");
    const chatMessages = document.getElementById("chat-messages");
    const messageInput = document.getElementById("message-input");
    const sendMessageButton = document.getElementById("send-message");

    let selectedUserId = null;

    userButtons.forEach(button => {
        button.addEventListener("click", () => {
            selectedUserId = button.getAttribute("data-id");
            chatTitle.textContent = "Chat con " + button.textContent;

            // Cargar historial de mensajes
            fetch("00cargar_historial.php", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ destinatario: selectedUserId })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        alert("Error al cargar el historial: " + data.error);
                        return;
                    }

                    chatMessages.innerHTML = ""; // Limpiar mensajes previos
                    if (data.length === 0) {
                        chatMessages.innerHTML = "<p>No hay mensajes todavía.</p>";
                    } else {
                        data.forEach(message => {
                            const messageDiv = document.createElement("div");
                            messageDiv.textContent = `${message.REMITENTE}: ${message.TEXT}`;
                            chatMessages.appendChild(messageDiv);
                        });
                    }
                })
                .catch(error => console.error("Error al cargar el historial:", error));
        });
    });

    sendMessageButton.addEventListener("click", () => {
        const message = messageInput.value.trim();
        if (!message || !selectedUserId) {
            alert("Por favor selecciona un usuario y escribe un mensaje.");
            return;
        }

        fetch("00enviar_mensaje.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ destinatario: selectedUserId, mensaje: message })
        })
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    alert("Error al enviar mensaje: " + data.error);
                } else {
                    const messageDiv = document.createElement("div");
                    messageDiv.textContent = `Tú: ${message}`;
                    chatMessages.appendChild(messageDiv);
                    messageInput.value = "";
                }
            })
            .catch(error => console.error("Error al enviar mensaje:", error));
    });
});
