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
        .add-row-button {
            display: block;
            width: 20%;
            margin: 20px auto;
            padding: 10px;
            background-color: #2196F3;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>
<div class="title">HOD Dashboard - Issues</div>

<style>
    .centered-title {
        text-align: center;
    }
    .centered-nav ul {
        text-align: center;
        list-style-type: none;
        padding: 0;
    }
    .centered-nav ul li {
        display: inline;
        margin-right: 10px;
    }
    .centered-nav ul li a {
        text-decoration: none;
        color: blue;
    }
    .centered-nav ul li a.active {
        color: red;
    }
</style>

<div class="centered-nav">
    <ul>
        <li><a href="Configuration.php">Configuration</a></li>
        <li><a href="AssignSubjects.php">Assign Subjects</a></li>
        <li><a href="AssignLabs.php">Assign Labs</a></li>
        <li><a class="active" href="Issues.php">Issues</a></li>
        <li><a href="Maintenance.php">Maintenance</a></li>
        <li><a href="Timetable.php">Time table</a></li>
    </ul>
</div>

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

// Query for issues data
$sqlIssues = "SELECT date, time, Item, description, picture, to_whom FROM issuse_item_table";
$resultIssues = $conn->query($sqlIssues);

// Query for assign labs data
$sqlLabs = "SELECT semester, lab_name, lab_code, professor, manual FROM assign_labs";
$resultLabs = $conn->query($sqlLabs);

// Query for assign subjects data
$sqlSubjects = "SELECT semester, subject_name, subject_code, professor, syllabus FROM assign_subject";
$resultSubjects = $conn->query($sqlSubjects);

// Display issues data
if ($resultIssues !== false && $resultIssues->num_rows > 0) {
    echo "<h2 class='centered-title'>Issues</h2><table><tr><th>Date</th><th>Time</th><th>Item</th><th>Description</th><th>Picture</th><th>To Whom</th></tr>";
    while($row = $resultIssues->fetch_assoc()) {
        $imagePath = 'Downloads/images/' . $row["picture"];
        $imageToShow = file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $imagePath) ? $imagePath : 'Downloads/image.jpg';
        // Display image and provide a download link
        echo "<tr>
                <td>{$row["date"]}</td>
                <td>{$row["time"]}</td>
                <td>{$row["Item"]}</td>
                <td>{$row["description"]}</td>
                <td>
                    <a href='{$imageToShow}' download>Download Image</a>
                </td>
                <td>{$row["to_whom"]}</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "<h2 class='centered-title'>Issues</h2><p>0 results</p>";
}

// Display assign labs data
if ($resultLabs !== false && $resultLabs->num_rows > 0) {
    echo "<h2 class='centered-title'>Assigned Labs</h2><table><tr><th>Semester</th><th>Lab Name</th><th>Lab Code</th><th>Professor</th><th>Manual</th></tr>";
    while($row = $resultLabs->fetch_assoc()) {
        $manualPath = 'Downloads/pdfs/' . $row["manual"];
        $manualToShow = file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $manualPath) ? $manualPath : 'Downloads/default_manual.pdf';
        echo "<tr><td>{$row["semester"]}</td><td>{$row["lab_name"]}</td><td>{$row["lab_code"]}</td><td>{$row["professor"]}</td>
        <td><a href='{$manualToShow}' download>Download Manual</a></td></tr>";
    }
    echo "</table>";
} else {
    echo "<h2 class='centered-title'>Assigned Labs</h2><p>0 results</p>";
}

// Display assign subjects data
if ($resultSubjects !== false && $resultSubjects->num_rows > 0) {
    echo "<h2 class='centered-title'>Assigned Subjects</h2><table><tr><th>Semester</th><th>Subject Name</th><th>Subject Code</th><th>Professor</th><th>Syllabus</th></tr>";
    while($row = $resultSubjects->fetch_assoc()) {
        $syllabusPath = 'Downloads/pdfs/' . $row["syllabus"];
        $syllabusToShow = file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $syllabusPath) ? $syllabusPath : 'Downloads/default_syllabus.pdf';
        echo "<tr><td>{$row["semester"]}</td><td>{$row["subject_name"]}</td><td>{$row["subject_code"]}</td><td>{$row["professor"]}</td>
        <td><a href='{$syllabusToShow}' download>Download Syllabus</a></td></tr>";
    }
    echo "</table>";
} else {
    echo "<h2 class='centered-title'>Assigned Subjects</h2><p>0 results</p>";
}

$conn->close();
?>

