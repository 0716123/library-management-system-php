<?php
session_start();
include 'connect.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index7.php");
    exit();
}

$today = date("Y-m-d");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register for Book Talk</title>
    <style>
        body {
            background: #f5f0ea;
            font-family: 'Segoe UI', sans-serif;
            display: flex;
            justify-content: center;
            padding-top: 50px;
        }
        .form-box {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            width: 400px;
        }
        .form-box h2 {
            text-align: center;
            color: #5a381e;
        }
        label {
            display: block;
            margin-top: 15px;
            color: #444;
        }
        input[type="text"], input[type="date"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }
        button {
            margin-top: 20px;
            width: 100%;
            padding: 12px;
            background: #5a381e;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background: #3f2813;
        }
    </style>
</head>
<body>

<div class="form-box">
    <h2>Book Talk Registration</h2>
    <form method="POST" action="register_book_talk.php">
        <label for="book_title">Book Title:</label>
        <input type="text" name="book_title" id="book_title" required title="Enter the book title">

        <label for="presentation_date">Presentation Date:</label>
        <input type="date" name="presentation_date" id="presentation_date" min="<?php echo $today; ?>" required>

        <button type="submit">Register</button>
    </form>
</div>

</body>
</html>
