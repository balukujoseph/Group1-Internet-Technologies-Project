<?php
session_start();
$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = mysqli_connect("localhost", "root", "", "travel_reservation");
    $login_id = mysqli_real_escape_string($conn, $_POST['login_id']);
    
    $result = mysqli_query($conn, "SELECT passengerID, fname, lname, email FROM passengers WHERE passengerID = '$login_id' OR email = '$login_id'");
    
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['passengerID'] = $row['passengerID'];
        $_SESSION['passengerName'] = $row['fname'] . ' ' . $row['lname'];
        $_SESSION['passengerEmail'] = $row['email'];
        
        echo "<script>window.location.href = 'schedule.php';</script>";
        exit();
    } else {
        $error = "Invalid Passenger ID or Email. Please register first.";
    }
    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | SwiftBus</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <nav class="navbar">
        <div class="nav-container">
            <a href="index.php" class="logo">Swift<span>Bus</span></a>
            <ul class="nav-links">
                <li><a href="index.php">Home</a></li>
                <li><a href="schedule.php">Schedules</a></li>
                <li><a href="login.php" class="active">Login</a></li>
                <li><a href="register.php">Register</a></li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <div class="form-container">
            <h2 class="form-title">Login to Your Account</h2>
            
            <?php if($error): ?>
                <div class="alert alert-error"><?php echo $error; ?></div>
            <?php endif; ?>
            
            <form method="post" action="">
                <div class="form-group">
                    <label>Passenger ID or Email</label>
                    <input type="text" name="login_id" required placeholder="e.g., PS001 or email@example.com">
                </div>
                <button type="submit" class="btn">Login</button>
            </form>
            <p style="text-align: center; margin-top: 1.5rem;">
                Don't have an account? <a href="register.php">Register here</a>
            </p>
        </div>
    </div>

    <footer class="footer">
        <p>&copy; 2026 SwiftBus Travel Services</p>
    </footer>
</body>
</html>