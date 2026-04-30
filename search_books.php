<?php
session_start();
include 'connect.php';

if (!isset($_SESSION['user_id'])) {
    echo "<p style='color:yellow; text-align:center; margin-top:50px;'>Please log in to issue books.</p>";
    exit();
}

$user_id = $_SESSION['user_id'];

$searchTerm = isset($_GET['query']) ? $conn->real_escape_string($_GET['query']) : '';

$sql = "SELECT * FROM books 
        WHERE BookName LIKE '%$searchTerm%' 
           OR AuthorName LIKE '%$searchTerm%' 
           OR BookNo LIKE '%$searchTerm%'";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Search Results</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', sans-serif;
            background: url('wp2508260.webp') no-repeat center center fixed;
            background-size: cover;
            color: #fff;
        }

        .container {
            max-width: 800px;
            margin: 60px auto;
            padding: 20px;
            background-color: rgba(0, 0, 0, 0.7);
            border-radius: 15px;
        }

        h2 {
            text-align: center;
            color: #4fc3f7;
            text-shadow: 2px 2px 5px rgba(0,0,0,0.5);
            margin-bottom: 30px;
        }

        .result-box {
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            padding: 15px 20px;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .book-img img {
            width: 100px;
            height: 130px;
            border-radius: 8px;
            object-fit: cover;
            box-shadow: 0 4px 8px rgba(0,0,0,0.3);
        }

        .book-info {
            flex: 1;
        }

        .book-info strong {
            color: #ffeb3b;
        }

        .issue-btn {
            background-color: #4caf50;
            color: white;
            border: none;
            padding: 10px 18px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .issue-btn:hover {
            background-color: #388e3c;
        }

        .message {
            margin-top: 15px;
            text-align: center;
            font-weight: bold;
        }

        .message.success {
            color: #4caf50;
        }

        .message.error {
            color: #f44336;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Search Results for "<?php echo htmlspecialchars($searchTerm); ?>"</h2>

        <div id="messageBox"></div>

        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $book_id = $row['id'];
                $checkIssued = "SELECT * FROM issued_books WHERE book_id = $book_id AND return_date IS NULL";
                $issuedResult = $conn->query($checkIssued);
                $isIssued = $issuedResult->num_rows > 0;

                // ✅ Use image path as stored in DB
                $imgPath = !empty($row['img']) ? $row['img'] : 'img/default.jpg';

                echo "<div class='result-box'>";
                
                // Book image
                echo "<div class='book-img'>";
                echo "<img src='" . htmlspecialchars($imgPath) . "' alt='Book Image'>";
                echo "</div>";

                // Book details
                echo "<div class='book-info'>";
                echo "<strong>Book Name:</strong> " . htmlspecialchars($row['BookName']) . "<br>";
                echo "<strong>Author:</strong> " . htmlspecialchars($row['AuthorName']) . "<br>";
                echo "<strong>Book No:</strong> " . htmlspecialchars($row['BookNo']) . "<br>";
                
                echo "</div>";

                // Issue Button or Not Available
                if (!$isIssued) {
                    echo "<button class='issue-btn' data-bookid='" . intval($row['id']) . "'>Issue</button>";
                } else {
                    echo "<span style='color: red; font-weight: bold;'>Not Available</span>";
                }

                echo "</div>";
            }
        } else {
            echo "<p style='text-align:center;'>No results found.</p>";
        }
        ?>
    </div>

    <script>
        document.querySelectorAll('.issue-btn').forEach(button => {
            button.addEventListener('click', () => {
                const bookId = button.getAttribute('data-bookid');

                fetch('issue_book_ajax.php', {
                    method: 'POST',
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                    body: 'book_id=' + encodeURIComponent(bookId)
                })
                .then(response => response.json())
                .then(data => {
                    const messageBox = document.getElementById('messageBox');
                    if (data.success) {
                        messageBox.innerHTML = `<p class="message success">${data.message}</p>`;
                    } else {
                        messageBox.innerHTML = `<p class="message error">${data.message}</p>`;
                    }
                })
                .catch(() => {
                    const messageBox = document.getElementById('messageBox');
                    messageBox.innerHTML = `<p class="message error">Error issuing book. Try again later.</p>`;
                });
            });
        });
    </script>
</body>
</html>
