<?php
// Load PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/vendor/autoload.php';

// Include database connection
include(__DIR__ . '/db.php');

// Fetch users whose book is due today
$query = "SELECT CONCAT(u.firstName, ' ', u.lastName) AS name, 
       u.email, b.BookName, i.return_date
FROM issued_books i
JOIN users u ON i.user_id = u.id
JOIN books b ON i.book_id = b.id
WHERE DATE(i.return_date) = CURDATE() 
  AND i.status = 'Issued';
";

$result = $conn->query($query);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {

        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'ghediyak3@gmail.com';  // your email
            $mail->Password   = 'dclr ovvz yvsk hjmd';  // app password
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;

            // Recipients
            $mail->setFrom('ghediyak3@gmail.com', 'Library System');
            $mail->addAddress($row['email'], $row['name']);

            // Email content
            $mail->isHTML(false); // plain text
            $mail->Subject = "Library Reminder: Book due today";
            $mail->Body    = "Hello " . $row['name'] . ",\n\n"
                           . "This is a reminder that your book '" . $row['BookName'] 
                           . "' is due today (" . $row['return_date'] . ").\n"
                           . "Please return it to avoid fines.\n\n"
                           . "Thank you,\nLibrary Team";

            $mail->send();
            echo "Reminder sent to " . $row['email'] . "<br>";

        } catch (Exception $e) {
            echo "Message could not be sent to " . $row['email'] . ". Error: {$mail->ErrorInfo}<br>";
        }
    }
} else {
    echo "No reminders today.";
}
?>
