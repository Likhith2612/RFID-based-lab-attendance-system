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

<div class="title">HOD Dashboard</div>
<div class="centered-nav">
    <ul>
        <li><a href="BooksIssued.php">Books Issued</a></li>
        <li><a href="IssuedList.php">Issued List</a></li>
        <li><a href="Maintenance.php">Maintenance</a></li>
    </ul>
</div>
