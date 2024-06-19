<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard - Message Viewer</title>
    <style>
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: Arial, sans-serif;
            background: linear-gradient(45deg, #FF007A, #9C27B0, #2196F3, #FF007A);
            background-size: 400% 400%;
            animation: colorShift 15s ease infinite;
        }

        @keyframes colorShift {
            0% {background-position: 100% 50%;}
            50% {background-position: 0% 50%;}
            100% {background-position: 100% 50%;}
        }

        header {
            text-align: center;
            color: white;
            padding: 20px 0;
            font-size: 24px;
            font-weight: bold;
        }

        .message-container {
            width: 80%;
            margin: 20px auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.2);
            color: white;
            border-radius: 10px;
        }

        .message {
            margin-bottom: 20px;
            padding: 10px;
            background-color: rgba(0, 0, 0, 0.5);
            border-radius: 5px;
        }

        nav button {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 10px 20px;
            margin: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        nav button:hover {
            background-color: #45a049;
        }

        .unread-indicator {
            color: red;
            font-weight: bold;
            margin-left: 8px;
        }
    </style>
</head>
<body>
<header>Student Dashboard</header>
<div class="message-container">
    <h1>Messages from Professor</h1>
    <nav>
        <button onclick="filterMessages('Assignments')">Assignments <span class="unread-indicator" id="unread-Assignments"></span></button>
<button onclick="filterMessages('Placements')">Placements <span class="unread-indicator" id="unread-Placements"></span></button>
<button onclick="filterMessages('Notes')">Notes <span class="unread-indicator" id="unread-Notes"></span></button>
<button onclick="filterMessages('Announcements')">Announcements <span class="unread-indicator" id="unread-Announcements"></span></button>

    </nav>
    <div id="messages"></div>
</div>

<script>
    let messages = JSON.parse(localStorage.getItem('professorMessages')) || [];

    function updateUnreadCounts() {
    const categories = ['Assignments', 'Placements', 'Notes', 'Announcements'];
    categories.forEach(category => {
        const hasUnread = messages.some(msg => msg.category === category && !msg.read);
        const indicator = document.getElementById(`unread-${category}`);
        indicator.textContent = hasUnread ? "New!" : '';
    });
}


    function filterMessages(category) {
        const filteredMessages = messages.filter(msg => msg.category === category);
        const messagesDiv = document.getElementById('messages');
        messagesDiv.innerHTML = '';

        if (filteredMessages.length > 0) {
            filteredMessages.forEach(info => {
                const messageElem = document.createElement('div');
                messageElem.classList.add('message');
                messageElem.innerHTML = `<h2>${info.subject}</h2>
                                         <p>${info.message}</p>
                                         ${info.link ? `<a href="${info.link}" target="_blank">Link</a>` : ''}
                                         ${info.fileName ? `<a href="download/${info.fileName}" download>Download File</a>` : ''}
                                         <p><small>Sent on: ${info.time}</small></p>`;
                messagesDiv.appendChild(messageElem);
                info.read = true; // Marking message as read
            });
            localStorage.setItem('professorMessages', JSON.stringify(messages)); // Save updated state
        } else {
            messagesDiv.innerHTML = '<p>No messages found.</p>';
        }
        updateUnreadCounts();
    }

    window.onload = function() {
        updateUnreadCounts();
    };
</script>
</body>
</html>
