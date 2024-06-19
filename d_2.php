<?php
session_start(); // Start the session

$host = 'localhost';
$db = 'login_page';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

if (isset($_POST['Dep_id']) && isset($_POST['Email_id']) && isset($_POST['Password'])) {
    $depId = $_POST['Dep_id'];
    $email = $_POST['Email_id'];
    $password = $_POST['Password'];
    $phone = $_POST['phone'] ?? ''; // Using null coalescing operator in case 'phone' field is optional

    $sql = "SELECT * FROM login_page_profssor_table WHERE Dep_id = ? AND Email_id = ? AND Password = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$depId, $email, $password]);
    $user = $stmt->fetch();

    if ($user) {
        // Login success
        // Set session variables here as needed
        $_SESSION['user_id'] = $user['user_id']; // Example session variable

        // Redirect to the professor dashboard page
        header('Location: pho.php'); // Ensure this is the correct path to your professor dashboard page
        exit; // Important to prevent the script from continuing to run after the redirect
    } else {
        // Login failed
        echo "Login Failed: Invalid credentials!";
    }
} else {
    // One or more required fields are missing
    echo "Please make sure all required fields are filled out.";
}
?>
