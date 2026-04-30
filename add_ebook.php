<?php
$conn = new mysqli("localhost", "root", "", "book_management");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $pdf_file = $_POST['pdf_file'];

    $stmt = $conn->prepare("INSERT INTO ebooks (title, author, pdf_file) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $title, $author, $pdf_file);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Ebook</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f3f4f6;
            padding: 40px;
        }

        .form-container {
            background: #fff;
            padding: 30px;
            max-width: 500px;
            margin: auto;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        button {
            background-color: #6366f1;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        .back {
            margin-top: 20px;
            display: block;
            text-align: center;
        }

        .back a {
            color: #3b82f6;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Add New Ebook</h2>
        <form method="POST">
            <label>Title</label>
            <input type="text" name="title" required>

            <label>Author</label>
            <input type="text" name="author" required>

            <label>PDF File Path</label>
            <input type="text" name="pdf_file" required>

            <button type="submit">Add Ebook</button>
        </form>
        <div class="back">
            <a href="index.php">&larr; Back to Dashboard</a>
        </div>
    </div>
</body>
</html>

<?php $conn->close(); ?>
