<?php
$conn = new mysqli("localhost", "root", "", "book_management");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM users WHERE id=$id";
    $conn->query($sql);
}

header("Location: users.php");
?>

