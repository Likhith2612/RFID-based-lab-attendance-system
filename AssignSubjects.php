<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOD Dashboard</title>
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
        .centered-nav {
            text-align: center;
            margin-top: 30px;
        }
        ul {
            display: inline-block;
            list-style-type: none;
            margin: 0;
            padding: 0;
            background-color: #333;
        }
        li {
            float: left;
        }
        li a {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }
        li a:hover:not(.active) {
            background-color: #111;
        }
        .active {
            background-color: #4CAF50;
        }
        .title {
            text-align: center;
            color: white;
            margin-top: 20px;
            font-size: 28px;
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            color: white;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #000;
        }
        input, input[type="date"], input[type="time"], input[type="text"], input[type="file"] {
            background: transparent;
            border: none;
            color: white;
            width: 100%;
        }
          .add-row-button, .submit-button {
            width: 150px;
            padding: 10px;
            margin: 20px auto;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            display: block;
        }
        .submit-button {
            background-color: #2196F3;
        }

        /* Centering form controls */
        form > button, form > input[type=submit] {
            display: block;
            margin: 20px auto;
        }

        table {
            margin: auto;
        }
    </style>
</head>
<body>

<div class="title">HOD Dashboard - Assign Subjects</div>

<div class="centered-nav">
    <ul>
        <li><a href="Configuration.php">Configuration</a></li>
        <li><a class="active" href="AssignSubjects.php">Assign Subjects</a></li>
        <li><a href="AssignLabs.php">Assign Labs</a></li>
        <li><a href="Issues.php">Issues</a></li>
        <li><a href="Maintenance.php">Maintenance</a></li>
		<li><a href="Timetable.php">Time table</a></li>
    </ul>
</div>

<h2>Assign Subjects</h2>
<form action="submit_assign_subjects.php" method="POST" enctype="multipart/form-data">
    <table id="subjectTable">
        <thead>
            <tr>
                <th>Sl. No</th>
                <th>Semester</th>
                <th>Subject Name</th>
                <th>Subject Code</th>
                <th>Professor</th>
                <th>Syllabus</th>
                <th>Manual</th>
            </tr>
        </thead>
        <tbody>
            <!-- Rows will be inserted by JavaScript -->
        </tbody>
    </table>
    <button type="button" class="add-row-button" onclick="addRow()">Add New Row</button>
    <input type="submit" class="submit-button" value="Submit Subjects">
</form>

<script>
    let subjectNames = ["Digital Signal Processing", "Microprocessors", "VLSI Design"];
    let professors = ["Dr. Amit", "Dr. Sunita"];
    const semesters = ["1", "2", "3", "4", "5", "6", "7", "8"];

    function addRow() {
        const table = document.getElementById("subjectTable").getElementsByTagName('tbody')[0];
        const newRow = table.insertRow(-1);
        const slNo = table.rows.length;

        newRow.insertCell(0).innerText = slNo;

        addDropdownCell(newRow, 1, semesters, 'semester[]', false);
        addDropdownCell(newRow, 2, subjectNames, 'subject_name[]', true);
        newRow.insertCell(3).appendChild(createTextInput('subject_code[]'));
        addDropdownCell(newRow, 4, professors, 'professor[]', true);

        addFileInputCell(newRow, 5, "syllabus[]", ".pdf");
        addFileInputCell(newRow, 6, "manual[]", ".pdf");
    }

    function createTextInput(name) {
        const input = document.createElement("input");
        input.name = name;
        return input;
    }

    function addDropdownCell(row, index, optionsArray, name, addNewOption) {
        const cell = row.insertCell(index);
        const select = document.createElement("select");
        select.name = name;
        optionsArray.forEach(optionText => {
            const option = new Option(optionText, optionText);
            select.options.add(option);
        });

        if (addNewOption) {
            const addNew = new Option("Add New...", "Add New...");
            select.options.add(addNew);
            select.onchange = function() {
                if (this.value === "Add New...") {
                    const newItem = prompt("Enter new item:");
                    if (newItem) {
                        const newOption = new Option(newItem, newItem);
                        this.options.add(newOption, this.options.length-1);
                        this.value = newItem;
                        if (name.includes("subject_name")) {
                            subjectNames.push(newItem);
                        } else if (name.includes("professor")) {
                            professors.push(newItem);
                        }
                    } else {
                        this.value = this.options[0].value; // Revert to first option if cancelled
                    }
                }
            };
        }

        cell.appendChild(select);
    }

    function addFileInputCell(row, index, name, accept) {
        const cell = row.insertCell(index);
        const input = document.createElement("input");
        input.type = "file";
        input.name = name;
        input.accept = accept;
        cell.appendChild(input);
    }

    window.onload = addRow;
</script>
