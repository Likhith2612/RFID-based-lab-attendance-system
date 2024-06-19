<form method="POST">
    <input type="text" name="student_name" placeholder="Student Name" required autofocus />
    <input type="text" name="student_usn" placeholder="Student USN" required />
    <input type="submit" value="Add Student" name="submit">
</form>

<?php 

    if(isset($_POST['submit'])) {
    require_once("config.php");
    
    // Escape user inputs for security
    $student_name = mysqli_real_escape_string($db, $_POST['student_name']);
    $student_usn = mysqli_real_escape_string($db, $_POST['student_usn']);
    
    // Attempt insert query execution
    $query = "INSERT INTO attendance_students(student_name, student_usn) VALUES ('$student_name', '$student_usn')";
    $execQuery = mysqli_query($db, $query) or die(mysqli_error($db));
    
    echo "Student has been added Successfully!";
}


?>