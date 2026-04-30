<?php
session_start();
include 'connect.php';
include 'navbar.php'; 


if(isset($_POST['ADD'])) {
    $book = $_POST['bname'];
    $author = $_POST['aname'];
    $price = $_POST['price'];
    $bookno = $_POST['bno'];

    // Check if book already exists
    $checkbook = "SELECT * FROM books WHERE BookNo = ?";
    $stmt = $conn->prepare($checkbook);
    $stmt->bind_param("s", $bookno);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0) {
        echo "<script>alert('Book already exists!'); window.location.href='index.html';</script>";
    } else {
        // Insert book into database
        $insertQuery = "INSERT INTO books (BookName, AuthorName, Price, BookNo) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($insertQuery);
        $stmt->bind_param("ssds", $book, $author, $price, $bookno);
        
        if($stmt->execute()) {
            header("Location: homepage.php");
            exit();
        } else {
            echo "<script>alert('Error adding book.'); window.location.href='index.html';</script>";
        }
    }
    $stmt->close();
    $conn->close();
}
?>
