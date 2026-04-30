<?php
session_start();
include 'connect.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index7.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Get latest book talk record
$sql = "SELECT users.firstName, users.lastName, bt.book_title, bt.presentation_date
        FROM book_talk bt
        JOIN users ON bt.user_id = users.id
        WHERE bt.user_id = ?
        ORDER BY bt.id DESC LIMIT 1";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    $name = strtoupper($row['firstName'] . ' ' . $row['lastName']);

    $book_title = $row['book_title'];
    $presentation_date = date("F d, Y", strtotime($row['presentation_date']));
    $today = date("Y-m-d");

    // Prevent generating certificate before date
    if ($today < $row['presentation_date']) {
        echo "<h3>Certificate will be available after your Book Talk on <b>{$presentation_date}</b>.</h3>";
        exit();
    }
} else {
    echo "No Book Talk registration found.";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Certificate of Participation</title>
    <style>
        body {
            font-family: 'Georgia', serif;
            background: #fff8f0;
            padding: 60px;
            text-align: center;
        }
        .certificate {
            border: 10px solid #b8926a;
            padding: 40px;
            background: white;
            display: inline-block;
            width: 80%;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        h1 {
            font-size: 32px;
            color: #5a381e;
        }
        h2 {
            font-size: 24px;
            margin: 30px 0 10px;
        }
        p {
            font-size: 18px;
        }
        .highlight {
            font-weight: bold;
            color: #3e2b18;
        }
        .footer {
            margin-top: 50px;
            font-size: 14px;
            color: #777;
        }
    </style>
</head>
<body>

<div class="certificate">
    <h1>Certificate of Participation</h1>
    <h2>This is proudly presented to</h2>
    <h2 class="highlight"><?php echo $name; ?></h2>
    <p>For presenting the book titled <span class="highlight">"<?php echo htmlspecialchars($book_title); ?>"</span><br>
    at the Book Talk session held on <span class="highlight"><?php echo $presentation_date; ?></span>.</p>

    <p style="margin-top: 30px; font-style: italic;">"Sharing knowledge is the first step to community growth."</p>

    <div class="footer">
        Tattva Gyan Learning Center
    </div>
</div>

</body>
</html>
