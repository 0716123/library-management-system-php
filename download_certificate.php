<?php
session_start();
include 'connect.php';

if (!isset($_SESSION['user_id'])) {
    die("Unauthorized");
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT name FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($name);
$stmt->fetch();
$stmt->close();

header("Content-type: image/png");
header("Content-Disposition: attachment; filename=certificate.png");

$width = 1200;
$height = 800;

$image = imagecreatetruecolor($width, $height);
$bg = imagecolorallocate($image, 255, 248, 220);
imagefill($image, 0, 0, $bg);

$border = imagecolorallocate($image, 139, 69, 19);
imagesetthickness($image, 12);
imagerectangle($image, 10, 10, $width - 10, $height - 10, $border);

$black = imagecolorallocate($image, 0, 0, 0);
$orange = imagecolorallocate($image, 255, 87, 34);

$font = __DIR__ . '/fonts/Poppins-Bold.ttf'; // You must include this TTF
$font_regular = __DIR__ . '/fonts/Poppins-Regular.ttf';

// Add content
imagettftext($image, 36, 0, 300, 150, $black, $font, "📘 Certificate of Participation");
imagettftext($image, 28, 0, 380, 230, $black, $font_regular, "Presented To:");
imagettftext($image, 36, 0, 300, 300, $orange, $font, $name);
imagettftext($image, 22, 0, 200, 400, $black, $font_regular, "For your outstanding contribution during the Book Talk event.");
imagettftext($image, 20, 0, 200, 450, $black, $font_regular, "Date: " . date("F d, Y"));
imagettftext($image, 20, 0, 200, 490, $black, $font_regular, "Library & Learning Center");

imagepng($image);
imagedestroy($image);
?>
    