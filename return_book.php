<?php
session_start();
$conn = new mysqli("localhost", "root", "", "book_management");

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: index7.php"); // redirect to login
    exit();
}

if (isset($_GET['book_id'])) {
    $bookId = $_GET['book_id'];
    $userId = $_SESSION['user_id'];
    $returnDate = date('Y-m-d');

    // Update the latest issue record for this user and book
    $stmt = $conn->prepare("UPDATE issued_books 
        SET status = 'Returned', return_date = ? 
        WHERE user_id = ? AND book_id = ? AND status = 'Issued' 
        ORDER BY id DESC LIMIT 1");
    $stmt->bind_param("sii", $returnDate, $userId, $bookId);
    $stmt->execute();
}

// Redirect back to the profile page
header("Location: profile.php");
exit();
?>
