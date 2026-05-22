<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "travel_reservation");

$bookingID = $_POST['bookingID'];
$amount = $_POST['amount'];
$paymentmethod = $_POST['paymentmethod'];
$transactiondate = $_POST['transactiondate'];
$paymentID = $_POST['paymentID'];

// Auto-generate Payment ID if left blank
if (empty($paymentID)) {
    $result = mysqli_query($conn, "SELECT MAX(paymentID) as max_id FROM payment");
    $row = mysqli_fetch_assoc($result);
    $lastID = $row['max_id'];
    if ($lastID) {
        $num = (int)substr($lastID, 1) + 1;
        $paymentID = 'P' . str_pad($num, 3, '0', STR_PAD_LEFT);
    } else {
        $paymentID = 'P001';
    }
}

// Check if booking exists
$checkBooking = mysqli_query($conn, "SELECT bookingstatus, totalfare FROM booking WHERE bookingID = '$bookingID'");

if (mysqli_num_rows($checkBooking) == 0) {
    echo "<script>alert('❌ Booking ID $bookingID does not exist!'); window.location.href='payment.php';</script>";
    exit();
}

$booking = mysqli_fetch_assoc($checkBooking);

// Check if amount matches
if ($amount != $booking['totalfare']) {
    echo "<script>alert('❌ Amount does not match! Expected: " . $booking['totalfare'] . " UGX'); window.location.href='payment.php';</script>";
    exit();
}

// Check if already paid
if ($booking['bookingstatus'] == 'BOOKED') {
    echo "<script>alert('❌ Booking $bookingID is already paid!'); window.location.href='payment.php';</script>";
    exit();
}

$paymentstatus = 'COMPLETED';

$sql1 = "INSERT INTO payment (paymentID, amount, paymentmethod, paymentstatus, transactiondate, bookingID) 
         VALUES ('$paymentID', '$amount', '$paymentmethod', '$paymentstatus', '$transactiondate', '$bookingID')";

$sql2 = "UPDATE booking SET bookingstatus = 'BOOKED' WHERE bookingID = '$bookingID'";

if (mysqli_query($conn, $sql1) && mysqli_query($conn, $sql2)) {
    echo "<script>
            alert('✓ Payment successful! Payment ID: $paymentID | Amount: $amount UGX');
            window.location.href = 'confirmation.php?bookingID=$bookingID&paymentID=$paymentID';
          </script>";
} else {
    echo "<script>alert('✗ Payment failed: " . mysqli_error($conn) . "'); window.location.href='payment.php';</script>";
}
mysqli_close($conn);
?>