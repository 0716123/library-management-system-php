<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Book Talk | Tattva Gyan Learning Center</title>
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background: url('wp2508260.webp') no-repeat center center fixed;
      background-size: cover;
      color: #fff;
    }

    .overlay {
      background-color: rgba(0, 0, 0, 0.3);
      min-height: 100vh;
      padding-bottom: 40px;
    }

    header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 10px 20px;
    }

    .logo-title {
      display: flex;
      align-items: center;
    }

    .logo-title img {
      width: 60px;
      height: 60px;
      border-radius: 50%;
      object-fit: cover;
      margin-right: 10px;
    }

    .logo-title h1 {
      font-size: 1.8rem;
      margin: 0;
      font-weight: 700;
      color: white;
    }

    nav {
      display: flex;
      gap: 10px;
    }

    nav a {
      text-decoration: none;
      color: white;
      background-color: rgba(255, 255, 255, 0.15);
      padding: 8px 15px;
      border-radius: 10px;
      font-weight: bold;
      box-shadow: 0 0 8px #555;
      transition: background 0.3s, transform 0.2s;
    }

    nav a:hover {
      background-color: #ffffff33;
      transform: scale(1.05);
    }

    .book-talk {
      padding: 50px 20px 20px;
      max-width: 1000px;
      margin: auto;
      background-color: rgba(255, 255, 255, 0.05);
      border-radius: 12px;
    }

    .book-talk h2 {
      font-size: 2.5em;
      margin-bottom: 10px;
      color: #fff;
      text-align: center;
    }

    .book-talk p {
      font-size: 1.2em;
      color: #ccc;
      text-align: center;
      margin-bottom: 30px;
    }

    .book-talk h3 {
      font-size: 1.8em;
      border-bottom: 2px solid #00ccff;
      margin-bottom: 10px;
      color: #00ccff;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 15px;
      background-color: rgba(255, 255, 255, 0.07);
    }

    table th, table td {
      padding: 10px;
      border: 1px solid #ccc;
      text-align: center;
      color: #fff;
    }

    table th {
      background-color: #003366;
      color: white;
    }

    table tr:nth-child(even) {
      background-color: rgba(255, 255, 255, 0.05);
    }

    table a {
      color: #00ccff;
      text-decoration: underline;
    }

    footer {
      background: url('f1c5ce8c-f0ed-4484-97b3-70165a23dfeb.png') no-repeat center center;
      background-size: cover;
      color: white;
      padding: 40px 60px;
      display: flex;
      justify-content: space-between;
      flex-wrap: wrap;
      border: 1px solid #00ffff;
    }

    footer div {
      width: 30%;
      min-width: 250px;
    }

    footer h3 {
      margin-top: 0;
      border-bottom: 2px solid cyan;
      display: inline-block;
      padding-bottom: 5px;
    }

    @media screen and (max-width: 768px) {
      nav {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
      }

      nav a {
        margin: 5px 0;
      }

      footer {
        flex-direction: column;
        align-items: center;
      }

      footer div {
        width: 90%;
        margin-bottom: 20px;
      }
    }

    @media (max-width: 600px) {
      header {
        flex-direction: column;
        align-items: flex-start;
      }

      nav {
        flex-wrap: wrap;
        justify-content: flex-start;
      }

      .logo-title h1 {
        font-size: 1.5rem;
      }

      .book-talk h2 {
        font-size: 2em;
      }
    }
  </style>
