<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "travel_reservation");

$bookingID = isset($_GET['bookingID']) ? $_GET['bookingID'] : '';
$paymentID = isset($_GET['paymentID']) ? $_GET['paymentID'] : '';

$bookingDetails = [];
if ($bookingID) {
    $query = mysqli_query($conn, "SELECT b.bookingID, b.totalpassengers, b.totalfare, b.bookingstatus, b.destination,
                                         p.fname, p.lname, p.email, p.phonenumber,
                                         b.journeyID
                                  FROM booking b
                                  JOIN passengers p ON b.passengerID = p.passengerID
                                  WHERE b.bookingID = '$bookingID'");
    $bookingDetails = mysqli_fetch_assoc($query);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation | SwiftBus</title>
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
        <div class="form-container" style="max-width: 700px;">
            <div style="text-align: center; margin-bottom: 1.5rem;">
                <div style="font-size: 4rem;">✅</div>
                <h2 class="form-title" style="color: #28a745;">Booking Confirmed!</h2>
                <p>Your ticket has been successfully booked. Thank you for choosing SwiftBus.</p>
            </div>
            
            <div class="journey-card">
                <h3>📋 Booking Information</h3>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.8rem;">
                    <div><strong>Booking ID:</strong></div><div><?php echo $bookingID; ?></div>
                    <div><strong>Payment ID:</strong></div><div><?php echo $paymentID; ?></div>
                    <div><strong>Passenger Name:</strong></div><div><?php echo $bookingDetails['fname'] . ' ' . $bookingDetails['lname']; ?></div>
                    <div><strong>Status:</strong></div><div><span style="color: #28a745; font-weight: bold;"><?php echo $bookingDetails['bookingstatus']; ?></span></div>
                    <div><strong>Email:</strong></div><div><?php echo $bookingDetails['email']; ?></div>
                    <div><strong>Phone:</strong></div><div><?php echo $bookingDetails['phonenumber']; ?></div>
                </div>
            </div>
            
            <div class="journey-card">
                <h3>🚌 Journey Information</h3>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.8rem;">
                    <div><strong>Journey ID:</strong></div><div><?php echo $bookingDetails['journeyID']; ?></div>
                    <div><strong>Destination:</strong></div><div><?php echo $bookingDetails['destination']; ?></div>
                    <div><strong>Total Passengers:</strong></div><div><?php echo $bookingDetails['totalpassengers']; ?></div>
                    <div><strong>Total Fare:</strong></div><div><strong style="color: #28a745;">UGX <?php echo number_format($bookingDetails['totalfare']); ?></strong></div>
                </div>
            </div>
            
            <div class="alert alert-info">
                <strong>📌 Important Information:</strong>
                <ul style="margin-top: 0.5rem; margin-left: 1.5rem;">
                    <li>Please arrive at the boarding stop 30 minutes before departure.</li>
                    <li>Carry a valid ID for verification.</li>
                    <li>A confirmation email has been sent to your registered email address.</li>
                </ul>
            </div>
            
            <div style="display: flex; gap: 1rem; justify-content: center;">
                <a href="schedule.php" class="btn">📅 Book Another Ticket</a>
                <a href="my_bookings.php" class="btn">🎫 My Bookings</a>
                <a href="index.php" class="btn btn-secondary">🏠 Home</a>
            </div>
            
            <div class="alert alert-success" style="margin-top: 1.5rem; text-align: center;">
                <strong>📧 Confirmation Email Sent!</strong><br>
                A confirmation email has been sent to <?php echo $bookingDetails['email']; ?>
            </div>
        </div>
    </div>

    <footer class="footer">
        <p>&copy; 2026 SwiftBus Travel Services</p>
    </footer>
</body>
</html>
<?php mysqli_close($conn); ?>