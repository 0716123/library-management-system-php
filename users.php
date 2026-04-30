<?php
$conn = new mysqli("localhost", "root", "", "book_management");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch users
$sql = "SELECT * FROM users";
$result = $conn->query($sql);

// Fetch total books
$bookQuery = "SELECT COUNT(*) as total_books FROM books";
$bookResult = $conn->query($bookQuery);
$totalBooks = 0;

if ($bookResult && $bookResult->num_rows > 0) {
    $bookRow = $bookResult->fetch_assoc();
    $totalBooks = $bookRow['total_books'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Users Panel</title>
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

    table {
      width: 100%;
      border-collapse: collapse;
      background: white;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
      border-radius: 8px;
      overflow: hidden;
      min-width: 600px;
    }

    th, td {
      padding: 12px;
      border-bottom: 1px solid #ddd;
      text-align: left;
    }

    th {
      background-color: #e5e7eb;
    }

    tr:hover {
      background-color: #f1f5f9;
    }

    a {
      text-decoration: none;
      padding: 6px 10px;
      background: #3b82f6;
      color: white;
      border-radius: 4px;
      margin-right: 5px;
    }

    a.delete {
      background: #ef4444;
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
      th, td {
        font-size: 14px;
        padding: 8px;
      }

      a {
        padding: 4px 8px;
        font-size: 12px;
      }

      .card h3, .card p {
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
        <li class="active">Users</li>
        <li onclick="location.href='issued_books.php'">Issued Books</li>
        <li onclick="location.href='settings.php'">Settings</li>
        <li onclick="location.href='index7.php'">Logout</li>
      </ul>
    </aside>

    <main class="main-content">
      <header>
        <h1>Users Panel</h1>
      </header>

      <section class="cards">
        <div class="card">
          <h3>Total Users</h3>
          <p><?php echo $result->num_rows; ?></p>
        </div>
        <div class="card">
          <h3>Total Books</h3>
          <p><?php echo $totalBooks; ?></p>
        </div>
      </section>

      <section class="book-table">
        <h2>Registered Users</h2>
        <table>
          <thead>
            <tr>
              <th>ID</th>
              <th>First Name</th>
              <th>Last Name</th>
              <th>Email</th>
              <th>Password</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php while($row = $result->fetch_assoc()): ?>
              <tr>
                <td><?= $row['id']; ?></td>
                <td><?= $row['firstName']; ?></td>
                <td><?= $row['lastName']; ?></td>
                <td><?= $row['email']; ?></td>
                <td><?= $row['password']; ?></td>
                <td>
                  <a href="edit_user.php?id=<?= $row['id']; ?>">Edit</a>
                  <a href="delete_user.php?id=<?= $row['id']; ?>" class="delete">Delete</a>
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
