<?php
session_start(); // Start the session

$host = 'localhost';
$db = 'login_page'; // Ensure your database name is correct
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
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_inst = $_POST['id_inst'] ?? '';
    $email_inst = $_POST['email_inst'] ?? '';
    $password_inst = $_POST['password_inst'] ?? '';

    // Adjust your SELECT query to match the actual table and column names
    $sql = "SELECT * FROM inst_login WHERE id_inst = ? AND email_inst = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id_inst, $email_inst]);
    $user = $stmt->fetch();

    if ($user) {
        // Verify password (assuming you're hashing passwords on registration)
        if (password_verify($password_inst, $user['password_inst'])) {
            // Password is correct, login success
            $_SESSION['user_id'] = $user['id_inst']; // Set session variables as needed

            // Redirect to the dashboard or relevant page
            header('Location: instructor_page.php'); // Make sure the path is correct
            exit;
        } else {
            // Password does not match
            echo "Login Failed: Invalid credentials!";
        }
    } else {
        // No user found with the given id_inst and email_inst
        echo "Login Failed: Invalid credentials!";
    }
}
?>
