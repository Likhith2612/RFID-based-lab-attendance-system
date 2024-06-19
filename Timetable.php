<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOD Dashboard - Timetable</title>
    <style>
        body, html {
            margin: 0;
            padding: 0;
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
        .dashboard-header {
            text-align: center;
            color: white;
            margin-top: 20px;
            font-size: 28px;
        }
        .centered-nav {
            text-align: center;
            margin-top: 10px;
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
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            color: white;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #000;
        }
        .break {
            background-color: #555; /* Distinguish break periods */
        }
        td.period {
            min-width: 100px; /* Ensure a consistent width for period cells */
        }
    </style>
</head>
<body>
<div class="dashboard-header">HOD Dashboard</div>
<div class="centered-nav">
    <ul>
        <li><a href="Configuration.php">Configuration</a></li>
        <li><a href="AssignSubjects.php">Assign Subjects</a></li>
        <li><a href="AssignLabs.php">Assign Labs</a></li>
        <li><a href="Issues.php">Issues</a></li>
        <li><a href="Maintenance.php">Maintenance</a></li>
        <li><a class="active" href="Timetable.php">Timetable</a></li>
    </ul>
</div>
<table id="timetable">
    <tr>
        <th></th> <!-- Corner cell -->
        <th class="period" data-period="1">1st Period</th>
        <th class="period" data-period="2">2nd Period</th>
        <th>Break</th>
        <th class="period" data-period="3">3rd Period</th>
        <th class="period" data-period="4">4th Period</th>
        <th>Break</th>
        <th class="period" data-period="5">5th Period</th>
        <th class="period" data-period="6">6th Period</th>
    </tr>
    <!-- Days -->
    <tr data-day="Monday"><th>Monday</th><td></td><td></td><td class="break"></td><td></td><td></td><td class="break"></td><td></td><td></td></tr>
    <tr data-day="Tuesday"><th>Tuesday</th><td></td><td></td><td class="break"></td><td></td><td></td><td class="break"></td><td></td><td></td></tr>
    <tr data-day="Wednesday"><th>Wednesday</th><td></td><td></td><td class="break"></td><td></td><td></td><td class="break"></td><td></td><td></td></tr>
    <tr data-day="Thursday"><th>Thursday</th><td></td><td></td><td class="break"></td><td></td><td></td><td class="break"></td><td></td><td></td></tr>
    <tr data-day="Friday"><th>Friday</th><td></td><td></td><td class="break"></td><td></td><td></td><td class="break"></td><td></td><td></td></tr>
    <tr data-day="Saturday"><th>Saturday</th><td></td><td></td><td class="break"></td><td></td><td></td><td class="break"></td><td></td><td></td></tr>
</table>

<script>
document.addEventListener("DOMContentLoaded", function() {
    loadTimetable();
    
    // Attaching click listeners to all cells, including breaks
    document.querySelectorAll("#timetable td").forEach(cell => {
        cell.addEventListener("click", function() {
            const day = this.parentNode.dataset.day; // Identifying the day from the parent row's data-day attribute
            const cellIndex = this.cellIndex; // Cell index to uniquely identify the cell in the row
            
            // Using day and cellIndex to form a unique key for each cell
            const key = `timetable-${day}-${cellIndex}`;
            const existingContent = localStorage.getItem(key) || "";
            const content = prompt("Enter the content for this cell:", existingContent);

            if (content !== null && content.trim() !== "") {
                this.innerText = content;
                localStorage.setItem(key, content); // Saving the content in localStorage
            }
        });
    });
});

function loadTimetable() {
    document.querySelectorAll("#timetable tr[data-day]").forEach(row => {
        const day = row.dataset.day;
        [...row.cells].forEach((cell, cellIndex) => {
            // Using day and cellIndex to form a unique key for each cell
            const key = `timetable-${day}-${cellIndex}`;
            const value = localStorage.getItem(key);
            if (value) {
                cell.innerText = value;
            }
        });
    });
}
</script>
