<?php
$conn = new mysqli("localhost", "root", "", "book_management");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$id = $_GET['id'];
$conn->query("DELETE FROM books WHERE id = $id");
$conn->close();
header("Location: index.php");
exit();
?>
