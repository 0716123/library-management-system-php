<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Staff Reading Room</title>
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
      width: 85%;
      max-width: 1000px;
      margin: 40px auto;
      padding: 30px;
      background: rgba(0, 0, 0, 0.8); /* dark transparent background */
      box-shadow: 0 0 15px rgba(0, 255, 225, 0.3);
      border-radius: 10px;
    }

    h1 {
      text-align: center;
      color: #00ffe1;
      text-shadow: 1px 1px 5px black;
      border-bottom: 2px solid #00ffe1;
      padding-bottom: 10px;
    }

    p {
      text-align: justify;
      color: #e0e0e0;
      font-size: 17px;
      line-height: 1.8;
    }

    .gallery {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 15px;
      margin-top: 30px;
    }

    .gallery img {
      width: 100%;
      height: 180px;
      object-fit: cover;
      border-radius: 8px;
      box-shadow: 0 4px 10px rgba(0, 255, 225, 0.3);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .gallery img:hover {
      transform: scale(1.05);
      box-shadow: 0 6px 20px rgba(0, 255, 225, 0.6);
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
    <h1>Staff Reading Room</h1>
    <p>
      The Staff Reading Room at Atmiya University's Library and Learning Center provides a serene and focused environment for faculty and staff members. Nestled within the heart of the campus, this dedicated space offers a refuge for academic pursuits, research endeavors, and personal enrichment. Furnished with comfortable seating, ample lighting, and a diverse collection of scholarly resources, the Staff Reading Room serves as a haven for educators and administrative personnel to delve into literature, engage in collaborative discussions, and stay abreast of the latest developments in their respective fields.
    </p>
    <p>
      The room is designed to foster a sense of community among staff members, encouraging knowledge-sharing and intellectual exploration. Equipped with modern facilities and a tranquil ambiance, the Staff Reading Room exemplifies Atmiya University's commitment to cultivating a culture of continuous learning and professional development among its esteemed faculty and administrative staff.
    </p>

    <div class="gallery">
      <img src="staff1.jpg" alt="Staff Reading Room">
      <img src="staff2.webp" alt="Staff Reading Room">
      <img src="staff4.webp" alt="Staff Reading Room">
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
