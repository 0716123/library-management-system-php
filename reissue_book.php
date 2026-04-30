<?php
session_start();
include 'connect.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index7.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['book_id'])) {
    $book_id = $_POST['book_id'];

    // Insert a new issued record
    $stmt = $conn->prepare("INSERT INTO issued_books (user_id, book_id, issue_date, status) VALUES (?, ?, NOW(), 'issued')");
    $stmt->bind_param("ii", $user_id, $book_id);

    if ($stmt->execute()) {
        header("Location: profile.php?success=reissued");
    } else {
        echo "Reissue failed.";
    }
} else {
    echo "Invalid Request.";
}
?>
