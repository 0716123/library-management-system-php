<?php
session_start();
include 'connect.php';
include 'navbar.php';

$isLoggedIn = isset($_SESSION['user_id']);
$userId = $_SESSION['user_id'] ?? null;

$conn = new mysqli("localhost", "root", "", "book_management");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM books";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Books Collection</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', sans-serif;
      background: url('wp2508260.webp') no-repeat center center fixed;
      background-size: cover;
      color: #000;
    }

    .container {
      width: 90%;
      margin: 100px auto 40px;
    }

    h1 {
      text-align: center;
      color: #dddee6ff;
      margin-bottom: 30px;
    }

    .ebooks-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
      gap: 30px;
    }

    .ebook-card {
      background: white;
      padding: 20px;
      margin: 5px;
      border-radius: 10px;
      box-shadow: 0 5px 10px rgba(59, 188, 208, 0.85);
      transition: transform 0.2s ease;
    }

    .ebook-card:hover {
      transform: translateY(-5px);
    }

    .ebook-card h3 {
      color: #0f172a;
      margin: 10px 0;
    }

    .ebook-card p {
      margin: 10px 0;
      color: #374151;
    }

    .price-tag {
      font-weight: bold;
      color: #d97706;
    }

    .ebook-image {
      width: 100%;
      height: 200px;
      overflow: hidden;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: -5px;
      border-radius: 8px;
      background: #f9f9f9;
    }

    .ebook-image img {
      width: 50%;
      height: 75%;
      object-fit: cover;
      border-radius: 5px;
    }

    .issue-btn {
      padding: 6px 14px;
      margin-top: 10px;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    .issue {
      background-color: #10b981;
    }

    .return {
      background-color: #ef4444;
    }

    .issued-date {
      margin-top: 8px;
      font-size: 0.9rem;
      color: #6b7280;
    }
  </style>
</head>
<body>

<div class="container">
  <h1>📚 Available Books</h1>

  <?php if ($result->num_rows > 0): ?>
    <div class="ebooks-grid">
      <?php while($row = $result->fetch_assoc()): ?>
        <div class="ebook-card">
          <h3><?= htmlspecialchars($row['BookName']) ?></h3>
          <p><strong>Author:</strong> <?= htmlspecialchars($row['AuthorName']) ?></p>
          <p><strong>Book No:</strong> <?= htmlspecialchars($row['BookNo']) ?></p>
          

          <div class="ebook-image">
            <img src="<?= htmlspecialchars($row['img']) ?>" alt="Book Cover">
          </div>

          <?php if ($isLoggedIn): ?>
            <?php
              $bookId = $row['id'];

              // Check if book is issued to ANYONE (status: issued and not returned)
              $anyIssued = $conn->prepare("SELECT user_id, issue_date FROM issued_books WHERE book_id = ? AND return_date IS NULL LIMIT 1");
              $anyIssued->bind_param("i", $bookId);
              $anyIssued->execute();
              $anyIssuedResult = $anyIssued->get_result();
              $isIssuedToAnyone = $anyIssuedResult->num_rows > 0;

              $issuedByUser = false;
              $issueDate = null;

              if ($isIssuedToAnyone) {
                  $rowIssued = $anyIssuedResult->fetch_assoc();
                  if ($rowIssued['user_id'] == $userId) {
                      $issuedByUser = true;
                      $issueDate = $rowIssued['issue_date'];
                  }
              }
            ?>

            <?php if ($issuedByUser): ?>
              <form action="issue_return.php" method="POST">
                <input type="hidden" name="book_id" value="<?= $bookId ?>">
                <input type="hidden" name="action" value="return">
                <button type="submit" class="issue-btn return">Return</button>
              </form>
              <p class="issued-date">📅 Issued on: <?= date("d M Y", strtotime($issueDate)) ?></p>

            <?php elseif ($isIssuedToAnyone): ?>
              <p style="color:red; font-weight:bold;">❌ Not Available</p>

            <?php else: ?>
              <form action="issue_return.php" method="POST">
                <input type="hidden" name="book_id" value="<?= $bookId ?>">
                <input type="hidden" name="action" value="issue">
                <button type="submit" class="issue-btn issue">Issue</button>
              </form>
            <?php endif; ?>
          <?php endif; ?>
        </div>
      <?php endwhile; ?>
    </div>
  <?php else: ?>
    <p style="text-align:center;">No books found in the database.</p>
  <?php endif; ?>
</div>

</body>
</html>

<?php $conn->close(); ?>
