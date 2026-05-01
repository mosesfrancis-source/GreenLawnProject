<?php
require_once __DIR__ . '/../backend/db.php';
$mysqli = db_connect();
if (!$mysqli) {
    echo '<p>Services unavailable</p>';
    return;
}

$res = $mysqli->query('SELECT id, name, description, price FROM services ORDER BY id ASC');
?>
<div class="services-list">
    <?php while ($s = $res->fetch_assoc()): ?>
        <div class="service-item">
            <h3><?php echo htmlspecialchars($s['name']); ?> - $<?php echo htmlspecialchars($s['price']); ?></h3>
            <p><?php echo htmlspecialchars($s['description']); ?></p>
            <form method="post" action="/backend/request_service.php">
                <input type="hidden" name="service_id" value="<?php echo (int)$s['id']; ?>">
                <label>Preferred date: <input type="date" name="service_date"></label>
                <button type="submit">Request Service</button>
            </form>
        </div>
    <?php endwhile; ?>
</div>