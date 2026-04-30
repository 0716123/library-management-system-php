<?php
session_start();
include 'connect.php';
include 'navbar.php';

$isLoggedIn = isset($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>📘 Book Talk Event</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      margin: 80px;
      padding: 0;
      background: url('wp2508260.webp') no-repeat center center fixed;
      background-size: cover;
      color: #fff;
    }

    .container {
      max-width: 1000px;
      margin: 40px auto;
      padding: 40px;
      background: rgba(0, 0, 0, 0.6);
      border-radius: 12px;
      box-shadow: 0 0 25px rgba(0, 0, 0, 0.5);
    }

    h1, h2, h3, h4 {
      color: #ffdd99;
      margin-bottom: 10px;
    }

    p, li {
      color: #f2f2f2;
      line-height: 1.6;
    }

    ul, ol {
      padding-left: 25px;
      margin-top: 10px;
    }

    .btn {
      display: inline-block;
      margin-top: 15px;
      padding: 10px 25px;
      background: #ffdd99;
      color: #333;
      font-weight: bold;
      text-decoration: none;
      border-radius: 6px;
      transition: 0.3s ease;
    }

    .btn:hover {
      background: #ffcc66;
    }

    .book-talk-card {
      background: rgba(255, 255, 255, 0.1);
      padding: 15px;
      margin: 20px 0;
      border-left: 5px solid #ffcc66;
      border-radius: 5px;
    }

    .gallery img {
      width: 180px;
      height: 120px;
      object-fit: cover;
      margin: 10px;
      border: 3px solid #fff;
      border-radius: 6px;
      transition: transform 0.3s ease;
    }

    .gallery img:hover {
      transform: scale(1.05);
    }

    .call-to-action {
      margin-top: 40px;
      padding: 25px;
      background: rgba(255, 255, 255, 0.1);
      border-radius: 10px;
      text-align: center;
    }

    .section {
      margin-bottom: 50px;
    }

    a {
      color: #ffcc66;
    }

    /* Footer Styles without border */
    .footer {
      padding: 80px 20px;
      color: white;
      display: flex;
      justify-content: space-around;
      flex-wrap: wrap;
      margin-top: 40px;
      background: rgba(0,0,0,0.6);
      border-radius: 12px;
    }

    .footer div {
      max-width: 300px;
      margin-bottom: 20px;
    }

    .footer h3 {
      border-bottom: 2px solid white;
      padding-bottom: 5px;
      margin-bottom: 10px;
    }

    .footer a {
      color: white;
      text-decoration: none;
      display: block;
      margin-top: 5px;
    }

    .footer a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="container">

    <!-- 1. Introduction -->
    <div class="section">
      <h1>📘 Book Talk: Unlocking Knowledge Through Sharing</h1>
      <p>Book Talk is a special event hosted by our library, where readers share their thoughts and reviews about books they have read. It's about encouraging reading, public speaking, and sharing ideas.</p>
    </div>

    <!-- 2. Purpose -->
    <div class="section">
      <h3>📌 Purpose of Book Talk</h3>
      <ul>
        <li>Encourage reading habits among students</li>
        <li>Develop expression and communication skills</li>
        <li>Inspire others with shared book experiences</li>
      </ul>
    </div>

    <!-- 3. How It Works -->
    <div class="section">
      <h3>🚀 How It Works</h3>
      <ol>
        <li>Select and read any book of your interest</li>
        <li>Prepare a short presentation or summary</li>
        <li>Present your views during the Book Talk session</li>
      </ol>
    </div>

    <!-- 4. Gallery -->
    <div class="section gallery">
      <h3>📷 Book Talk Gallery</h3>
      <img src="booktalk1.png" alt="Book Talk 1">
      <img src="booktalk2.png" alt="Book Talk 2">
      <img src="booktalk3.png" alt="Book Talk 3">
    </div>

    <!-- 5. Registration -->
    <div class="section">
      <h3>📝 Join the Book Talk</h3>
      <?php if ($isLoggedIn): ?>
        <a href="book_talk_register.php" class="btn">📩 Register Now</a>
      <?php else: ?>
        <p>Please <a href="index7.php">log in</a> to register for Book Talk.</p>
      <?php endif; ?>
    </div>

    <!-- 6. Highlights -->
    <div class="section">
      <h3>🌟 Recent Book Talk Highlights</h3>
      <div class="book-talk-card">
        <h4>"The Alchemist"</h4>
        <p><strong>Presented by:</strong> Kalpesh Ghediya</p>
        <p>A magical journey about following your dreams and believing in destiny.</p>
      </div>
      <div class="book-talk-card">
        <h4>"Ikigai"</h4>
        <p><strong>Presented by:  </strong>Pratik Ghediya</p>
        <p>Learn how to find purpose, peace, and long-lasting joy through this Japanese philosophy.</p>
      </div>
    </div>

    <!-- 7. Certificate Download -->
    <div class="section">
      <h3>🎓 Download Certificate</h3>
      <?php if ($isLoggedIn): ?>
        <a href="book_talk_certificate.php" class="btn">📥 Get Certificate</a>
      <?php else: ?>
        <p>Log in to download your Book Talk certificate.</p>
      <?php endif; ?>
    </div>

    <!-- 8. Call to Action -->
    <div class="section call-to-action">
      <h2>📚 Start Your Book Talk Journey!</h2>
      <p>Inspire others, express your ideas, and grow your knowledge through books. Join our Book Talk and be a part of our learning community.</p>
    </div>

  </div>

  <!-- Footer -->
  <div class="footer">
    <div>
      <h3>Facilities</h3>
      <a href="#">Book Shop</a>
      <a href="#">Digital Library</a>
      <a href="#">Media Library</a>
      
      
    </div>
    <div>
      <h3>Contact Details</h3>
      Library and Learning Center<br />
      Atmiya University<br />
      Rajkot, Gujarat<br />
      Phone: +91 02812563445/1212<br />
      Email: librarian@atmiyauni.ac.in<br />
      Address: Kalawad Road, Rajkot-360005 Gujarat, India
    </div>
    <div>
      <h3>Developed By</h3>
      Kalpesh Ghediya (B.C.A 5th Sem)
      <br>Rishit Bhateliya (B.C.A 5th Sem)
    </div>
  </div>

  
</body>
</html>
