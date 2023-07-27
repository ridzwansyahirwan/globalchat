const webSocket = new WebSocket('ws://localhost:8080');

webSocket.onmessage = (event) => {
    const messageContainer = document.getElementById('chat-messages');
    const messageElement = document.createElement('div');
    messageElement.textContent = event.data;
    messageContainer.appendChild(messageElement);
};

function sendMessage() {
    const messageInput = document.getElementById('message-input');
    const message = messageInput.value.trim();
    if (message !== '') {
        webSocket.send(message);
        messageInput.value = '';
    }
}
