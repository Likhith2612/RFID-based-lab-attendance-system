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
		<li><a href="Attendance.php">Attendance</a></li>
        <li><a href="Materials.php">Materials</a></li>
        <li><a href="WorkDone.php">Work Done</a></li>
		<li><a href="student_info.php">student_info</a></li>
    </ul>
</nav>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login_page";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query for assign labs data
$sqlLabs = "SELECT semester, lab_name, lab_code, professor FROM assign_labs";
$resultLabs = $conn->query($sqlLabs);

// Query for assign subjects data
$sqlSubjects = "SELECT semester, subject_name, subject_code, professor, syllabus, manual FROM assign_subject";
$resultSubjects = $conn->query($sqlSubjects);

// Display assign labs data
if ($resultLabs !== false && $resultLabs->num_rows > 0) {
    echo "<h2>Assigned Labs</h2><table><tr><th>Semester</th><th>Lab Name</th><th>Lab Code</th><th>Professor</th></tr>";
    while($row = $resultLabs->fetch_assoc()) {
        echo "<tr><td>{$row["semester"]}</td><td>{$row["lab_name"]}</td><td>{$row["lab_code"]}</td><td>{$row["professor"]}</td></tr>";
    }
    echo "</table>";
} else {
    echo "<h2>Assigned Labs</h2><p>0 results</p>";
}

// Display assign subjects data
if ($resultSubjects !== false && $resultSubjects->num_rows > 0) {
    echo "<h2>Assigned Subjects</h2><table><tr><th>Semester</th><th>Subject Name</th><th>Subject Code</th><th>Professor</th></tr>";
    while($row = $resultSubjects->fetch_assoc()) {
        echo "<tr><td>{$row["semester"]}</td><td>{$row["subject_name"]}</td><td>{$row["subject_code"]}</td><td>{$row["professor"]}</td></tr>";
    }
    echo "</table>";
} else {
    echo "<h2>Assigned Subjects</h2><p>0 results</p>";
}

$conn->close();
?>

</body>
</html>
