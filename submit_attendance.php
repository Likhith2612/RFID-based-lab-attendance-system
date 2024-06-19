<?php
// get_students.php

header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login_page";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT Student_name, USN_NO, Day1, Day2, Day3, Day4, Day5, Day6, Day7, Day8, Day9, Day10,TOTAL_percentage FROM student_attendance";
$result = $conn->query($sql);

$students = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $students[] = $row;
    }
    echo json_encode($students);
} else {
    echo json_encode([]);
}

$conn->close();

