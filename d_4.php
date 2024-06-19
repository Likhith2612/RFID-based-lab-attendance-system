<?php
// d_4.php - Connects to `timetable_table` and displays the timetable

// Database configuration
$servername = "localhost"; // Assuming you're running the database locally
$username = 'root';// Your MySQL username
$password = ''; // Your MySQL password
$dbname = 'login_page'; // Your database name

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$day = $_POST['day'];
$period = $_POST['period'];
$subject = $_POST['subject'];

if (!in_array($period, ['p1', 'p2', 'p3', 'p4', 'p5', 'p6'])) {
    die("Invalid period specified.");
}

$sql = "UPDATE timetable_table SET $period = ? WHERE day = ?";
$stmt = $conn->prepare($sql);
if ($stmt) {
    $stmt->bind_param("ss", $subject, $day);
    if ($stmt->execute()) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $stmt->error;
    }
    $stmt->close();
} else {
    echo "Error preparing statement: " . $conn->error;
}
$conn->close();
?>
