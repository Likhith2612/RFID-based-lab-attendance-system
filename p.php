<?php
$Write="<?php $" . "UIDresult=''; " . "echo $" . "UIDresult;" . " ?>";
file_put_contents('UIDContainer.php',$Write);
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <title>Read Tag</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
    <script src="jquery.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .header {
            background-color: #f1f1f1;
            padding: 20px;
            text-align: center;
        }

        .header img {
            max-width: 300px;
            max-height: 300px;
        }

        .header h1 {
            margin: 10px 0 0;
        }

        .navbar {
            overflow: hidden;
            background-color: #333;
        }

        .navbar a {
            float: left;
            display: block;
            color: #f2f2f2;
            text-align: center;
            padding: 14px 20px;
            text-decoration: none;
        }

        .navbar a:hover {
            background-color: #ddd;
            color: black;
        }

        .main {
            padding: 20px;
            text-align: center;
        }

        .footer {
            background-color: #f1f1f1;
            padding: 20px;
            text-align: center;
            position: fixed;
            bottom: 0;
            width: 100%;
            left: 0;
            z-index: 999;
        }

        .footer p {
            margin: 0;
            font-size: 14px;
            color: #555;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #ddd;
            margin-bottom: 20px;
        }

        th, td {
            padding: 8px;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        button {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 15px 30px;
            text-align: center;
            text-decoration: none;
            display: block;
            margin: 20px auto;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
        }

        button:hover {
            background-color: #45a049;
        }

        .print-button {
            background-color: #008CBA;
        }

        .print-button:hover {
            background-color: #005A80;
        }

        #rfid_data {
            margin-top: 30px;
        }

        #rfid_data th, #rfid_data td {
            padding: 8px;
            border: 1px solid #ddd;
        }

        #rfid_data th {
            background-color: #f2f2f2;
        }

        #rfid_data tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="home.png" style="max-width: 300px; max-height: 300px;">
        <h1>Lab Component Access Management System</h1>
    </div>

    <div class="navbar">
        <a href="a_home.php">Home</a>
        <a href="read_page.php">LAB</a>
        <a href="data_log_sheet.php<?php echo isset($_GET['branch']) ? '?branch='.$_GET['branch'] : ''; ?><?php echo isset($_GET['semester']) ? '&semester='.$_GET['semester'] : ''; ?><?php echo isset($_GET['lab_instructor']) ? '&lab_instructor='.$_GET['lab_instructor'] : ''; ?><?php echo isset($_GET['lab_subject']) ? '&lab_subject='.$_GET['lab_subject'] : ''; ?>">Data sheet</a>
        <a href="read_tag.php">read tag</a>
    </div>

    <div class="main">
        <h3 align="center" id="blink">Please scan the Student ID</h3>
        
        <p id="getUID" hidden></p>
        
        <br>
        
        <div id="combined_data">
            <table id="combined_table">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>USN</th>
                    <th>Batch no.</th>
                </tr>
                <tr id="student_row">
                    <td colspan="4">No data found</td>
                </tr>
                <tr>
                    <th>ID_exp</th>
                    <th>Experiment Name</th>
                    <th>Experiment Number</th>
                    <th>Components</th>
                </tr>
                <tr id="experiment_row">
                    <td colspan="4">No data found</td>
                </tr>
            </table>
        </div>

        <button onclick="saveData()">Save Data</button>
        <button onclick="clearData()">Clear Data</button> <!-- Added clear button -->
        
        <div id="saved_data">
            <h3>Saved Data</h3>
            <table id="saved_table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>USN</th>
                        <th>Batch no.</th>
                        <th>ID_exp</th> <!-- Added ID_exp column -->
                        <th>Experiment Name</th>
                        <th>Experiment Number</th>
                        <th>Components</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Table rows for saved data will be populated here -->
                </tbody>
            </table>
            <button class="print-button" onclick="printData()">Print</button>
        </div>

        <!-- New table for displaying RFID data -->
        <div id="rfid_data">
            <h3>RFID Data</h3>
            <table id="rfid_table">
                <tr>
                    <th>RFID Tag</th>
                    <th>Data</th>
                </tr>
                <!-- Table rows for RFID data will be populated here -->
            </table>
        </div>
    </div>

    <script>
        var studentData = [];
        var experimentData = [];
        var dataDisplayed = false;

        function fetchStudentData(studentID) {
            $.ajax({
                url: 'read_tag_students.php',
                type: 'GET',
                data: { id: studentID },
                success: function(data) {
                    studentData = data.trim().split('\t');
                    $('#blink').html('Scan the experiment tag');
                    updateTable();
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching student data:', error);
                }
            });
        }

        function fetchExperimentData(experimentID) {
            $.ajax({
                url: 'read_tag_experiments.php',
                type: 'GET',
                data: { id: experimentID },
                success: function(data) {
                    experimentData = data.trim().split('\t');
                    if (!dataDisplayed) {
                        updateTable();
                        dataDisplayed = true;
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching experiment data:', error);
                }
            });
        }

        function updateTable() {
            $('#student_row').html('<td>' + (studentData.length > 0 ? studentData.join('</td><td>') : 'No data found') + '</td>');
            $('#experiment_row').html('<td>' + (experimentData.length > 0 ? experimentData.join('</td><td>') : 'No data found') + '</td>');
        }

        function saveData() {
            var combinedData = studentData.concat(experimentData);
            var savedList = JSON.parse(localStorage.getItem('savedData')) || [];
            savedList.push(combinedData);
            localStorage.setItem('savedData', JSON.stringify(savedList));
            updateSavedList();
        }

        function updateSavedList() {
            var savedList = JSON.parse(localStorage.getItem('savedData')) || [];
            var savedTable = $('#saved_table tbody');
            savedTable.empty(); // Clear previous rows

            savedList.forEach(function(data) {
                var row = '<tr>';
                data.forEach(function(value) {
                    row += '<td>' + value + '</td>';
                });
                row += '</tr>';
                savedTable.append(row);
            });
        }

        function clearData() {
            localStorage.removeItem('savedData');
            updateSavedList(); // Clear the table after removing data
        }

        function printData() {
            window.print();
        }

        $(document).ready(function() {
            $('#blink').html('Please Scan the Student ID');
            setInterval(function() {
                $("#getUID").load("UIDContainer.php");  
            }, 500);
            updateSavedList();
        });

        $('#getUID').on('DOMSubtreeModified', function() {
            var tagID = $('#getUID').text().trim();
            if (tagID !== '' && $('#blink').text().trim() === 'Please Scan the Student ID') {
                fetchStudentData(tagID);
            } else if (tagID !== '' && $('#blink').text().trim() === 'Scan the experiment tag') {
                fetchExperimentData(tagID);
            }
        });
    </script>

    <div class="footer">
        <p>© 2024 Lab Component Access Management System. All rights reserved.</p>
    </div>
</body>
</html>