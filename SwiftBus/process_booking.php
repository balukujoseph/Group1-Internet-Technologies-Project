<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "travel_reservation");

$passengerID = $_POST['passengerID'];
$journeyID = $_POST['journeyID'];
$destination = $_POST['destination'];
$pricePerPassenger = $_POST['price'];
$totalpassengers = $_POST['totalpassengers'];

$totalfare = $totalpassengers * $pricePerPassenger;
$bookingstatus = 'PENDING';

// Auto-generate Booking ID
$result = mysqli_query($conn, "SELECT MAX(bookingID) as max_id FROM booking");
$row = mysqli_fetch_assoc($result);
$lastID = $row['max_id'];

if ($lastID) {
    $num = (int)substr($lastID, 1) + 1;
    $bookingID = 'B' . str_pad($num, 3, '0', STR_PAD_LEFT);
} else {
    $bookingID = 'B001';
}

$sql = "INSERT INTO booking (bookingID, passengerID, journeyID, destination, bookingstatus, totalpassengers, totalfare) 
        VALUES ('$bookingID', '$passengerID', '$journeyID', '$destination', '$bookingstatus', '$totalpassengers', '$totalfare')";

if (mysqli_query($conn, $sql)) {
    echo "<script>
            alert('✓ Booking created! Booking ID: $bookingID | Total Fare: $totalfare UGX');
            window.location.href = 'payment.php?bookingID=$bookingID&amount=$totalfare';
          </script>";
} else {
    echo "<script>alert('✗ Error: " . mysqli_error($conn) . "'); window.location.href='booking.php';</script>";
}
mysqli_close($conn);
?>