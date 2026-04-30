<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "book_management";  // change if your DB name is different

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}
?>
