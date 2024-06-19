<?php 
    require_once("config.php");

    $firstDayOfMonth = date("Y-m-01"); // Corrected for consistency
    $totalDaysInMonth = date("t", strtotime($firstDayOfMonth));
   
    // Fetching Students
    $fetchingStudents = mysqli_query($db, "SELECT * FROM attendance_students") OR die(mysqli_error($db));
    $totalNumberOfStudents = mysqli_num_rows($fetchingStudents);

    $studentsNamesArray = array();
    $studentsUSNArray = array(); // Array to hold USNs
    $counter = 0;
    while($students = mysqli_fetch_assoc($fetchingStudents))
    {
        $studentsNamesArray[] = $students['student_name'];
        $studentsUSNArray[] = $students['student_usn']; // Assume 'student_usn' is your column name
    }
?>

<table border="1" cellspacing="0">
<?php 
    for($i = 1; $i <= $totalNumberOfStudents + 2; $i++)
    {
        if($i == 1)
        {
            echo "<tr>";
            echo "<td rowspan='2'>Student</td>"; // Header adjusted to 'Student'
            for($j = 1; $j <= $totalDaysInMonth; $j++)
            {
                echo "<td>$j</td>";
            }
            echo "</tr>";
        }
        else if($i == 2)
        {
            echo "<tr>";
            for($j = 0; $j < $totalDaysInMonth; $j++)
            {
                echo "<td>" . date("D", strtotime("+$j days", strtotime($firstDayOfMonth))) . "</td>";
            }
            echo "</tr>";
        }
        else 
        {
            echo "<tr>";
            // Displaying student name and USN together
            echo "<td>" . $studentsNamesArray[$counter] . " (USN: " . $studentsUSNArray[$counter] . ")</td>";
            for($j = 1; $j <= $totalDaysInMonth; $j++)
            {
                $dateOfAttendance = date("Y-m-$j");
                $fetchingStudentsAttendance = mysqli_query($db, "SELECT attendance FROM attendance WHERE student_usn = '". $studentsUSNArray[$counter] ."' AND curr_date = '". $dateOfAttendance ."'") OR die(mysqli_error($db));
                
                $isAttendanceAdded = mysqli_num_rows($fetchingStudentsAttendance);
                if($isAttendanceAdded > 0)
                {
                    $studentAttendance = mysqli_fetch_assoc($fetchingStudentsAttendance);
                    // Assuming 'attendance' can be 'P', 'A', 'L', 'H'
                    $colorMap = ['P' => 'green', 'A' => 'red', 'L' => 'brown', 'H' => 'blue'];
                    $color = isset($colorMap[$studentAttendance['attendance']]) ? $colorMap[$studentAttendance['attendance']] : 'transparent';
                    echo "<td style='background-color: $color; color: white'>" . $studentAttendance['attendance'] . "</td>";
                }
                else {
                    echo "<td></td>";
                }
            }
            echo "</tr>";
            $counter++;
        }
    }
?>
</table>
