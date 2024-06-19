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
        .in-process {
            background-color: orange;
        }
        .class-taken {
            background-color: green;
        }
        .no-class {
            background-color: red;
        }
        #professor-info div {
            color: white; /* Match the dashboard text color */
            font-size: 20px; /* Slightly larger for visibility */
            padding: 5px; /* Spacing */
            text-align: center; /* Center-align the text */
        }
        #professor-info #professor-name span, #professor-info #current-time span {
            font-weight: bold; /* Make the dynamic parts stand out */
        }
    </style>
</head>
<body>
<div class="dashboard-header">Professor Dashboard</div>
<div class="centered-nav">
<nav>
    <ul>
        <li><a class="active" href="Timetable1.php">List</a></li>
        <li><a href="Attendance.php">Attendance</a></li>
        <li><a href="Materials.php">Materials</a></li>
        <li><a href="WorkDone.php">Work Done</a></li>
    </ul>
</nav>
    <!-- Nav