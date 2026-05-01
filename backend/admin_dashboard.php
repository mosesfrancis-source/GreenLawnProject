<?php
session_start();
require_once __DIR__ . '/db.php';

if (empty($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    header('HTTP/1.1 403 Forbidden');
    echo 'Access denied';
    exit;
}

$mysqli = db_connect();
$res = $mysqli->query('SELECT b.id, u.username, s.name AS service_name, b.service_date, b.status, b.created_at FROM bookings b JOIN users u ON b.user_id = u.id JOIN services s ON b.service_id = s.id ORDER BY b.created_at DESC');

?>
<?php include_once __DIR__ . '/../frontend/header.php'; ?>
<div class="container">
    <h2>Admin Dashboard - Bookings</h2>
    <table>
        <thead>
            <tr>
                <th>User</th>
                <th>Service</th>
                <th>Date</th>
                <th>Status</th>
                <th>Requested</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $res->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['username']); ?></td>
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