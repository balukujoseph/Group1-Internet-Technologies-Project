<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "travel_reservation");

$bookingID = isset($_GET['bookingID']) ? $_GET['bookingID'] : '';
$amount = isset($_GET['amount']) ? $_GET['amount'] : 0;
$amount = is_numeric($amount) ? (float)$amount : 0;

$passengerName = '';
if (isset($_SESSION['passengerID']) && $bookingID) {
    $nameQuery = mysqli_query($conn, "SELECT p.fname, p.lname FROM booking b 
                                      JOIN passengers p ON b.passengerID = p.passengerID 
                                      WHERE b.bookingID = '$bookingID'");
    if ($nameData = mysqli_fetch_assoc($nameQuery)) {
        $passengerName = $nameData['fname'] . ' ' . $nameData['lname'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Make Payment | SwiftBus</title>
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
        <div class="form-container" style="max-width: 550px;">
            <h2 class="form-title">💰 Complete Your Payment</h2>
            
            <?php if($passengerName): ?>
                <div class="alert alert-success">✅ Welcome, <?php echo $passengerName; ?>!</div>
            <?php endif; ?>
            
            <div class="journey-card" style="margin-bottom: 1.5rem; text-align: center;">
                <h3>Payment Summary</h3>
                <div style="font-size: 1.2rem;"><strong>Booking ID:</strong> <?php echo $bookingID; ?></div>
                <div style="font-size: 2rem; color: #28a745; font-weight: bold;">UGX <?php echo number_format($amount); ?></div>
                <div class="alert alert-info" style="margin-top: 1rem;">
                    <strong>📌 Important:</strong> Enter the exact amount shown above when making payment.
                </div>
            </div>
            
            <form method="post" action="process_payment.php">
                <input type="hidden" name="bookingID" value="<?php echo $bookingID; ?>">
                <input type="hidden" name="amount" value="<?php echo $amount; ?>">
                
                <div class="form-group">
                    <label>💳 Payment Method:</label>
                    <select name="paymentmethod" required>
                        <option value="AIRTEL MONEY">📱 AIRTEL Money</option>
                        <option value="MTN MOBILE MONEY">📱 MTN Mobile Money</option>
                        <option value="VISA / MASTERCARD">💳 Visa / Mastercard</option>
                        <option value="PAYPAL">🌐 PayPal</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label>📅 Transaction Date:</label>
                    <input type="datetime-local" name="transactiondate" required>
                </div>
                
                <div class="form-group">
                    <label>💰 Payment ID (Optional - Auto-generated if left blank):</label>
                    <input type="text" name="paymentID" placeholder="Leave blank for auto-generation">
                </div>
                
                <button type="submit" class="btn">✅ Pay Now</button>
                <button type="reset" class="btn btn-secondary">Reset</button>
            </form>
        </div>
    </div>

    <footer class="footer">
        <p>&copy; 2026 SwiftBus Travel Services</p>
    </footer>
</body>
</html>
<?php mysqli_close($conn); ?>
