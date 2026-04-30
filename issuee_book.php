<?php
include 'connect.php';
session_start();

// Get book ID and user ID from POST
$book_id = isset($_POST['book_id']) ? intval($_POST['book_id']) : 0;
$user_id = isset($_POST['user_id']) ? intval($_POST['user_id']) : 0;

if ($book_id == 0 || $user_id == 0) {
    echo "<script>alert('Missing book or user info.'); window.location.href='books.php';</script>";
    exit;
}

// STEP 1: Get the book's availability
$bookQuery = "SELECT availability FROM books WHERE id = $book_id";
$bookResult = mysqli_query($conn, $bookQuery);
if (!$bookResult || mysqli_num_rows($bookResult) == 0) {
    echo "<script>alert('Book not found.'); window.location.href='books.php';</script>";
    exit;
}
$book = mysqli_fetch_assoc($bookResult);

// STEP 2: If not available, block issuing
if (strtolower($book['availability']) !== 'available') {
    echo "<script>alert('This book is already issued to someone else.'); window.location.href='books.php';</script>";
    exit;
}

// STEP 3: Check if this user already has this book issued
$checkUserBook = "
    SELECT * FROM issued_books 
    WHERE book_id = $book_id AND user_id = $user_id AND status = 'Issued'
";
$userIssued = mysqli_query($conn, $checkUserBook);
if (mysqli_num_rows($userIssued) > 0) {
    echo "<script>alert('You have already issued this book.'); window.location.href='books.php';</script>";
    exit;
}

// STEP 4: Issue book and mark as Not Available
$issueDate = date("Y-m-d H:i:s");  // ✅ Full date and time


$insert = "
    INSERT INTO issued_books (book_id, user_id, issue_date, status)
    VALUES ($book_id, $user_id, '$issueDate', 'Issued')
";

if (mysqli_query($conn, $insert)) {
    // Mark as Not Available
    $update = "UPDATE books SET availability = 'Not Available' WHERE id = $book_id";
    mysqli_query($conn, $update);

    echo "<script>alert('Book issued successfully.'); window.location.href='books.php';</script>";
} else {
    echo "<script>alert('Something went wrong while issuing.'); window.location.href='books.php';</script>";
}
?>
