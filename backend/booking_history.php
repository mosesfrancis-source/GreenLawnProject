<?php
session_start();
require_once __DIR__ . '/db.php';

if (empty($_SESSION['user_id'])) {
    header('Location: ../frontend/index.php');
    exit;
}

$mysqli = db_connect();
$user_id = $_SESSION['user_id'];

$stmt = $mysqli->prepare('SELECT b.id, s.name AS service_name, b.service_date, b.status, b.created_at FROM bookings b JOIN services s ON b.service_id = s.id WHERE b.user_id = ? ORDER BY b.created_at DESC');
$stmt->bind_param('i', $user_id);
$stmt->execute();
$res = $stmt->get_result();

?>
<?php include_once __DIR__ . '/../frontend/header.php'; ?>
<div class="container">
    <h2>Your Bookings</h2>
    <table>
        <thead>
            <tr>
                <th>Service</th>
                <th>Date</th>
                <th>Status</th>
                <th>Requested</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $res->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['service_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['service_date']); ?></td>
                    <td><?php echo htmlspecialchars($row['status']); ?></td>
                    <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
<?php include_once __DIR__ . '/../frontend/footer.php'; ?>