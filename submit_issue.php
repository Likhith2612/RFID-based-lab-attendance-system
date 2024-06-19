<?php
// Database connection variables
$servername = "localhost";
$username = "root";
$password = ""; // Your database password, if any.
$dbname = "login_page"; // Your database name.

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dates = $_POST['date'];
    $times = $_POST['time'];
    $items = $_POST['items'];
    $descriptions = $_POST['description'];
    $to_whoms = $_POST['to_whom']; // Assuming 'to_whom' is also part of your form

    for ($i = 0; $i < count($items); $i++) {
        // Prepare an insert statement
        $sql = "INSERT INTO issuse_item_table (date, time, Item, description, picture, to_whom) VALUES (?, ?, ?, ?, ?, ?)";

        if ($stmt = $conn->prepare($sql)) {
            // Handle the picture upload
            $picturePath = ''; // Default path or indication that no picture was uploaded
            if (isset($_FILES['picture']['name'][$i]) && $_FILES['picture']['error'][$i] == 0) {
                $targetDirectory = "uploads/"; // Ensure this directory exists and is writable
                $targetFile = $targetDirectory . basename($_FILES['picture']['name'][$i]);
                if (move_uploaded_file($_FILES['picture']['tmp_name'][$i], $targetFile)) {
                    $picturePath = $targetFile;
                } else {
                    // Handle error or set a default picture path
                    $picturePath = 'path/to/default/image.jpg';
                }
            }

            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("ssssss", $dates[$i], $times[$i], $items[$i], $descriptions[$i], $picturePath, $to_whoms[$i]);
            // Set parameters and execute
            if (!$stmt->execute()) {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Error preparing statement: " . $conn->error;
        }
    }

    echo "Records added successfully.";
}

$conn->close();
?>
