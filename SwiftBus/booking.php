<?php
session_start();
$passengerID = isset($_SESSION['passengerID']) ? $_SESSION['passengerID'] : '';
$journeyID = isset($_GET['journey']) ? $_GET['journey'] : '';
$destination = isset($_GET['destination']) ? $_GET['destination'] : '';
$price = isset($_GET['price']) ? $_GET['price'] : 0;

if (empty($passengerID)) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Booking | SwiftBus</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <nav class="navbar">
        <div class="nav-container">
            <a href="index.php" class="logo">Swift<span>Bus</span></a>
            <ul class="nav-links">
                <li><a href="index.php">Home</a></li>
                <li><a href="schedule.php">Schedules</a></li>
                <li><a href="my_bookings.php">My Bookings</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <div class="form-container">
            <h2 class="form-title">✈️ Create Booking</h2>
            
            <div class="alert alert-success">
                ✅ Logged in as: <strong><?php echo $passengerID; ?></strong>
            </div>
            
            <div class="journey-card">
                <h3>Journey <?php echo $journeyID; ?> - Kampala to <?php echo $destination; ?></h3>
                <p><strong>💰 Price:</strong> UGX <?php echo number_format($price); ?> per passenger</p>
            </div>
            
            <form method="post" action="process_booking.php">
                <input type="hidden" name="passengerID" value="<?php echo $passengerID; ?>">
                <input type="hidden" name="journeyID" value="<?php echo $journeyID; ?>">
                <input type="hidden" name="destination" value="<?php echo $destination; ?>">
                <input type="hidden" name="price" value="<?php echo $price; ?>">
                
                <div class="form-group">
                    <label>🎫 Total Passengers:</label>
                    <input type="number" name="totalpassengers" value="1" min="1" max="10" required>
                </div>
                
                <div class="alert alert-info">
                    <strong>Total Fare = Passengers × UGX <?php echo number_format($price); ?></strong>
                </div>
                
                <button type="submit" class="btn">Create Booking</button>
                <button type="reset" class="btn btn-secondary">Reset</button>
            </form>
        </div>
    </div>

    <footer class="footer">
        <p>&copy; 2026 SwiftBus Travel Services</p>
    </footer>
</body>
</html>