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
            background: linear-gradient(-45deg, #EE7752, #E73C7E, #23A6D5, #23D5AB);
            background-size: 400% 400%;
            animation: colorShift 15s ease infinite;
        }
        @keyframes colorShift {
            0% {background-position: 0% 50%;}
            50% {background-position: 100% 50%;}
            100% {background-position: 0% 50%;}
        }
        header {
            color: white;
            padding: 20px;
            text-align: center;
            font-size: 24px;
            width: 100%;
            background-color: transparent; /* Adjusted for transparent header */
        }
        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background-color: #333; /* Restored the black background for the navbar */
            width: 100%;
        }
        nav ul li {
            float: left;
            width: 25%; /* Adjust if the number of items changes */
        }
        nav ul li a {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }
        nav ul li a:hover:not(.active) {
            background-color: #555; /* Lighter hover effect */
            color: white; /* Ensures text color remains white on hover */
        }
        .active {
            background-color: #4CAF50;
        }
    </style>
</head>
<body>

<header>Professor Dashboard</header>

<nav>
    <ul>
        <li><a href="Timetable.php">Timetable</a></li>
        <li><a href="Attendance.php">Attendance</a></li>
        <li><a href="Materials.php">Materials</a></li>
        <li><a class="active" href="WorkDone.php">Work Done</a></li>
    </ul>
</nav>

</body>
</html>