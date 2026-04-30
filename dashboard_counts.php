<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "book_management";

$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$data = [];

$tables = [
    "books" => "Print Books",
    "ebooks" => "Ebooks",
    "journals" => "eJournals",
    "proceedings" => "eConference Proceedings",
    "thesis" => "Thesis"
];

$total = 0;
foreach ($tables as $table => $label) {
    $result = $conn->query("SELECT COUNT(*) AS count FROM $table");
    $row = $result->fetch_assoc();
    $count = $row['count'];
    $data[$table] = $count;
    $total += $count;
}

$data['total'] = $total;

// Get unique authors across all tables
$uniqueAuthors = [];
foreach (['books', 'ebooks', 'journals', 'proceedings', 'thesis'] as $table) {
    $query = "SELECT DISTINCT AuthorName FROM $table WHERE AuthorName IS NOT NULL AND AuthorName != ''";
    $result = $conn->query($query);
    while ($row = $result->fetch_assoc()) {
        $uniqueAuthors[strtolower(trim($row['AuthorName']))] = true;
    }
}
$data['unique_authors'] = count($uniqueAuthors);

header('Content-Type: application/json');
echo json_encode($data);
?>
