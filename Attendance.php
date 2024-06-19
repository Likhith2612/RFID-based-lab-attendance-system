<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professor Dashboard - Attendance Tracker</title>
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

        .present, .absent {
            height: 20px;
            width: 20px;
            border-radius: 50%;
            display: inline-block;
        }
        .present { background-color: lightgreen; }
        .absent { background-color: #ffcccb; }
    </style>
</head>
<body>
<header>Professor Dashboard</header>

<nav>
    <ul>
        <li><a class="active" href="Attendance.php">Attendance</a></li>
        <li><a href="Materials.php">Materials</a></li>
        <li><a href="WorkDone.php">Work Done</a></li>
		<li><a href="student_info.php">student_info</a></li>
    </ul>
</nav>

<div class="title">Attendance Tracker</div>
<div style="text-align: center; margin-bottom: 20px;">
    <input type="text" id="studentNameInput" placeholder="Enter Student Name" />
    <input type="text" id="studentUSNInput" placeholder="Enter USN" />
    <button onclick="addStudent()">Add Student</button>
</div>
<table id="attendanceTable">
    <thead>
        <tr>
            <th>Student Name</th>
            <th>USN No</th>
            <!-- Dynamically add day columns here -->
            <th>Day 1</th><th>Day 2</th><th>Day 3</th><th>Day 4</th>
            <th>Day 5</th><th>Day 6</th><th>Day 7</th><th>Day 8</th>
            <th>Day 9</th><th>Day 10</th>
            <th>Total Percentage</th>
        </tr>
    </thead>
    <tbody>
        <!-- Students will be added dynamically -->
    </tbody>
</table>

<div style="text-align: center; margin-top: 20px;">
    <button onclick="printAttendanceSheet()">Print Attendance Sheet</button>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    loadAttendanceFromStorage();
});

function loadAttendanceFromStorage() {
    const storedData = JSON.parse(localStorage.getItem('attendanceData')) || [];
    storedData.forEach(student => addStudentToTable(student));
}

function addStudentToTable(student) {
    const tableBody = document.getElementById('attendanceTable').getElementsByTagName('tbody')[0];
    const row = tableBody.insertRow();
    let cell = row.insertCell();
    cell.textContent = student.student_name;

    cell = row.insertCell();
    cell.textContent = student.usn_no;

    // Loop through day columns
    for (let i = 0; i < student.days.length; i++) { // Adjust according to actual days
        cell = row.insertCell();
        const attendanceIndicator = document.createElement('div');
        attendanceIndicator.className = student.days[i] === 1 ? 'present' : 'absent';
        cell.appendChild(attendanceIndicator);
        cell.onclick = function() { toggleAttendance(this); };
    }

    cell = row.insertCell();
    cell.textContent = student.total_percentage + '%';
}

function addStudent() {
    const name = document.getElementById('studentNameInput').value;
    const usn = document.getElementById('studentUSNInput').value;

    if (!name || !usn) {
        alert('Please enter both student name and USN.');
        return;
    }

    const student = {
        student_name: name,
        usn_no: usn,
        days: Array(10).fill(0), // Initializes days with 0 (absent) for 10 days
        total_percentage: 0
    };

    addStudentToTable(student);
    saveStudentToStorage(student);

    document.getElementById('studentNameInput').value = '';
    document.getElementById('studentUSNInput').value = '';
}

function toggleAttendance(cell) {
    const row = cell.parentNode;
    const attendanceIndicator = cell.children[0];

    // Toggle class and update attendance
    if (attendanceIndicator.className === 'present') {
        attendanceIndicator.className = 'absent';
    } else {
        attendanceIndicator.className = 'present';
    }

    updateAttendancePercentage(row);
}

function updateAttendancePercentage(row) {
    const cells = row.getElementsByTagName('td');
    let presentCount = 0;

    // Assuming first 2 cells are name and USN, last cell is total percentage
    for (let i = 2; i < cells.length - 1; i++) {
        if (cells[i].children[0].className === 'present') presentCount++;
    }

    const totalPercentage = (presentCount / (cells.length - 3)) * 100;
    cells[cells.length - 1].textContent = totalPercentage.toFixed(2) + '%';

    saveAttendanceToStorage();
}

function saveStudentToStorage(student) {
    let storedData = JSON.parse(localStorage.getItem('attendanceData')) || [];
    storedData.push(student);
    localStorage.setItem('attendanceData', JSON.stringify(storedData));
}

function saveAttendanceToStorage() {
    const tableBody = document.getElementById('attendanceTable').getElementsByTagName('tbody')[0];
    const rows = tableBody.rows;
    const dataToUpdate = [];

    for (let i = 0; i < rows.length; i++) {
        const cells = rows[i].getElementsByTagName('td');
        const studentData = {
            student_name: cells[0].textContent,
            usn_no: cells[1].textContent,
            days: Array.from({length: cells.length - 3}, (_, index) =>
                cells[index + 2].children[0].className === 'present' ? 1 : 0
            ),
            total_percentage: parseFloat(cells[cells.length - 1].textContent)
        };
        dataToUpdate.push(studentData);
    }

    localStorage.setItem('attendanceData', JSON.stringify(dataToUpdate));
}

function printAttendanceSheet() {
    window.print();
}
</script>
</body>
</html>
