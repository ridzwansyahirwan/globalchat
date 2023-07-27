<!DOCTYPE html>
<html>
<head>
    <title>Real-time Chat App</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="chat-container">
        <div class="chat-header">Chat Room</div>
        <div class="chat-messages" id="chat-messages"></div>
        <div class="chat-input">
            <input type="text" id="message-input" placeholder="Type your message...">
            <button onclick="sendMessage()">Send</button>
        </div>
    </div>
    <script src="js/chat.js"></script>
</body>
</html>
