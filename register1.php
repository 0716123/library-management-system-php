<?php
session_start();
require 'db.php';
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['signUp'])) {
    $fName = $_POST['fName'];
    $lName = $_POST['lName'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $role = "user"; // default role

    // Upload profile image
    $target = "uploads/" . basename($_FILES["profile_image"]["name"]);
    move_uploaded_file($_FILES["profile_image"]["tmp_name"], $target);

    // Generate OTP
    $otp = rand(100000, 999999);

    // Insert into database
    $stmt = $conn->prepare("INSERT INTO users (firstName,lastName,email,password,role,profile_image,otp,is_verified) VALUES (?,?,?,?,?,?,?,0)");
    $stmt->bind_param("sssssss", $fName, $lName, $email, $password, $role, $target, $otp);

    if ($stmt->execute()) {
        // Send OTP via email
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host       = 'ghediyak3@gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'ghediyak3@gmail.com'; // 🔹 your Gmail
            $mail->Password   = 'nmti kfkc oepp snoh';   // 🔹 your Gmail App Password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            $mail->setFrom('ghediyak3@gmail.com', 'VS OTP System');
            $mail->addAddress($email, $fName);

            $mail->isHTML(true);
            $mail->Subject = "Your OTP Code";
            $mail->Body    = "<h3>Hello $fName,</h3><p>Your OTP is <b>$otp</b></p>";

            $mail->send();

            $_SESSION['email'] = $email;
            header("Location: verify_otp.php");
            exit();
        } catch (Exception $e) {
            echo "❌ OTP could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "❌ Error: " . $stmt->error;
    }
}
?>
