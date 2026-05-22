<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bus Schedules | SwiftBus</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <nav class="navbar">
        <div class="nav-container">
            <a href="index.php" class="logo">Swift<span>Bus</span></a>
            <ul class="nav-links">
                <li><a href="index.php">Home</a></li>
                <li><a href="schedule.php" class="active">Schedules</a></li>
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
        <h1 style="margin-bottom: 2rem;">Available Bus Schedules</h1>
        
        <!-- Journey 1 -->
        <div class="journey-card">
            <div class="journey-header">
                <h3>J001 - Kampala to Jinja</h3>
            </div>
            <div class="journey-info">
                <p><strong>📅 Departure Date:</strong> 2026-05-20</p>
                <p><strong>⏰ Departure Time:</strong> 08:00 AM</p>
                <p><strong>💰 Price:</strong> UGX 50,000 per passenger</p>
                <p><strong>🪑 Available Seats:</strong> <span class="available-seats">45</span> / 50</p>
                <p><strong>📍 Route:</strong> Kampala → Mukono → Jinja</p>
            </div>
            <?php if(isset($_SESSION['passengerID'])): ?>
                <a href="booking.php?journey=J001&destination=Jinja&price=50000" class="btn">Book This Journey →</a>
            <?php else: ?>
                <a href="login.php" class="btn">Login to Book</a>
            <?php endif; ?>
        </div>
        
        <!-- Journey 2 -->
        <div class="journey-card">
            <div class="journey-header">
                <h3>J002 - Kampala to Mbale</h3>
            </div>
            <div class="journey-info">
                <p><strong>📅 Departure Date:</strong> 2026-05-20</p>
                <p><strong>⏰ Departure Time:</strong> 02:00 PM</p>
                <p><strong>💰 Price:</strong> UGX 55,000 per passenger</p>
                <p><strong>🪑 Available Seats:</strong> <span class="available-seats">50</span> / 50</p>
                <p><strong>📍 Route:</strong> Kampala → Mukono → Jinja → Mbale</p>
            </div>
            <?php if(isset($_SESSION['passengerID'])): ?>
                <a href="booking.php?journey=J002&destination=Mbale&price=55000" class="btn">Book This Journey →</a>
            <?php else: ?>
                <a href="login.php" class="btn">Login to Book</a>
            <?php endif; ?>
        </div>
        
        <!-- Journey 3 -->
        <div class="journey-card">
            <div class="journey-header">
                <h3>J003 - Kampala to Gulu</h3>
            </div>
            <div class="journey-info">
                <p><strong>📅 Departure Date:</strong> 2026-05-21</p>
                <p><strong>⏰ Departure Time:</strong> 07:30 AM</p>
                <p><strong>💰 Price:</strong> UGX 70,000 per passenger</p>
                <p><strong>🪑 Available Seats:</strong> <span class="available-seats">40</span> / 50</p>
                <p><strong>📍 Route:</strong> Kampala → Luweero → Masindi → Gulu</p>
            </div>
            <?php if(isset($_SESSION['passengerID'])): ?>
                <a href="booking.php?journey=J003&destination=Gulu&price=70000" class="btn">Book This Journey →</a>
            <?php else: ?>
                <a href="login.php" class="btn">Login to Book</a>
            <?php endif; ?>
        </div>
    </div>

    <footer class="footer">
        <p>&copy; 2026 SwiftBus Travel Services</p>
    </footer>
</body>
</html>
