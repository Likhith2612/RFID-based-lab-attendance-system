<?php
// Database configuration
$dbHost = 'localhost'; // This should be the host of your database, often "localhost"
$dbUser = 'root';// Your database username
$dbPass = '';// Your database password
$dbName = 'login_page'; // Your database name

// Directory where uploaded files will be saved
$uploadDir = 'uploads/'; // Ensure this directory exists and is writable

// Ensure the uploads directory exists
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

try {
    // Establish database connection
    $pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Prepare SQL query to insert data into `assign_labs`
        $sql = "INSERT INTO assign_labs (semester, lab_name, lab_code, professor, instructor, syllabus, manual) VALUES (?, ?, ?, ?, ?, ?, ?)";

        // Start transaction
        $pdo->beginTransaction();

        // Prepare statement
        $stmt = $pdo->prepare($sql);

        // Retrieve form data
        $semesters = $_POST['semester'] ?? [];
        $labNames = $_POST['lab_name'] ?? [];
        $labCodes = $_POST['lab_code'] ?? [];
        $professors = $_POST['professor'] ?? [];
        $instructors = $_POST['instructor'] ?? [];

        $length = count($semesters);

        // Loop through each entry
        for ($i = 0; $i < $length; $i++) {
            // Handle file uploads for syllabus and manual
            $syllabusFilePath = handleFileUpload($_FILES['syllabus']['tmp_name'][$i], $_FILES['syllabus']['name'][$i], $uploadDir);
            $manualFilePath = handleFileUpload($_FILES['manual']['tmp_name'][$i], $_FILES['manual']['name'][$i], $uploadDir);

            // Bind values and execute
            $stmt->execute([
                $semesters[$i],
                $labNames[$i],
                $labCodes[$i],
                $professors[$i],
                $instructors[$i],
                $syllabusFilePath,
                $manualFilePath,
            ]);
        }

        // Commit transaction
        $pdo->commit();

        echo "Labs successfully assigned.";
    }
} catch (PDOException $e) {
    // Rollback transaction in case of error
    $pdo->rollBack();
    die("Error occurred: " . $e->getMessage());
}

function handleFileUpload($tmpName, $fileName, $uploadDir) {
    // Create a unique filename to prevent overwriting
    $newFileName = $uploadDir . uniqid() . '-' . basename($fileName);
    if (move_uploaded_file($tmpName, $newFileName)) {
        // Return the new file path if upload is successful
        return $newFileName;
    } else {
        // Handle upload error
        // Note: In a real application, consider throwing an exception or handling this error appropriately
        die("Error uploading file: " . $fileName);
    }
}
?>
