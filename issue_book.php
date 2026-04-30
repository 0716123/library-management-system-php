<?php
$conn = new mysqli("localhost", "root", "", "book_management");

if (isset($_GET['book_id'])) {
    $bookId = $_GET['book_id'];

    // Fetch users for dropdown
    $users = $conn->query("SELECT id, CONCAT(firstName, ' ', lastName) AS name FROM users");

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $userId = $_POST['user_id'];
        $issueDate = date("Y-m-d H:i:s");  // ✅ Full date and time


        $stmt = $conn->prepare("INSERT INTO issued_books (book_id, user_id, issue_date, status) VALUES (?, ?, ?, 'Issued')");
        $stmt->bind_param("iis", $bookId, $userId, $issueDate);
        $stmt->execute();

        header("Location: index.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Issue Book</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body, html {
            font-family: 'Segoe UI', sans-serif;
            height: 100%;
        }

        .container {
            display: flex;
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
            background: url('wp2508260.webp') no-repeat center center fixed;
            background-size: cover;
            padding: 50px 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .issue-form-box {
            background-color: rgba(255, 255, 255, 0.96);
            width: 400px;
            padding: 30px 40px;
            border-radius: 16px;
            box-shadow: 0 0 25px rgba(0, 0, 0, 0.2), 0 8px 20px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .issue-form-box:hover {
            transform: scale(1.015);
            box-shadow: 0 0 35px rgba(0, 0, 0, 0.25), 0 10px 25px rgba(0, 0, 0, 0.25);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 8px;
        }

        select {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #4f46e5;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #4338ca;
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
        }

        @media (max-width: 480px) {
            .issue-form-box {
                width: 90%;
                padding: 20px;
            }

            button {
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
            <li onclick="location.href='index.php'">Dashboard</li>
            <li onclick="location.href='users.php'">Users</li>
            <li class="active">Issue Book</li>
            <li onclick="location.href='settings.php'">Settings</li>
            <li onclick="location.href='index7.php'">Logout</li>
        </ul>
    </aside>

    <main class="main-content">
        <div class="issue-form-box">
            <h2>📚 Issue Book</h2>
            <form method="POST">
                <label for="user">Select User:</label>
                <select name="user_id" required>
                    <option value="">-- Choose User --</option>
                    <?php while ($user = $users->fetch_assoc()) : ?>
                        <option value="<?php echo $user['id']; ?>"><?php echo $user['name']; ?></option>
                    <?php endwhile; ?>
                </select>
                <button type="submit">✅ Issue Book</button>
            </form>
        </div>
    </main>
</div>

</body>
</html>
