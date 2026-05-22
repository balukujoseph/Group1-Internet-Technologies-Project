<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SwiftBus | Premium Bus Travel in Uganda</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <nav class="navbar">
        <div class="nav-container">
            <a href="index.php" class="logo">Swift<span>Bus</span></a>
            <ul class="nav-links">
                <li><a href="index.php" class="active">Home</a></li>
                <li><a href="schedule.php">Schedules</a></li>
                <?php if(isset($_SESSION['passengerID'])): ?>
                    <li><a href="my_bookings.php">My Bookings</a></li>
                    <li><a href="logout.php">Logout (<?php echo $_SESSION['passengerID']; ?>)</a></li>
                <?php else: ?>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="register.php">Register</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>

    <div class="container">
        <div class="hero">
            <h1>Travel Across Uganda with Ease</h1>
            <p>Safe, Comfortable, and Affordable Bus Travel to all major destinations</p>
            <a href="schedule.php" class="btn">Book Your Ticket Now →</a>
        </div>

        <div class="card-grid">
            <div class="card">
                <div class="icon">🚌</div>
                <h3>Modern Fleet</h3>
                <p>Travel in comfort with our modern, air-conditioned buses</p>
            </div>
            <div class="card">
                <div class="icon">📍</div>
                <h3>Multiple Destinations</h3>
                <p>Serving Kampala, Jinja, Mbale, Gulu, and more</p>
            </div>
            <div class="card">
                <div class="icon">💳</div>
                <h3>Easy Payments</h3>
                <p>Pay with Mobile Money, Visa, Mastercard, or PayPal</p>
            </div>
            <div class="card">
                <div class="icon">✅</div>
                <h3>Instant Confirmation</h3>
                <p>Get instant booking confirmation via email</p>
            </div>
        </div>
    </div>

    <footer class="footer">
        <p>&copy; 2026 SwiftBus Travel Services. All rights reserved.</p>
    </footer>
</body>
</html>