</head>
<body>
  <div class="overlay">
    <header>
      
      <?php include 'navbar.php';?>
    </header>

    <section class="book-talk">
      <h2>📚 Book Talk</h2>
      <p>Enhancing reading culture through book reflections by faculty and staff</p>

      <h3>About Book Talk</h3>
      <p>
        The “Book Talk” activity is held every Saturday at 2:30 PM to promote a reading culture
        among faculty and staff. Presenters discuss motivational, self-help, management, and
        philosophical books. Titles like <em>“Atomic Habits”</em>, <em>“The Power of Now”</em>,
        and <em>“Who Moved My Cheese?”</em> have been featured.
      </p>

      <h3>2024 Book Talk Reports</h3>
      <table>
        <thead>
          <tr>
            <th>#</th>
            <th>Book Title</th>
            <th>Author</th>
            <th>Presenter</th>
            <th>Date</th>
            <th>Department</th>
            <th>Mode</th>
            <th>Video</th>
          </tr>
        </thead>
        <tbody>
  <tr>
    <td>1</td>
    <td>चलो बेहतर सोचे</td>
    <td>Satyendra Tiwari</td>
    <td>Satyendra Tiwari</td>
    <td>02-02-2024</td>
    <td>–</td>
    <td>In-person</td>
    <td><a href="#">Watch</a></td>
  </tr>
  <tr>
    <td>2</td>
    <td>Atomic Habits</td>
    <td>James Clear</td>
    <td>Dr. Alpa Joshi</td>
    <td>01-03-2024</td>
    <td>FOBC</td>
    <td>In-person</td>
    <td><a href="#">Watch</a></td>
  </tr>
  <tr>
    <td>3</td>
    <td>The Power of Now</td>
    <td>Eckhart Tolle</td>
    <td>Prof. Mehta</td>
    <td>08-03-2024</td>
    <td>IT</td>
    <td>Online</td>
    <td><a href="#">Watch</a></td>
  </tr>
  <tr>
    <td>4</td>
    <td>Who Moved My Cheese?</td>
    <td>Spencer Johnson</td>
    <td>Dr. Gohil</td>
    <td>15-03-2024</td>
    <td>Management</td>
    <td>Hybrid</td>
    <td><a href="#">Watch</a></td>
  </tr>
  <tr>
    <td>5</td>
    <td>Mindset</td>
    <td>Carol Dweck</td>
    <td>Prof. Shah</td>
    <td>22-03-2024</td>
    <td>Psychology</td>
    <td>In-person</td>
    <td><a href="#">Watch</a></td>
  </tr>
  <tr>
    <td>6</td>
    <td>The Alchemist</td>
    <td>Paulo Coelho</td>
    <td>Ms. Kiran Joshi</td>
    <td>05-04-2024</td>
    <td>Languages</td>
    <td>Online</td>
    <td><a href="#">Watch</a></td>
  </tr>
  <tr>
    <td>7</td>
    <td>Ikigai</td>
    <td>Francesc Miralles</td>
    <td>Mr. Bharat Patel</td>
    <td>12-04-2024</td>
    <td>Wellness</td>
    <td>Hybrid</td>
    <td><a href="#">Watch</a></td>
  </tr>
  <tr>
    <td>8</td>
    <td>Deep Work</td>
    <td>Cal Newport</td>
    <td>Dr. Sejal Parmar</td>
    <td>19-04-2024</td>
    <td>Engineering</td>
    <td>In-person</td>
    <td><a href="#">Watch</a></td>
  </tr>
  <tr>
    <td>9</td>
    <td>Start With Why</td>
    <td>Simon Sinek</td>
    <td>Mr. Nilesh Chauhan</td>
    <td>26-04-2024</td>
    <td>FOBC</td>
    <td>Online</td>
    <td><a href="#">Watch</a></td>
  </tr>
  <tr>
    <td>10</td>
    <td>Grit</td>
    <td>Angela Duckworth</td>
    <td>Dr. Hemali Vyas</td>
    <td>03-05-2024</td>
    <td>Education</td>
    <td>In-person</td>
    <td><a href="#">Watch</a></td>
  </tr>
  <tr>
    <td>11</td>
    <td>Think Like a Monk</td>
    <td>Jay Shetty</td>
    <td>Ms. Sheetal Rana</td>
    <td>10-05-2024</td>
    <td>Values</td>
    <td>Online</td>
    <td><a href="#">Watch</a></td>
  </tr>
  <tr>
    <td>12</td>
    <td>Rich Dad Poor Dad</td>
    <td>Robert Kiyosaki</td>
    <td>Dr. Hitesh Bhatt</td>
    <td>17-05-2024</td>
    <td>Commerce</td>
    <td>Hybrid</td>
    <td><a href="#">Watch</a></td>
  </tr>
</tbody>

      </table>
    </section>

    <footer>
      <div>
        <h3>Facilities</h3>
        <p>Book Shop<br>Digital Library<br>Media Library<br>Video Conference/Webinars<br>Virtual Tour</p>
      </div>
      <div>
        <h3>Contact Details</h3>
        <p>Library and Learning Center<br>Atmiya University<br>Rajkot, Gujarat<br>
        Phone: +91 02812563445/1212<br>
        Email: librarian@atmiyauni.ac.in<br>
        Address: Atmiya University, Kalawad Road, Rajkot-360005 Gujarat, India</p>
      </div>
      <div>
        <h3>Developed By</h3>
        <p>Kalpesh Ghediya (B.C.A 5th Sem)</p>
      </div>
    </footer>
  </div>
</body>
</html>
