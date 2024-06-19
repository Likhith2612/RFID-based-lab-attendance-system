<?php
session_start(); // Start the session

$host = 'localhost';
$db = 'login_page';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
    // Removed "Connected successfully" message to avoid headers already sent error
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dept_id = $_POST['dept_id'];
    $email_id = $_POST['email_id'];
    $password = $_POST['password']; // Consider hashing in real applications

    $sql = "SELECT * FROM login_page_table WHERE dep_id = ? AND email_id = ? AND password = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$dept_id, $email_id, $password]);
    $user = $stmt->fetch();

    if ($user) {
        // Login success
        // Set session variables here as needed
        $_SESSION['user_id'] = $user['user_id']; // Example session variable

        // Redirect to the HOD dashboard page
        header('Location: Configuration.php'); // Ensure this is the correct path to your HOD dashboard page
        exit; // Important to prevent the script from continuing to run after the redirect
    } else {
        // Login failed
        echo "Login Failed: Invalid credentials!";
    }
}
?>
