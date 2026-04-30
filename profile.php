<?php
session_start();
include 'connect.php';
include 'navbar.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index7.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows !== 1) {
    echo "User not found.";
    exit();
}
$user = $result->fetch_assoc();

$issuedQuery = $conn->prepare("SELECT COUNT(*) AS totalIssued FROM issued_books WHERE user_id = ?");
$issuedQuery->bind_param("i", $user_id);
$issuedQuery->execute();
$issuedResult = $issuedQuery->get_result();
$totalIssued = $issuedResult->fetch_assoc()['totalIssued'] ?? 0;

$returnedQuery = $conn->prepare("SELECT COUNT(*) AS totalReturned FROM issued_books WHERE user_id = ? AND status = 'returned'");
$returnedQuery->bind_param("i", $user_id);
$returnedQuery->execute();
$returnedResult = $returnedQuery->get_result();
$totalReturned = $returnedResult->fetch_assoc()['totalReturned'] ?? 0;

$listQuery = $conn->prepare("
    SELECT b.BookName, i.issue_date, i.book_id
    FROM issued_books i
    JOIN books b ON i.book_id = b.id
    WHERE i.user_id = ? AND i.status = 'issued'
");
$listQuery->bind_param("i", $user_id);
$listQuery->execute();
$listResult = $listQuery->get_result();

$returnedBooksQuery = $conn->prepare("
    SELECT b.BookName, i.issue_date, i.return_date, i.book_id
    FROM issued_books i
    JOIN books b ON i.book_id = b.id
    WHERE i.user_id = ? AND i.status = 'returned'
    ORDER BY i.return_date DESC
");
$returnedBooksQuery->bind_param("i", $user_id);
$returnedBooksQuery->execute();
$returnedBooksResult = $returnedBooksQuery->get_result();

$today = date("Y-m-d");

$upcomingQuery = $conn->prepare("
    SELECT book_title, presentation_date 
    FROM book_talk 
    WHERE user_id = ? AND presentation_date >= ? 
    ORDER BY presentation_date ASC LIMIT 1
");
$upcomingQuery->bind_param("is", $user_id, $today);
$upcomingQuery->execute();
$upcomingResult = $upcomingQuery->get_result();
$upcomingTalk = $upcomingResult->fetch_assoc();

$historyQuery = $conn->prepare("
    SELECT book_title, presentation_date 
    FROM book_talk 
    WHERE user_id = ? AND presentation_date < ? 
    ORDER BY presentation_date DESC
");
$historyQuery->bind_param("is", $user_id, $today);
$historyQuery->execute();
$historyResult = $historyQuery->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Profile</title>
    <style>
    body {
        margin: 0;
        padding: 80px;
        font-family: 'Segoe UI', sans-serif;
        background: url('wp2508260.webp') no-repeat center center fixed;
        background-size: cover;
        color: #ffffff;
    }

    .profile-box {
        width: 650px;
        margin: 60px auto;
        background: rgba(255, 255, 255, 0.15);
        border-radius: 18px;
        backdrop-filter: blur(14px);
        -webkit-backdrop-filter: blur(14px);
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.4);
        text-align: center;
        padding: 40px 30px;
        color: #fff;
    }

    .profile-box img {
        width: 130px;
        height: 130px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid #ffffffaa;
        margin-bottom: 20px;
        box-shadow: 0 0 15px #ffffff66;
    }

    .profile-box h2 {
        font-size: 28px;
        color: #ffffff;
    }

    .profile-box p {
        margin: 6px 0;
        font-size: 16px;
        color: #eeeeee;
    }

    .profile-box ul {
        text-align: left;
        padding-left: 25px;
        margin-top: 10px;
        background: rgba(255, 255, 255, 0.1);
        padding: 15px;
        border-radius: 10px;
        box-shadow: inset 0 0 5px rgba(255, 255, 255, 0.15);
        color: #f0f0f0;
    }

    .profile-box h3 {
        margin-top: 30px;
        font-size: 22px;
        color: #f9f9f9;
    }

    li {
        font-size: 15px;
        margin-bottom: 10px;
        color: #ffffffdd;
    }

    .return-btn {
        background-color: #e74c3c;
        color: white;
        border: none;
        padding: 6px 12px;
        font-size: 14px;
        border-radius: 4px;
        cursor: pointer;
    }

    .change-image-btn {
        display: inline-block;
        margin-top: 12px;
        padding: 8px 16px;
        background-color: #3498db;
        color: white;
        border-radius: 5px;
        text-decoration: none;
        font-size: 14px;
    }

    .return-btn.reissue {
        background-color: #27ae60;
    }

    strong {
        color: #ffffff;
    }
    </style>
</head>
<body>

<div class="profile-box">
    <?php
    $image = !empty($user['profile_image']) ? "uploads/{$user['profile_image']}" : "uploads/5.png";
    ?>
    <img src="<?php echo $image; ?>" alt="Profile Image">

    <a href="edit_profile.php" class="change-image-btn">Change Image</a>

    <h2><?php echo htmlspecialchars($user['firstName'] . ' ' . $user['lastName']); ?></h2>
    <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
    <p><strong>Role:</strong> <?php echo htmlspecialchars($user['role']); ?></p>
    <p><strong>Books Issued:</strong> <?php echo $totalIssued; ?></p>
    <p><strong>Books Returned:</strong> <?php echo $totalReturned; ?></p>

    <h3>📚 Currently Issued Books</h3>
<ul>
<?php
$totalFine = 0;
date_default_timezone_set("Asia/Kolkata");
if ($listResult->num_rows > 0) {
    while ($row = $listResult->fetch_assoc()) {
        $issueDate = new DateTime($row['issue_date']);
        $dueDate = clone $issueDate;
        $dueDate->modify('+5 minutes');

        $now = new DateTime();
        $fine = 0;

        if ($now > $dueDate) {
            $interval = $dueDate->diff($now);
            $minutesLate = ($interval->days * 24 * 60) + ($interval->h * 60) + $interval->i;
            $fine = min($minutesLate * 2, 300); // ₹2 per minute fine
            $totalFine += $fine;
        }

        echo "<li>
            <strong>" . htmlspecialchars($row['BookName']) . "</strong><br>
            Issued on: " . $issueDate->format('d M Y, h:i A') . "<br>
            Due by: <strong>" . $dueDate->format('d M Y, h:i A') . "</strong><br>";

        if ($fine > 0) {
            echo "<span style='color: #ffcccb;'>Overdue Fine: ₹" . $fine . "</span><br>
            <form action='fine_receipt.php' method='get' target='_blank' style='margin-top: 6px;'>
                <input type='hidden' name='book' value='" . urlencode($row['BookName']) . "'>
                <input type='hidden' name='issued' value='" . $issueDate->format('d M Y, h:i A') . "'>
                <input type='hidden' name='due' value='" . $dueDate->format('d M Y, h:i A') . "'>
                <input type='hidden' name='fine' value='" . $fine . "'>
                <input type='hidden' name='name' value='" . urlencode($user['firstName'] . ' ' . $user['lastName']) . "'>
 <button class='change-image-btn' style='background-color:#e67e22; margin:10px 0;'>🧾 Download Fine Receipt</button>

            </form>";
        } else {
            echo "<span style='color: #b6fcd5;'>No fine yet</span><br>";
        }

        echo "<form action='return_book.php' method='GET' style='display:inline; margin-top:5px;'>
                <input type='hidden' name='book_id' value='" . $row['book_id'] . "'>
                <input type='submit' value='Return' class='return-btn'>
              </form>
        </li>";
    }
} else {
    echo "<li>No currently issued books.</li>";
}
?>
</ul>

    <form action="certificate.php" method="post" style="margin-top: 20px;">
        <input type="hidden" name="full_name" value="<?php echo htmlspecialchars($user['firstName'] . ' ' . $user['lastName']); ?>">
        <button type="submit" class="change-image-btn" style="background-color:#8e44ad;">🎓 Download Certificate</button>
    </form>

    <h3>📖 Returned Book History</h3>
    <ul>
        <?php
        if ($returnedBooksResult->num_rows > 0) {
            while ($row = $returnedBooksResult->fetch_assoc()) {
                echo "<li>
                    <strong>" . htmlspecialchars($row['BookName']) . "</strong><br>
                    Issued on: " . $row['issue_date'] . "<br>
                    Returned on: " . $row['return_date'] . "
                    <form action='reissue_book.php' method='POST' style='display:inline-block; margin-top:5px;'>
                        <input type='hidden' name='book_id' value='" . $row['book_id'] . "'>
                        <input type='submit' value='Reissue' class='return-btn reissue'>
                    </form>
                </li>";
            }
        } else {
            echo "<li>No returned books found.</li>";
        }
        ?>
    </ul>

    <h3>🗓 Upcoming Book Talk</h3>
    <ul>
    <?php
    if ($upcomingTalk) {
        echo "<li>
            <strong>Title:</strong> " . htmlspecialchars($upcomingTalk['book_title']) . "<br>
            <strong>Date:</strong> " . date("F d, Y", strtotime($upcomingTalk['presentation_date'])) . "
        </li>";
    } else {
        echo "<li>No upcoming Book Talk registered.</li>";
    }
    ?>
    </ul>

    <h3>🕘 Book Talk History</h3>
    <ul>
    <?php
    if ($historyResult->num_rows > 0) {
        while ($row = $historyResult->fetch_assoc()) {
            echo "<li>
                <strong>Title:</strong> " . htmlspecialchars($row['book_title']) . "<br>
                <strong>Date:</strong> " . date("F d, Y", strtotime($row['presentation_date'])) . "
            </li>";
        }
    } else {
        echo "<li>No past Book Talk records found.</li>";
    }
    ?>
    </ul>

</div>

</body>
</html>
