<?php
session_start();
if (!isset($_SESSION['passengerID'])) {
    header("Location: login.php");
    exit();
}

$conn = mysqli_connect("localhost", "root", "", "travel_reservation");
$passengerID = $_SESSION['passengerID'];

$result = mysqli_query($conn, "SELECT bookingID, journeyID, destination, bookingstatus, totalpassengers, totalfare
                               FROM booking 
                               WHERE passengerID = '$passengerID'
                               ORDER BY bookingID DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Bookings | SwiftBus</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <nav class="navbar">
        <div class="nav-container">
            <a href="index.php" class="logo">Swift<span>Bus</span></a>
            <ul class="nav-links">
                <li><a href="index.php">Home</a></li>
                <li><a href="schedule.php">Schedules</a></li>
                <li><a href="my_bookings.php" class="active">My Bookings</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <h1>My Bookings</h1>
        
        <?php if (mysqli_num_rows($result) == 0): ?>
            <div class="alert alert-info">You have no bookings yet. <a href="schedule.php">Book a ticket now</a></div>
        <?php else: ?>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Booking ID</th>
                            <th>Journey</th>
                            <th>Destination</th>
                            <th>Status</th>
                            <th>Passengers</th>
                            <th>Fare (UGX)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?php echo $row['bookingID']; ?></td>
                            <td><?php echo $row['journeyID']; ?></td>
                            <td><?php echo $row['destination']; ?></td>
                            <td class="status-<?php echo $row['bookingstatus']; ?>"><?php echo $row['bookingstatus']; ?></td>
                            <td><?php echo $row['totalpassengers']; ?></td>
                            <td><?php echo number_format($row['totalfare']); ?></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>

    <footer class="footer">
        <p>&copy; 2026 SwiftBus Travel Services</p>
    </footer>
</body>
</html>
<?php mysqli_close($conn); ?>