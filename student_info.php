<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professor Dashboard</title>
    <style>
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: Arial, sans-serif;
            background: linear-gradient(-45deg, #FF007A, #9C27B0, #2196F3, #FF007A);
            background-size: 400% 400%;
            animation: colorShift 15s ease infinite;
        }

        @keyframes colorShift {
            0% {background-position: 0% 50%;}
            50% {background-position: 100% 50%;}
            100% {background-position: 0% 50%;}
        }

        header {
            text-align: center;
            color: white;
            padding: 20px 0;
            font-size: 24px;
            font-weight: bold;
        }

        nav ul {
            display: flex;
            justify-content: center;
            list-style-type: none;
            margin: 0;
            padding: 0;
            background-color: #333;
        }

        nav ul li a {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        nav ul li a:hover:not(.active) {
            background-color: #111;
        }

        .active {
            background-color: #4CAF50;
        }

        .container {
            width: 80%;
            margin: auto;
            padding: 20px;
            color: white;
        }

        .info-form {
            margin-top: 20px;
            background-color: rgba(0,0,0,0.5);
            padding: 20px;
        }

        label, input, textarea, button {
            display: block;
            width: 100%;
            margin-top: 10px;
        }

        input, textarea {
            padding: 8px;
        }

        button {
            padding: 10px;
            background-color: lightgreen;
            color: black;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: darkgreen;
        }
    </style>
</head>
<body>
    <header>Professor Dashboard</header>

    <nav>
        <ul>
            <li><a href="Attendance.php">Attendance</a></li>
            <li><a href="Materials.php">Materials</a></li>
            <li><a href="WorkDone.php">Work Done</a></li>
            <li><a class="active" href="student_info.php">Student Info</a></li>
        </ul>
    </nav>
    <div class="container">
        <div class="title">Send Information to Students</div>
        <div class="info-form">
            <form id="infoForm">
                <label for="category">Category:</label>
                <select id="category" required>
                    <option value="Assignments">Assignments</option>
                    <option value="Placements">Placements</option>
                    <option value="Notes">Notes</option>
                    <option value="Announcements">Announcements</option>
                </select>

                <label for="subject">Subject:</label>
                <input type="text" id="subject" required>

                <label for="message">Message:</label>
                <textarea id="message" rows="4" required></textarea>

                <label for="link">Link (optional):</label>
                <input type="url" id="link">

                <label for="file">File (optional):</label>
                <input type="file" id="file">

                <button type="button" onclick="saveInfo()">Send Message</button>
            </form>
        </div>
    </div>
<script>
    let messages = JSON.parse(localStorage.getItem('professorMessages')) || [];

    function saveInfo() {
        const category = document.getElementById('category').value;
        const subject = document.getElementById('subject').value;
        const message = document.getElementById('message').value;
        const link = document.getElementById('link').value;
        const file = document.getElementById('file').value;

        const newMessage = {
            category, subject, message, link, file, time: new Date().toISOString(), read: false
        };
        messages.push(newMessage);
        localStorage.setItem('professorMessages', JSON.stringify(messages));
        alert('Message sent successfully!');
    }
</script>
</body>
</html>
