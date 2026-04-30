<?php
$conn = new mysqli("localhost", "root", "", "book_management");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bookName = $_POST['BookName'];
    $authorName = $_POST['AuthorName'];
    $bookNo = $_POST['BookNo'];

    $imgPath = "img/default.png"; // default image

    // Handle image upload
    if (isset($_FILES['BookImage']) && $_FILES['BookImage']['error'] === 0) {
        $originalName = basename($_FILES["BookImage"]["name"]);
        $targetPath = "img/" . time() . "_" . $originalName;

        if (move_uploaded_file($_FILES["BookImage"]["tmp_name"], $targetPath)) {
            $imgPath = $targetPath; 
        }
    }

    // ✅ Correct INSERT query (4 columns, 4 values)
    $stmt = $conn->prepare("INSERT INTO books (BookName, AuthorName, BookNo, img) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssis", $bookName, $authorName, $bookNo, $imgPath);

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
    <title>Add New Book</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f3f4f6;
            padding: 40px;
        }
        .form-container {
            background: #fff;
            padding: 30px;
            max-width: 550px;
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
        input[type="number"],
        input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        button {
            background-color: #10b981;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            width: 100%;
        }
        .back {
            margin-top: 20px;
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
        <h2>Add New Book</h2>
        <form method="POST" enctype="multipart/form-data">
            <label>Book Name</label>
            <input type="text" name="BookName" required>

            <label>Author Name</label>
            <input type="text" name="AuthorName" required>

            <label>Book No</label>
            <input type="number" name="BookNo" required>

            <label>Book Image</label>
            <input type="file" name="BookImage" accept="image/*">

            <button type="submit">Add Book</button>
        </form>
        <div class="back">
            <a href="index.php">← Back to Dashboard</a>
        </div>
    </div>
</body>
</html>

<?php $conn->close(); ?>
