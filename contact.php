<?php
$conn = new mysqli("localhost", "root", "", "book_management");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

include 'navbar.php';

$success = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name    = $conn->real_escape_string($_POST['name']);
    $email   = $conn->real_escape_string($_POST['email']);
    $subject = $conn->real_escape_string($_POST['subject']);
    $message = $conn->real_escape_string($_POST['message']);

    if (!empty($name) && !empty($email) && !empty($subject) && !empty($message)) {
        $sql = "INSERT INTO contacts (name, email, subject, message) 
                VALUES ('$name', '$email', '$subject', '$message')";
        if ($conn->query($sql) === TRUE) {
            $success = "Thank you! Your message has been sent.";
        } else {
            $error = "Error: " . $conn->error;
        }
    } else {
        $error = "All fields are required.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Contact Us</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: url('wp2508260.webp') no-repeat center center fixed;
            background-size: cover;
            color: #fff;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
        }

        form {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            padding: 30px;
            border-radius: 16px;
            max-width: 500px;
            width: 100%;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.25);
            color: #fff;
            margin: 80px 0 40px; /* top and bottom spacing */
        }

        input, textarea {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            background: rgba(255, 255, 255, 0.2);
            color: #fff;
        }

        input::placeholder, textarea::placeholder {
            color: #eee;
        }

        input:focus, textarea:focus {
            outline: none;
            box-shadow: 0 0 10px #6ee7b7;
            background: rgba(255, 255, 255, 0.3);
        }

        button {
            background: #00c9a7;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            font-size: 1rem;
            transition: background 0.3s ease;
        }

        button:hover {
            background: #00a58c;
        }

        h2 {
            text-align: center;
            margin-top: 0;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.6);
        }

        .success {
            color: #00ff99;
            text-align: center;
            margin-bottom: 15px;
            font-weight: bold;
        }

        .error {
            color: #ff6666;
            text-align: center;
            margin-bottom: 15px;
            font-weight: bold;
        }

        label {
            font-weight: bold;
            text-shadow: 1px 1px 2px #000;
            display: block;
            margin-top: 10px;
        }

        footer {
            width: 100%;
            /*background: rgba(0, 0, 0, 0.6);*/
            padding: 15px;
            color: #ddd;
            text-align: center;
            position: relative;
            bottom: 0;
        }





.footer-container {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  max-width: 1200px;
  margin: auto;
  text-align: center;
}

.footer-column {
  flex: 1;
  min-width: 250px;
  margin: 10px 20px;
}

.footer-column:first-child {
  text-align: left; /* Facilities to left */
}

.footer-column:nth-child(2) {
  text-align: center; /* Contact Details center */
}

.footer-column:last-child {
  text-align: right; /* Developed By to right */
}







    </style>
</head>
<body>

<form method="POST" action="">
    <h2>Feedback</h2>

    <?php if ($success): ?>
        <p class="success"><?= $success; ?></p>
    <?php elseif ($error): ?>
        <p class="error"><?= $error; ?></p>
    <?php endif; ?>

    <label>Name:</label>
    <input type="text" name="name" placeholder="Enter your name" required>

    <label>Email:</label>
    <input type="email" name="email" placeholder="Enter your email" required>

    <label>Subject:</label>
    <input type="text" name="subject" placeholder="Enter subject" required>

    <label>Message:</label>
    <textarea name="message" rows="5" placeholder="Write your message..." required></textarea>

    <button type="submit">Send Message</button>
</form>



<footer style="border-top: 3px solid #00ffe0; padding-top: 20px;">

  <div class="footer-container">
    <div class="footer-column">
      <h3>Facilities</h3>
      <ul>
        <li>Book Shop</li>
        <li>Digital Library</li>
        <li>Media Library</li>
        <li>Video Conference/Webinars</li>
        <li>Virtual Tour</li>
      </ul>
    </div>
    <div class="footer-column">
      <h3>Contact Details</h3>
      <p>Library and Learning Center<br>
      Atmiya University<br>
      Rajkot, Gujarat<br>
      Phone: +91 02812563445/1212<br>
      Email: librarian@atmiyauni.ac.in<br>
      Address: Kalawad Road, Rajkot-360005<br>
      Gujarat, India</p>
    </div>
    <div class="footer-column">
      <h3>Developed By</h3>
      <p>Kalpesh Ghediya (B.C.A 5th Sem)</p>
      <p>Rishit Bhateliya (B.C.A 5th Sem)</p>
    </div>
  </div>
</footer>



</body>
</html>

<?php $conn->close(); ?>
