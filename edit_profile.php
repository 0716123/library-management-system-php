<?php
session_start();
include 'connect.php';

$userId = $_SESSION['user_id'] ?? null;
if (!$userId) {
    header("Location: index7.php");
    exit;
}

// Handle image update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['new_profile_image'])) {
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($_FILES["new_profile_image"]["name"]);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    if (!in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
        echo "❌ Invalid file type.";
        exit;
    }

    if (move_uploaded_file($_FILES["new_profile_image"]["tmp_name"], $targetFile)) {
        $profileImage = basename($targetFile);
        $stmt = $conn->prepare("UPDATE users SET profile_image = ? WHERE id = ?");
        $stmt->bind_param("si", $profileImage, $userId);
        if ($stmt->execute()) {
            $_SESSION['success'] = "✅ Profile image updated.";
        } else {
            $_SESSION['error'] = "❌ Failed to update image.";
        }
    } else {
        $_SESSION['error'] = "❌ Failed to upload file.";
    }

    header("Location: edit_profile.php");
    exit;
}

// Get current image
$stmt = $conn->prepare("SELECT profile_image, firstName, lastName FROM users WHERE id = ?");
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Profile Image</title>
  <style>
    body {
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 170px;
  background: url('wp2508260.webp') no-repeat center center fixed;
  background-size: cover;
}

    .container {
      max-width: 400px;
      margin: auto;
      background: white;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.2);
      text-align: center;
    }
    .container img {
      width: 120px;
      height: 120px;
      border-radius: 50%;
      object-fit: cover;
      margin-bottom: 20px;
    }
    .container input[type="file"] {
      margin: 10px 0;
    }
    .container button {
      padding: 10px 25px;
      border: none;
      background: #007bff;
      color: white;
      border-radius: 6px;
      cursor: pointer;
    }
    .msg {
      margin: 10px 0;
      padding: 8px;
      border-radius: 6px;
      font-size: 15px;
    }
    .success { background-color: #d4edda; color: #155724; }
    .error { background-color: #f8d7da; color: #721c24; }
  </style>
</head>
<body>

<div class="container">
  <h2>Edit Profile Image</h2>
  
  <?php if (!empty($_SESSION['success'])): ?>
    <div class="msg success"><?= $_SESSION['success']; unset($_SESSION['success']); ?></div>
  <?php endif; ?>
  
  <?php if (!empty($_SESSION['error'])): ?>
    <div class="msg error"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
  <?php endif; ?>
  
  <img src="uploads/<?= htmlspecialchars($user['profile_image'] ?? 'default.png') ?>" alt="Profile Image">

  <form method="POST" enctype="multipart/form-data">
    <input type="file" name="new_profile_image" accept="image/*" required><br>
    <button type="submit">Update Image</button>
  </form>
</div>

</body>
</html>
