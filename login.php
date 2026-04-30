<?php
session_start();
include 'connect.php'; // DB connection

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$hashedPassword = md5($password); // તમારું DB hashed છે

$sql = "SELECT * FROM users WHERE email = '$email' AND password = '$hashedPassword'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) === 1) {
    $_SESSION['user'] = $email;
    header("Location: index11.php");
    exit();
} else {
    echo "⚠️ ખોટું ઈમેલ અથવા પાસવર્ડ!";
}
?>
