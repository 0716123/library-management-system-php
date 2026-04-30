2<!-- admin_login.php -->
<?php
session_start();
require_once 'db.php';

$login_error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    // Fetch admin by email
    $stmt = $conn->prepare("SELECT id, email, password FROM admin WHERE email = ? LIMIT 1");
    if ($stmt) {
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows === 1) {
            $stmt->bind_result($admin_id, $admin_email, $admin_password);
            $stmt->fetch();

            // Support both hashed and plaintext stored passwords
            $valid = password_verify($password, $admin_password) || ($password === $admin_password);

            if ($valid) {
                $_SESSION['admin_id'] = $admin_id;
                $_SESSION['admin_email'] = $admin_email;
                header('Location: index.php');
                exit();
            } else {
                $login_error = "Invalid email or password.";
            }
        } else {
            $login_error = "Admin not found.";
        }
        $stmt->close();
    } else {
        $login_error = "Login system error.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Login</title>
  <link rel="stylesheet" href="style12.css">
  <style>
    .error-message {
      color: red;
      text-align: center;
      margin-bottom: 10px;
      font-weight: bold;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1 class="form-title">Admin Login</h1>

    <?php if ($login_error): ?>
      <div class="error-message"><?= $login_error ?></div>
    <?php endif; ?>

    <form method="post" action="">
      <div class="input-group">
        <input type="email" name="email" placeholder="Admin Email" required>
        <label>Email</label>
      </div>
      <div class="input-group">
        <input type="password" name="password" placeholder="Admin Password" required>
        <label>Password</label>
      </div>

      <!-- Hidden field to detect admin login -->
      <input type="hidden" name="isAdmin" value="1">

      <input type="submit" class="btn" value="Login as Admin" name="signIn">
    </form>
  </div>
</body>
</html>
