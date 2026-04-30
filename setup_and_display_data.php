<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "book_management";

$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Helper to check if table is empty
function isEmpty($conn, $table) {
    $result = $conn->query("SELECT COUNT(*) as total FROM $table");
    $row = $result->fetch_assoc();
    return $row['total'] == 0;
}

// Insert sample into ebooks if empty
if (isEmpty($conn, 'ebooks')) {
    $conn->query("INSERT INTO ebooks (title, author, price) VALUES 
        ('Learn PHP Basics', 'Kalpesh Ghediya', 0),
        ('Mastering MySQL', 'Pratik Ghediya', 0),
        ('HTML & CSS Guide', 'Bhavyesh Vishavadiya', 0)
    ");
}

// HTML Start
echo "<!DOCTYPE html>
<html>
<head>
    <title>Library Table Viewer</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background: #f8f8f8; }
        h2 { color: #333; margin-top: 40px; }
        table { border-collapse: collapse; width: 100%; margin-bottom: 40px; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: left; }
        th { background-color: #eee; }
        .container { max-width: 1000px; margin: auto; }
    </style>
</head>
<body><div class='container'>
<h1>📊 Book Management Data Overview</h1>";

// Function to display table data
function displayTable($conn, $tableName, $title = "") {
    $result = $conn->query("SELECT * FROM $tableName");
    if ($result->num_rows > 0) {
        echo "<h2>$title ($tableName)</h2><table><tr>";
        while ($field = $result->fetch_field()) {
            echo "<th>{$field->name}</th>";
        }
        echo "</tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            foreach ($row as $value) {
                echo "<td>" . htmlspecialchars($value) . "</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<h2>$title ($tableName)</h2><p>No records found.</p>";
    }
}

// Display only books, ebooks, and users
displayTable($conn, 'books', '📚 Books');
displayTable($conn, 'ebooks', '📘 Ebooks');
displayTable($conn, 'users', '👤 Users');

echo "</div></body></html>";

$conn->close();
?>
