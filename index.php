<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "book_management");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch books
$sql = "SELECT * FROM books";
$result = $conn->query($sql);

// Fetch total users
$userQuery = "SELECT COUNT(*) as total_users FROM users";
$userResult = $conn->query($userQuery);
$totalUsers = 0;
if ($userResult && $userResult->num_rows > 0) {
    $userRow = $userResult->fetch_assoc();
    $totalUsers = $userRow['total_users'];
}

// Fetch book availability
$availabilityQuery = "
    SELECT b.id, b.BookName, 
    CASE 
        WHEN (SELECT status FROM issued_books WHERE book_id = b.id ORDER BY id DESC LIMIT 1) = 'Issued' 
        THEN 'Not Available' 
        ELSE 'Available' 
    END AS availability
    FROM books b";
$availabilityResult = $conn->query($availabilityQuery);

$bookAvailability = [];
while ($row = $availabilityResult->fetch_assoc()) {
    $bookAvailability[$row['id']] = $row['availability'];
}

// Fetch issue/return status
$issueQuery = "
    SELECT b.BookName, b.id AS book_id, CONCAT(u.firstName, ' ', u.lastName) AS username, ib.issue_date, ib.return_date, ib.status 
    FROM issued_books ib
    JOIN books b ON ib.book_id = b.id
    JOIN users u ON ib.user_id = u.id
    ORDER BY ib.id DESC";

$issueResult = $conn->query($issueQuery);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Responsive Library Admin Panel</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body,
        html {
            font-family: 'Segoe UI', sans-serif;
            height: 100%;
        }

        .container {
            display: flex;
            flex-direction: row;
            height: 100vh;
        }

        .sidebar {
            width: 220px;
            background: #1f2937;
            color: #fff;
            padding: 20px;
            flex-shrink: 0;
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .sidebar ul {
            list-style: none;
        }

        .sidebar ul li {
            margin: 15px 0;
            cursor: pointer;
            padding: 8px 12px;
            border-radius: 5px;
        }

        .sidebar ul li.active,
        .sidebar ul li:hover {
            background: #374151;
        }

        .main-content {
            flex: 1;
            background: #f3f4f6;
            padding: 20px;
            overflow-y: auto;
        }

        header h1 {
            margin-bottom: 20px;
        }

        .cards {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
            margin-bottom: 30px;
        }

        .card {
            background: white;
            padding: 20px;
            border-radius: 8px;
            flex: 1 1 200px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .book-table {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
            min-width: 600px;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background: #e5e7eb;
        }

        tr:hover {
            background: #f1f5f9;
        }

        button {
            padding: 6px 10px;
            margin: 3px;
            border: none;
            background: #3b82f6;
            color: white;
            border-radius: 4px;
            cursor: pointer;
        }

        button.delete {
            background: #ef4444;
        }

        button.issue {
            background: #10b981;
        }

        button.return {
            background: #f59e0b;
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                text-align: center;
            }

            .sidebar ul {
                display: flex;
                justify-content: space-around;
                flex-wrap: wrap;
            }

            .main-content {
                padding: 10px;
            }

            .cards {
                flex-direction: column;
            }
        }

        @media (max-width: 480px) {
            th,
            td {
                font-size: 14px;
                padding: 8px;
            }

            button {
                padding: 4px 8px;
                font-size: 12px;
            }

            .card h3,
            .card p {
                font-size: 14px;
            }
        }
    </style>
</head>

<body>
<div class="container">
    <aside class="sidebar">
        <h2>Library Admin</h2>
        <ul>
            <li class="active">Dashboard</li>
            <li onclick="location.href='users.php'">Users</li>
            <li onclick="location.href='issued_books.php'">Issued Books</li>
            <li onclick="location.href='settings.php'">Settings</li>
            <li onclick="location.href='index7.php'">Logout</li>
        </ul>
    </aside>

    <main class="main-content">
        <header>
            <h1>Dashboard</h1>
        </header>

        <section class="cards">
            <div class="card">
                <h3>Total Books</h3>
                <p id="totalBooks"><?php echo $result->num_rows; ?></p>
            </div>
            <div class="card">
                <h3>Total Users</h3>
                <p id="totalUsers"><?php echo $totalUsers; ?></p>
            </div>
        </section>

        <section class="book-table" id="books">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; flex-wrap: wrap; gap: 10px;">
                <h2 style="margin: 0;">Books List</h2>
                <div>
                    <a href="add.php"><button style="background-color: #10b981;">➕ Add Book</button></a>
                    <a href="add_ebook.php"><button style="background-color: #6366f1;">➕ Add Ebook</button></a>
                    <a href="add_thesis.php"><button style="background-color: #ec4899;">➕ Add Thesis</button></a>
                    <a href="add_proceeding.php"><button style="background-color: #f97316;">➕ Add Proceedings</button></a>
                    <a href="add_journal.php"><button style="background-color: #3b82f6;">➕ Add Journal</button></a>
                </div>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Book Name</th>
                        <th>Author</th>
                        <th>Price</th>
                        <th>Book No</th>
                        <th>Availability</th>
                        
                    </tr>
                </thead>
                <tbody>
                <?php while ($row = $result->fetch_assoc()) : ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['BookName']; ?></td>
                        <td><?php echo $row['AuthorName']; ?></td>
                        
                        <td><?php echo $row['BookNo']; ?></td>
                        <td><?php echo $bookAvailability[$row['id']] ?? 'Unknown'; ?></td>
                        <td>
                            <a href="edit.php?id=<?php echo $row['id']; ?>"><button>Edit</button></a>
                            <a href="delete.php?id=<?php echo $row['id']; ?>"><button class="delete">Delete</button></a>
                            <?php if (($bookAvailability[$row['id']] ?? '') == 'Available'): ?>
                                <a href="issue_book.php?book_id=<?php echo $row['id']; ?>"><button class="issue">Issue</button></a>
                            <?php else: ?>
                                <a href="return_book1.php?book_id=<?php echo $row['id']; ?>"><button class="return">Return</button></a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
                </tbody>
            </table>
        </section>
    </main>
</div>
</body>

</html>

<?php $conn->close(); ?>
