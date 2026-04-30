<?php
$conn = new mysqli("localhost", "root", "", "book_management");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "
    SELECT users.firstName, users.lastName, books.BookName, books.AuthorName, ib.issue_date, ib.return_date
    FROM issued_books ib
    JOIN users ON ib.user_id = users.id
    JOIN books ON ib.book_id = books.id
";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Issued Books</title>
    <style>
        * {
                margin: 0;
                padding: 0;
                
                box-sizing: border-box;
            }
        
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            /*background: url('wp2508260.webp') no-repeat center center fixed;*/
            background-size: cover;
        }

        .main-container {
            display: flex;
            min-height: 100vh;
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
            color: white;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
            width: 100%;
        }

        .sidebar ul li {
             margin: 15px 0;
                cursor: pointer;
                padding: 8px 12px;
                border-radius: 5px;
        }

        .sidebar ul li:hover {
            background-color: #374151;
            
        }

        .content {
            flex: 1;
            padding: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.95);
            

            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.25);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            width: 90%;
            max-width: 1000px;
        }
        

        .container:hover {
            transform: scale(1.01);
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
        }

        .sidebar h2 {
                text-align: center;
                margin-bottom: 20px;
            }

        table {
            border-collapse: collapse;
            width: 100%;
            border-radius 20px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            
        }

        th, td {
            padding: 14px 18px;
            text-align: left;
        }

        thead {
            background-color: #4f46e5;
            color: #fff;
        }

        tbody tr {
            transition: background 0.2s ease;
        }

        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tbody tr:hover {
            background-color: #e0e7ff;
        }

        td {
            color: #333;
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
        /* Active Sidebar Highlight */
        
    </style>
</head>
<body>

<div class="main-container">
    <!-- Sidebar -->
    <aside class="sidebar">
            <h2>Library Admin</h2>
          <ul>
    <li onclick="location.href='index.php'">Dashboard</li>
    <li onclick="location.href='users.php'">Users</li>
    <li onclick="location.href='issued_books.php'">Issued Books</li><!-- 👈 Added -->
    <li onclick="location.href='settings.php'">Settings</li>
    <li onclick="location.href='index7.php'">Logout</li>
</ul>

        </aside>

    <!-- Content Area -->
    <div class="content">
        <div class="container">
            <h2>📚 Issued Books List</h2>
            <table>
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Book Name</th>
                        <th>Author</th>
                        <th>Issue Date</th>
                        <th>Return Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['firstName'] . ' ' . $row['lastName']); ?></td>
                            <td><?php echo htmlspecialchars($row['BookName']); ?></td>
                            <td><?php echo htmlspecialchars($row['AuthorName']); ?></td>
                            <td><?php echo htmlspecialchars($row['issue_date']); ?></td>
                            <td><?php echo $row['return_date'] ? htmlspecialchars($row['return_date']) : '<em>Not Returned</em>'; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>

<?php $conn->close(); ?>
