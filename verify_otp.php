<?php
session_start();
include 'connect.php';

if (!isset($_SESSION['temp_reg'])) {
    header("Location: register.php");
    exit();
}

if (isset($_POST['verify'])) {
    $enteredOtp = trim($_POST['otp']);
    $regData = $_SESSION['temp_reg'];

    if ($enteredOtp == $regData['otp']) {
        $is_verified = 1;

        $stmt = $conn->prepare("
            INSERT INTO users 
            (firstName, lastName, email, password, role, profile_image, otp, is_verified) 
            VALUES (?, ?, ?, ?, ?, ?, NULL, ?)
        ");

        $stmt->bind_param(
            "ssssssi",
            $regData['fName'],
            $regData['lName'],
            $regData['email'],
            $regData['password'],
            $regData['role'],
            $regData['profile_image'],
            $is_verified
        );

        if ($stmt->execute()) {
            unset($_SESSION['temp_reg']);
            echo "<h2>✅ Email verified! Registration complete.</h2>";
            header("Location: index7.php?showSignIn=1");
exit();

            exit;
        } else {
            echo "❌ Registration failed: " . $stmt->error;
        }

    } else {
        echo "<h2>❌ Invalid OTP</h2>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Verify OTP</title>
</head>
<body>
    <h2>Enter OTP</h2>
    <form method="post">
        <input type="text" name="otp" placeholder="Enter OTP" required>
        <button type="submit" name="verify">Verify</button>
    </form>
</body>
</html>
