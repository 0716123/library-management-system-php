<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Media Library</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background: url('wp2508260.webp') no-repeat center center fixed;
      background-size: cover;
      color: white;
    }

    .container {
      max-width: 900px;
      margin: 40px auto;
      background: rgba(0, 0, 0, 0.75); /* dark transparent layer */
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 15px rgba(0, 255, 225, 0.4);
    }

    h1 {
      color: #00ffe1;
      text-align: center;
      text-shadow: 1px 1px 4px black;
    }

    .description {
      text-align: center;
      font-size: 18px;
      margin-bottom: 20px;
    }

    .purpose-list {
      list-style-type: none;
      padding: 0;
    }

    .purpose-list li {
      background: rgba(255, 255, 255, 0.1);
      margin: 5px 0;
      padding: 12px;
      border-radius: 5px;
      border: 1px solid rgba(0, 255, 225, 0.3);
    }

    .images {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 15px;
      margin-top: 30px;
    }

    .images img {
      width: 260px;
      height: 160px;
      object-fit: cover;
      border-radius: 8px;
      box-shadow: 0 4px 12px rgba(0, 255, 225, 0.2);
      transition: transform 0.3s;
    }

    .images img:hover {
      transform: scale(1.05);
      box-shadow: 0 6px 20px rgba(0, 255, 225, 0.4);
    }
    html, body{
      margin: 0;
      padding: 0;
    }

    .footer {
      /*background: url('wp2508260.webp') no-repeat center center fixed;*/
      padding: 80px 20px;
      color: white;
      display: flex;
      justify-content: space-around;
      flex-wrap: wrap;
      margin-top: 40px;
      border: 2px solid #00ffe1;
    }

    .footer div {
      max-width: 300px;
      margin-bottom: 20px;
    }

    .footer h3 {
      border-bottom: 2px solid white;
      padding-bottom: 5px;
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
  <?php include 'navbar.php'; ?>
  <div class="container">
    <h1>Media Library</h1>
    <p class="description">
      The Library and Learning Centre has made an arrangement of Media Library on the ground floor of the LLC.
    </p>

    <ul class="purpose-list">
      <li>Lecture room to conduct lectures where classroom strength is maximum 40.</li>
      <li>Presentation Practice room for students and faculty for project presentations.</li>
      <li>Library Lectures and Information Literacy Programmes.</li>
      <li>Video lectures relay such as NPTEL video lectures.</li>
      <li>Movie shows extension activities of Library.</li>
      <li>Special lecture series for Library Clubs.</li>
      <li>Video Conferencing room.</li>
      <li>Live TV connectivity with recording facility.</li>
    </ul>

    <div class="images">
      <img src="17.webp" alt="Lecture Room">
      <img src="18.webp" alt="Video Conference">
      <img src="19.webp" alt="Students Attending Session">
    </div>
  </div>

  <div class="footer">
    <div>
      <h3>Facilities</h3>
      <a href="#">Book Shop</a>
      <a href="#">Digital Library</a>
      <a href="#">Media Library</a>
      <a href="#">Video Conference/Webinars</a>
      <a href="#">Virtual Tour</a>
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
