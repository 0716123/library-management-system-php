<?php
session_start();
include 'connect.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index7.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch user name and profile image
$sql = "SELECT firstName, lastName, profile_image FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("User not found.");
}

$row = $result->fetch_assoc();
$name = htmlspecialchars($row['firstName'] . ' ' . $row['lastName']);
$profile_image = htmlspecialchars($row['profile_image']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Certificate</title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
  <style>
    body {
      background: #f9f6f2;
      font-family: 'Georgia', serif;
      margin: 0;
      padding: 0;
    }

    .certificate-container {
      width: 1000px;
      height: 600px;
      padding: 40px 50px;
      margin: 30px auto;
      background: #fff8ed;
      border: 10px solid #6e4d2f;
      box-shadow: 0 0 10px rgba(0,0,0,0.2);
      text-align: center;
      position: relative;
    }

    h1 {
      font-size: 40px;
      color: #4d2e00;
    }

    .subtitle {
      font-size: 20px;
      color: #333;
      margin-bottom: 20px;
    }

    .profile-image {
      margin: 0 auto 10px;
    }

    .profile-image img {
      width: 120px;
      height: 120px;
      border-radius: 50%;
      object-fit: cover;
      border: 4px solid #c3a776;
      box-shadow: 0 0 10px rgba(0,0,0,0.2);
    }

    .name {
      font-size: 34px;
      font-weight: bold;
      margin: 10px 0;
      color: #000;
    }

    .message {
      font-size: 18px;
      line-height: 1.5;
      color: #222;
    }

    .quote {
      margin-top: 30px;
      font-size: 16px;
      font-style: italic;
      color: #555;
    }

    .footer {
      margin-top: 50px;
      font-size: 20px;
      color: #4d2e00;
      font-weight: bold;
    }

    .border-decor {
      margin-top: 15px;
      font-size: 24px;
      color: #c3a776;
    }

    #downloadBtn {
      display: block;
      margin: 20px auto;
      padding: 10px 20px;
      font-size: 16px;
      background: #4d2e00;
      color: #fff;
      border: none;
      cursor: pointer;
      border-radius: 5px;
    }

    #downloadBtn:hover {
      background: #3a2200;
    }
  </style>
</head>
<body>

<!-- Certificate Section -->
<div id="certificate" class="certificate-container">
  <h1>CERTIFICATE OF APPRECIATION</h1>
  <div class="subtitle">This is proudly presented to</div>

  <?php if (!empty($profile_image)) : ?>
    <div class="profile-image">
      <img src="uploads/<?php echo $profile_image; ?>" alt="Profile Image">
    </div>
  <?php endif; ?>

  <div class="name"><?php echo $name; ?></div>

  <div class="message">
    for actively engaging in knowledge acquisition<br>
    by issuing a book from<br>
    <strong>Tattva Gyan Learning Center</strong>.
  </div>

  <div class="quote">"Keep reading, keep growing."</div>

  <div class="footer">Tattva Gyan Learning Center</div>

  <div class="border-decor">★ ★ ★</div>
</div>

<!-- Download Button -->
<button id="downloadBtn">Download Certificate as Image</button>

<!-- JavaScript -->
<script>
document.getElementById("downloadBtn").addEventListener("click", function() {
    html2canvas(document.getElementById("certificate")).then(function(canvas) {
        var link = document.createElement('a');
        link.download = "certificate.png";
        link.href = canvas.toDataURL();
        link.click();
    });
});
</script>

</body>
</html>
