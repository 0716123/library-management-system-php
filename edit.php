<?php
$conn = new mysqli("localhost", "root", "", "book_management");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id'];

// If form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bookName = $_POST['BookName'];
    $authorName = $_POST['AuthorName'];
    $price = $_POST['Price'];
    $bookNo = $_POST['BookNo'];

    $stmt = $conn->prepare("UPDATE books SET BookName=?, AuthorName=?, Price=?, BookNo=? WHERE id=?");
    $stmt->bind_param("ssdii", $bookName, $authorName, $price, $bookNo, $id);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error updating record: " . $stmt->error;
    }
}

// Get current book data
$stmt = $conn->prepare("SELECT * FROM books WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$book = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Book</title>
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

        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        button {
            background-color: #3b82f6;
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
        <h2>Edit Book</h2>
        <form method="POST">
            <label>Book Name</label>
            <input type="text" name="BookName" value="<?php echo htmlspecialchars($book['BookName']); ?>" required>

            <label>Author Name</label>
            <input type="text" name="AuthorName" value="<?php echo htmlspecialchars($book['AuthorName']); ?>" required>


            <label>Book No</label>
            <input type="number" name="BookNo" value="<?php echo $book['BookNo']; ?>" required>

            <button type="submit">Update Book</button>
        </form>
        <div class="back">
            <a href="index.php">← Back to Dashboard</a>
        </div>
    </div>
</body>
</html>

<?php $conn->close(); ?>
