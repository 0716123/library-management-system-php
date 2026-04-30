<?php
session_start();
include 'connect.php';

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'You must be logged in to issue a book.']);
    exit();
}

$user_id = $_SESSION['user_id'];
$book_id = isset($_POST['book_id']) ? intval($_POST['book_id']) : 0;

if ($book_id <= 0) {
    echo json_encode(['success' => false, 'message' => 'Invalid book ID.']);
    exit();
}

// Check if book already issued and not returned for this user
$stmt = $conn->prepare("SELECT * FROM issued_books WHERE user_id = ? AND book_id = ? AND status = 'issued'");
$stmt->bind_param("ii", $user_id, $book_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo json_encode(['success' => false, 'message' => 'You already have this book issued.']);
    exit();
}

// Insert new issue record
$issueDate = date("Y-m-d H:i:s");  // ✅ Full date and time


$insert = $conn->prepare("INSERT INTO issued_books (user_id, book_id, issue_date, status) VALUES (?, ?, ?, 'issued')");
$insert->bind_param("iis", $user_id, $book_id, $issue_date);

if ($insert->execute()) {
    echo json_encode(['success' => true, 'message' => 'Book issued successfully!']);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to issue book.']);
}
?>
