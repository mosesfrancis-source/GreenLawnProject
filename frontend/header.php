<?php
if (session_status() === PHP_SESSION_NONE) session_start();
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Green Lawn Fargo</title>
    <link rel="stylesheet" href="/frontend/style.css">
</head>

<body>
    <header>
        <nav>
            <a href="/frontend/index.php">Home</a> |
            <a href="/frontend/services.php">Services</a> |
            <?php if (!empty($_SESSION['user_id'])): ?>
                <a href="/backend/booking_history.php">My Bookings</a> |
                <?php if (!empty($_SESSION['is_admin'])): ?>
                    <a href="/backend/admin_dashboard.php">Admin</a> |
                <?php endif; ?>
                <a href="/backend/logout.php">Logout (<?php echo htmlspecialchars($_SESSION['username']); ?>)</a>
            <?php else: ?>
                <a href="/frontend/index.php#login">Login</a> |
                <a href="/frontend/index.php#register">Register</a>
            <?php endif; ?>
        </nav>
    </header>

    <main>