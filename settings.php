<?php
session_start();

// Dummy user data (replace with DB operations in real projects)
$user = [
    'username' => 'admin',
    'email' => 'admin@example.com',
    'password' => 'admin123'
];

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newUsername = $_POST['username'];
    $newEmail = $_POST['email'];
    $newPassword = $_POST['password'];

    // In a real app, update these details in your database
    $user['username'] = $newUsername;
    $user['email'] = $newEmail;
    $user['password'] = $newPassword;

    echo "<script>alert('Settings updated successfully!');</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Settings</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
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

    .settings-container {
      background: #fff;
      padding: 30px;
      border-radius: 10px;
      max-width: 500px;
      margin: auto;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    h2 {
      text-align: center;
      margin-bottom: 20px;
    }

    label {
      display: block;
      margin-top: 15px;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"] {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      border-radius: 5px;
      border: 1px solid #ccc;
    }

    button {
      margin-top: 20px;
      padding: 10px 15px;
      background-color: #3b82f6;
      color: white;
      border: none;
      border-radius: 5px;
      width: 100%;
      cursor: pointer;
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
  </style>
</head>
<body>
  <div class="container">
    <aside class="sidebar">
      <h2>Library Admin</h2>
      <ul>
        <li onclick="location.href='index.php'">Dashboard</li>
        <li onclick="location.href='users.php'">Users</li>
        <li onclick="location.href='issued_books.php'">Issued Books</li>
        <li class="active">Settings</li>
        <li onclick="location.href='index7.php'">Logout</li>
      </ul>
    </aside>

    <main class="main-content">
      <div class="settings-container">
        <h2>Account Settings</h2>
        <form method="POST">
          <label for="username">Username:</label>
          <input type="text" name="username" id="username" value="<?php echo $user['username']; ?>" required>

          <label for="email">Email:</label>
          <input type="email" name="email" id="email" value="<?php echo $user['email']; ?>" required>

          <label for="password">Password:</label>
          <input type="password" name="password" id="password" value="<?php echo $user['password']; ?>" required>

          <button type="submit">Update Settings</button>
        </form>
      </div>
    </main>
  </div>
</body>
</html>
