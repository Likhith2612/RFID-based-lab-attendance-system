<?php
// Database configuration
$dbHost = 'localhost';
$dbUser = 'root';
$dbPass = '';
$dbName = 'login_page';

// Connect to the database
try {
    $pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Begin transaction
    $pdo->beginTransaction();

    for ($i = 0; $i < count($_POST['semester']); $i++) {
        $syllabusPath = uploadFile('syllabus', $i);
        $manualPath = uploadFile('manual', $i);

        // Adjusted INSERT query to match your table structure
        $sql = "INSERT INTO assign_subject (semester, subject_name, subject_code, professor, syllabus, manual) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        
        // Execute the query with values from the POST request and uploaded files
        $stmt->execute([
            $_POST['semester'][$i], 
            $_POST['subject_name'][$i], 
            $_POST['subject_code'][$i], 
            $_POST['professor'][$i], 
            $syllabusPath, 
            $manualPath
        ]);
    }

    // Commit transaction
    $pdo->commit();
    echo "Subjects successfully assigned.";
} catch (Exception $e) {
    // Rollback transaction in case of error
    $pdo->rollBack();
    echo "Error: " . $e->getMessage();
}

// The uploadFile function remains unchanged from your original script

// The uploadFile function remains unchanged from your original script
function uploadFile($fileKey, $index, $allowedTypes = ['pdf', 'doc', 'docx']) {
    $targetDir = "uploads/";
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true);
    }
    
    $fileName = basename($_FILES[$fileKey]["name"][$index]);
    $targetFilePath = $targetDir . uniqid() . "-" . $fileName;
    $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

    if (in_array($fileType, $allowedTypes)) {
        if (move_uploaded_file($_FILES[$fileKey]["tmp_name"][$index], $targetFilePath)) {
            return $targetFilePath; // Return the new path for database insertion
        } else {
            throw new Exception("Error uploading file: $fileName.");
        }
    } else {
        throw new Exception("Sorry, only PDF, DOC, and DOCX files are allowed.");
    }
}
?>

