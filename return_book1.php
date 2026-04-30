<?php
include 'connect.php'; // your database connection

if (isset($_GET['book_id'])) {
    $bookId = $_GET['book_id'];

    // 1. Find the active issue record
    $query = "SELECT * FROM issued_books WHERE book_id = $bookId AND status = 'Issued' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $issue = mysqli_fetch_assoc($result);
        $issueId = $issue['id'];

        // 2. Update the issued_books record (mark as returned)
        $returnDate = date("Y-m-d");
        $updateIssue = "UPDATE issued_books SET return_date = '$returnDate', status = 'Returned' WHERE id = $issueId";
        mysqli_query($conn, $updateIssue);

        // 3. Update the books table to make it available
        $updateBook = "UPDATE books SET availability = 'Available' WHERE id = $bookId";
        mysqli_query($conn, $updateBook);

        echo "<script>alert('Book returned successfully.'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('No issued record found for this book.'); window.location.href='index.php';</script>";
    }
} else {
    echo "<script>alert('Invalid request.'); window.location.href='index.php';</script>";
}
?>
