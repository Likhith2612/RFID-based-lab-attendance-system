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
            <li><a class="active" href="Materials.php">Materials</a></li>
            <li><a href="WorkDone.php">Work Done</a></li>
            <li><a href="student_info.php">student_info</a></li>
        </ul>
    </nav>

    <div class="container">
        <div class="title">Manage Materials</div>
        <div class="info-form">
            <form id="materialForm">
                <label for="materialName">Material Name:</label>
                <input type="text" id="materialName" required>

                <label for="materialType">Material Type:</label>
                <select id="materialType" required>
                    <option value="pdf">PDF</option>
                    <option value="doc">DOC</option>
                    <option value="image">Image</option>
                </select>

                <label for="materialFile">Upload Material:</label>
                <input type="file" id="materialFile" required>

                <button type="button" onclick="addMaterial()">Add Material</button>
                <button type="button" onclick="deleteMaterial()">Delete Material</button>
            </form>
        </div>

        <div class="title">Stored Materials</div>
        <div id="storedMaterials"></div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            displayStoredMaterials();
        });

        function addMaterial() {
            const materialName = document.getElementById('materialName').value;
            const materialType = document.getElementById('materialType').value;
            const materialFile = document.getElementById('materialFile').files[0];
            const currentTime = new Date().toISOString();
            
            // Save the material information to local storage
            const material = {
                name: materialName,
                type: materialType,
                file: materialFile.name, // Just storing the file name for simplicity
                time: currentTime
            };
            localStorage.setItem(materialName, JSON.stringify(material));

            // Display the newly added material
            displayStoredMaterials();
        }

        function deleteMaterial() {
            const materialName = document.getElementById('materialName').value;
            
            // Remove the material from local storage
            localStorage.removeItem(materialName);

            // Display the updated list of materials
            displayStoredMaterials();
        }

        function displayStoredMaterials() {
            const storedMaterialsDiv = document.getElementById('storedMaterials');
            storedMaterialsDiv.innerHTML = '';

            // Iterate through local storage and display each stored material
            for (let i = 0; i < localStorage.length; i++) {
                const key = localStorage.key(i);
                const material = JSON.parse(localStorage.getItem(key));

                const materialElem = document.createElement('div');
                materialElem.innerHTML = `<p><strong>Name:</strong> ${material.name}</p>
                                           <p><strong>Type:</strong> ${material.type}</p>
                                           <p><strong>File:</strong> <a href="${material.file}" target="_blank">${material.file}</a></p>
                                           <p><strong>Stored on:</strong> ${material.time}</p>`;
                storedMaterialsDiv.appendChild(materialElem);
            }
        }
    </script>
</body>
</html>