<?php include_once __DIR__ . '/header.php'; ?>
<div class="container">
    <h1>Welcome to Green Lawn Fargo</h1>
    <p>We provide professional lawn care services.</p>

    <section id="services">
        <h2>Our Services</h2>
        <?php include __DIR__ . '/services.php'; ?>
    </section>

    <section id="register">
        <h2>Register</h2>
        <form method="post" action="/backend/register.php">
            <input name="username" placeholder="Username" required>
            <input name="email" type="email" placeholder="Email" required>
            <input name="password" type="password" placeholder="Password" required>
            <button type="submit">Register</button>
        </form>
    </section>

    <section id="login">
        <h2>Login</h2>
        <form method="post" action="/backend/login.php">
            <input name="email" type="email" placeholder="Email" required>
            <input name="password" type="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
    </section>

</div>
<?php include_once __DIR__ . '/footer.php'; ?>