<?php
$conn = new mysqli("localhost", "root", "", "book_management");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $student_name = $_POST['student_name'];
    $year = $_POST['year'];

    $stmt = $conn->prepare("INSERT INTO thesis (title, student_name, year) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $title, $student_name, $year);

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
    <title>Add Thesis</title>
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
            color: #111827;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #374151;
        }

        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #d1d5db;
            background-color: #f9fafb;
        }

        button {
            background-color: #10b981;
            color: white;
            padding: 10px 20px;
            width: 100%;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            transition: background 0.2s ease-in-out;
        }

        button:hover {
            background-color: #059669;
        }

        .back {
            margin-top: 20px;
            text-align: center;
        }

        .back a {
            color: #3b82f6;
            text-decoration: none;
            font-weight: bold;
        }

        .back a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Add New Thesis</h2>
        <form method="POST">
            <label>Title</label>
            <input type="text" name="title" required>

            <label>Student Name</label>
            <input type="text" name="student_name" required>

            <label>Year</label>
            <input type="number" name="year" required>

            <button type="submit">Add Thesis</button>
        </form>
        <div class="back">
            <a href="index.php">← Back to Dashboard</a>
        </div>
    </div>
</body>
</html>

<?php $conn->close(); ?>
