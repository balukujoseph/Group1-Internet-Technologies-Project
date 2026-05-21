<?php
session_start();
$message = '';
$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = mysqli_connect("localhost", "root", "", "travel_reservation");
    
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phonenumber = mysqli_real_escape_string($conn, $_POST['phonenumber']);
    
    $check = mysqli_query($conn, "SELECT email FROM passengers WHERE email = '$email'");
    if (mysqli_num_rows($check) > 0) {
        $error = "Email already registered. Please login.";
    } else {
        $result = mysqli_query($conn, "SELECT MAX(passengerID) as max_id FROM passengers");
        $row = mysqli_fetch_assoc($result);
        $lastID = $row['max_id'];
        
        if ($lastID) {
            $num = (int)substr($lastID, 2) + 1;
            $passengerID = 'PS' . str_pad($num, 3, '0', STR_PAD_LEFT);
        } else {
            $passengerID = 'PS001';
        }
        
        $sql = "INSERT INTO passengers (passengerID, fname, lname, email, phonenumber) 
                VALUES ('$passengerID', '$fname', '$lname', '$email', '$phonenumber')";
        
        if (mysqli_query($conn, $sql)) {
            $_SESSION['passengerID'] = $passengerID;
            $_SESSION['passengerName'] = $fname . ' ' . $lname;
            $message = "Registration successful! Your ID is: " . $passengerID;
            echo "<script>setTimeout(function(){ window.location.href='schedule.php'; }, 2000);</script>";
        } else {
            $error = "Registration failed: " . mysqli_error($conn);
        }
    }
    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | SwiftBus</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <nav class="navbar">
        <div class="nav-container">
            <a href="index.php" class="logo">Swift<span>Bus</span></a>
            <ul class="nav-links">
                <li><a href="index.php">Home</a></li>
                <li><a href="schedule.php">Schedules</a></li>
                <li><a href="login.php">Login</a></li>
                <li><a href="register.php" class="active">Register</a></li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <div class="form-container">
            <h2 class="form-title">Create an Account</h2>
            
            <?php if($message): ?>
                <div class="alert alert-success"><?php echo $message; ?></div>
            <?php endif; ?>
            <?php if($error): ?>
                <div class="alert alert-error"><?php echo $error; ?></div>
            <?php endif; ?>
            
            <form method="post" action="">
                <div class="form-group">
                    <label>First Name</label>
                    <input type="text" name="fname" required>
                </div>
                <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" name="lname" required>
                </div>
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="email" required>
                </div>
                <div class="form-group">
                    <label>Phone Number</label>
                    <input type="tel" name="phonenumber" required>
                </div>
                <button type="submit" class="btn">Register</button>
            </form>
            <p style="text-align: center; margin-top: 1.5rem;">
                Already have an account? <a href="login.php">Login here</a>
            </p>
        </div>
    </div>

    <footer class="footer">
        <p>&copy; 2026 SwiftBus Travel Services</p>
    </footer>
</body>
</html>