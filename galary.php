<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Library Gallery</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background: url('wp2508260.webp') no-repeat center center fixed;
      background-size: cover;
      color: white;
    }

    h1 {
      text-align: center;
      color: #00ffe1;
      text-shadow: 1px 1px 4px black;
    }

    .gallery {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 20px;
      padding: 30px;
      max-width: 1200px;
      margin: auto;
      background: rgba(0, 0, 0, 0.7);
      border-radius: 10px;
      box-shadow: 0 0 20px rgba(0, 255, 225, 0.3);
    }

    .gallery img {
      width: 100%;
      height: 200px;
      object-fit: cover;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0, 255, 225, 0.3);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .gallery img:hover {
      transform: scale(1.05);
      box-shadow: 0 6px 20px rgba(0, 255, 225, 0.6);
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

  <h1>📷 Library Gallery</h1>
  <div class="gallery">
    <img src="1.webp" alt="Reading Room">
    <img src="2.jpg" alt="Ancient Library">
    <img src="3.jpg" alt="Modern Library Interior">
    <img src="4.jpg" alt="British Library">
    <img src="5.jpg" alt="Trinity College Library">
    <img src="6.jpg" alt="NY Public Library">
    <img src="7.webp" alt="Library Hall">
    <img src="8.webp" alt="Vienna University Library">
    <img src="9.webp" alt="Eton Library">
    <img src="10.webp" alt="Leuven Library">
    <img src="11.webp" alt="Leuven Library">
    <img src="12.webp" alt="Leuven Library">
    <img src="13.webp" alt="Leuven Library">
    <img src="14.webp" alt="Leuven Library">
    <img src="15.jpg" alt="Leuven Library">
    <img src="16.webp" alt="Leuven Library">

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
