<?php
require_once __DIR__ . '/db.php';

$mysqli = db_connect();
if (!$mysqli) die('Database connection error');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($username) || empty($email) || empty($password)) {
        die('Please provide username, email and password');
    }

    $hash = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $mysqli->prepare('INSERT INTO users (username, email, password) VALUES (?, ?, ?)');
    $stmt->bind_param('sss', $username, $email, $hash);
    if ($stmt->execute()) {
        header('Location: ../frontend/index.php');
        exit;
    } else {
        echo 'Registration failed: ' . $mysqli->error;
    }
}

?>
