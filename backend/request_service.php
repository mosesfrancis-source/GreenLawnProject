<?php
// Simple service request endpoint: creates a booking with status 'requested'
session_start();
require_once __DIR__ . '/db.php';

if (empty($_SESSION['user_id'])) {
    http_response_code(401);
    echo 'Unauthorized';
    exit;
}

$mysqli = db_connect();
if (!$mysqli) { http_response_code(500); echo 'DB error'; exit; }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $service_id = intval($_POST['service_id'] ?? 0);
    $date = $_POST['service_date'] ?? null;
    $user_id = $_SESSION['user_id'];

    $stmt = $mysqli->prepare('INSERT INTO bookings (user_id, service_id, service_date, status, created_at) VALUES (?, ?, ?, ?, NOW())');
    $status = 'requested';
    $stmt->bind_param('iiss', $user_id, $service_id, $date, $status);
    if ($stmt->execute()) {
        header('Location: ../frontend/booking_history.php');
        exit;
    } else {
        echo 'Request failed: ' . $mysqli->error;
    }
}

?>
