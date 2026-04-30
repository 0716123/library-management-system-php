<?php
session_start();
include 'connect.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index7.php");
    exit;
}

$userId = $_SESSION['user_id'];
$bookId = $_POST['book_id'] ?? null;
$action = $_POST['action'] ?? '';

if (!$bookId || !in_array($action, ['issue', 'return'])) {
    die("Invalid request");
}

$conn = new mysqli("localhost", "root", "", "book_management");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($action === 'issue') {
    $check = $conn->prepare("SELECT * FROM issued_books WHERE user_id = ? AND book_id = ? AND return_date IS NULL");
    $check->bind_param("ii", $userId, $bookId);
    $check->execute();
    $res = $check->get_result();

    if ($res->num_rows == 0) {
        $stmt = $conn->prepare("INSERT INTO issued_books (user_id, book_id, issue_date, status) VALUES (?, ?, NOW(), 'issued')");
        $stmt->bind_param("ii", $userId, $bookId);
        $stmt->execute();
    }

} elseif ($action === 'return') {
    $stmt = $conn->prepare("UPDATE issued_books SET return_date = NOW(), status = 'returned' WHERE user_id = ? AND book_id = ? AND return_date IS NULL");
    $stmt->bind_param("ii", $userId, $bookId);
    $stmt->execute();
}

$conn->close();
header("Location: ebooks.php");
exit;
