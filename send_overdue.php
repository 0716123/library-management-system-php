<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';   // if installed with composer
// OR if manual include:
// require '../includes/PHPMailer/src/Exception.php';
// require '../includes/PHPMailer/src/PHPMailer.php';
// require '../includes/PHPMailer/src/SMTP.php';

include '../db.php'; // DB connection

$today = date('Y-m-d');
$query = "SELECT CONCAT(u.firstName, ' ', u.lastName) AS name, 
                 u.email, b.title, i.return_date 
          FROM issued_books i
          JOIN users u ON i.user_id = u.id
          JOIN books b ON i.book_id = b.id
          WHERE DATE(i.return_date) < CURDATE() 
            AND i.status = 'Issued'";


$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';  // Your SMTP host
        $mail->SMTPAuth   = true;
        $mail->Username   = 'ghediyak3@gmail.com';  // Your email
        $mail->Password   = 'dclr ovvz yvsk hjmd';    // App password or SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Recipients
        $mail->setFrom('ghediyak3@gmail.com', 'Library Team');
        $mail->addAddress($row['email'], $row['name']);

        // Content
        $mail->isHTML(true);
        $mail->Subject = "⚠ Overdue Notice: Please Return Your Book";
        $mail->Body    = "
            <p>Hello <b>{$row['name']}</b>,</p>
            <p>The book <b>{$row['title']}</b> was due on <b>{$row['return_date']}</b> 
            and is now <span style='color:red;'>overdue</span>.</p>
            <p>Please return it immediately to avoid additional fines.</p>
            <br>
            <p>Thank you,<br>Library Team</p>
        ";
        $mail->AltBody = "Hello {$row['name']}, The book '{$row['title']}' was due on {$row['return_date']} and is now overdue. Please return it immediately.";

        $mail->send();
        echo "Overdue reminder sent to: {$row['email']}<br>";
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}<br>";
    }
}
?>
