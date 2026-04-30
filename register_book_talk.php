<?php
session_start();
include 'connect.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index7.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $book_title = trim($_POST['book_title']);
    $presentation_date = $_POST['presentation_date'];
    $today = date("Y-m-d");

    // 1. Prevent backdated presentation date
    if ($presentation_date < $today) {
        echo "Error: Presentation date cannot be in the past.";
        exit();
    }

    // 2. Check if user already has a pending Book Talk
    $check = $conn->prepare("SELECT * FROM book_talk WHERE user_id = ? ORDER BY id DESC LIMIT 1");
    $check->bind_param("i", $user_id);
    $check->execute();
    $result = $check->get_result();

    if ($row = $result->fetch_assoc()) {
        if ($row['presentation_date'] >= $today) {
            echo "<h3 style='text-align:center;padding:50px;color:red;'>You have already registered for a Book Talk on <b>" . $row['presentation_date'] . "</b>.<br>New registration will be allowed only after that date.</h3>";
            exit();
        }
    }

    // 3. Register new book talk
    $stmt = $conn->prepare("INSERT INTO book_talk (user_id, book_title, presentation_date) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $user_id, $book_title, $presentation_date);

    if ($stmt->execute()) {
        echo "<h3 style='text-align:center;padding:50px;color:green;'>Successfully registered for Book Talk on <b>$presentation_date</b>!</h3>";
        echo "<p style='text-align:center;'><a href='booktalk.php'>Go back to Dashboard</a></p>";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
