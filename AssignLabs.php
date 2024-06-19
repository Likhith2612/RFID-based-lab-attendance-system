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
    </style>
</head>
<body>

<div class="title">HOD Dashboard - Assign Labs</div>

<div class="centered-nav">
    <ul>
        <li><a href="Configuration.php">Configuration</a></li>
        <li><a href="AssignSubjects.php">Assign Subjects</a></li>
        <li><a class="active" href="AssignLabs.php">Assign Labs</a></li>
        <li><a href="Issues.php">Issues</a></li>
        <li><a href="Maintenance.php">Maintenance</a></li>
		<li><a href="Timetable.php">Time table</a></li>
    </ul>
</div>
</div>
<div class="title">Assign Labs</div>

<form method="POST" action="submit_assign_labs.php" enctype="multipart/form-data">
    <table id="labsTable">
        <thead>
            <tr>
                <th>Sl. No</th>
                <th>Semester</th>
                <th>Lab Name</th>
                <th>Lab Code</th>
                <th>Professor</th>
                <th>Instructor</th>
                <th>Syllabus</th>
                <th>Manual</th>
            </tr>
        </thead>
        <tbody>
            <!-- Initial row added on page load -->
        </tbody>
    </table>

    <button type="button" class="add-row-button" onclick="addRow()">Add New Row</button>
    <input type="submit" value="Submit Labs" class="submit-button">
</form>

<script>
// Define your initial data arrays
const labNames = ["Digital Electronics Lab", "Microprocessors Lab", "VLSI Design Lab", "Add New"];
const professors = ["Dr. Amit", "Dr. Sunita", "Add New"];
const instructors = ["Rajesh", "Priya", "Add New"];
const semesters = ["1", "2", "3", "4", "5", "6", "7", "8"];

// Functions to add rows, dropdown cells, and handle "Add New" option
function addRow() {
    const table = document.getElementById("labsTable").getElementsByTagName('tbody')[0];
    const newRow = table.insertRow();
    const slNo = table.getElementsByTagName('tr').length + 1;

    newRow.insertCell(0).innerText = slNo;
    addDropdownCell(newRow, 1, semesters, "semester");
    addDropdownCellWithAddNew(newRow, 2, labNames, "lab_name"); // Modified to support "Add New" for lab names
    newRow.insertCell(3).innerHTML = '<input type="text" name="lab_code[]">';
    addDropdownCell(newRow, 4, professors, "professor");
    addDropdownCell(newRow, 5, instructors, "instructor");
    newRow.insertCell(6).innerHTML = '<input type="file" name="syllabus[]" accept=".pdf">';
    newRow.insertCell(7).innerHTML = '<input type="file" name="manual[]" accept=".pdf">';
}

function addDropdownCell(row, index, optionsArray, name) {
    const cell = row.insertCell(index);
    const select = document.createElement("select");
    select.name = name + "[]";
    optionsArray.forEach(optionText => {
        const option = new Option(optionText, optionText);
        select.options.add(option);
    });
    select.onchange = () => handleNewOption(select, optionsArray);
    cell.appendChild(select);
}

// Modified to support adding new lab names
function addDropdownCellWithAddNew(row, index, optionsArray, name) {
    addDropdownCell(row, index, optionsArray, name); // Use the same function but with additional steps for new items
}

function handleNewOption(select, optionsArray) {
    if (select.value === "Add New") {
        const newName = prompt("Enter the new name:");
        if (newName && !optionsArray.includes(newName)) {
            optionsArray.splice(optionsArray.length - 1, 0, newName); // Add new name before "Add New"
            const newOption = new Option(newName, newName);
            select.add(newOption, select.options.length - 2);
            select.value = newName;
        } else {
            select.value = select.options[0].value; // Reset to first option if cancelled or duplicate
        }
    }
}

// Ensure the initial row is added once the document loads
window.onload = addRow;
</script>

</body>
</html>