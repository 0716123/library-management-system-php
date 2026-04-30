<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Library Bookshop</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: "Segoe UI", sans-serif;
    }

    body {
      background: url('wp2508260.webp') no-repeat center center fixed;
      background-size: cover;
      color: white;
      padding: 20px;
    }

    .header {
      background: url('a963081c-331e-4373-94f5-6aa1081a3ff2.png') no-repeat center;
      background-size: cover;
      padding: 50px 20px;
      text-align: center;
      font-size: 32px;
      font-weight: bold;
      text-shadow: 1px 1px 3px black;
      border-radius: 12px;
      margin-bottom: 30px;
      box-shadow: 0 4px 15px rgba(0, 255, 225, 0.5); /* ✅ SHADOW */
    }

    .container {
      background: rgba(255, 255, 255, 0.15);
      backdrop-filter: blur(10px);
      -webkit-backdrop-filter: blur(10px);
      width: 90%;
      max-width: 1100px;
      margin: auto;
      padding: 2rem;
      border-radius: 15px;
      box-shadow: 0 10px 30px rgba(0, 255, 225, 0.4); /* ✅ SHADOW added here */
    }

    h2 {
      text-align: center;
      font-size: 26px;
      margin-bottom: 10px;
      color: white;
      text-shadow: 1px 1px 3px rgba(0,0,0,0.6);
    }

    p.description {
      text-align: center;
      color: #e0e0e0;
      font-size: 1.1rem;
      margin-bottom: 1.5rem;
    }

    .gallery {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 20px;
    }

    .gallery img {
      width: 100%;
      border-radius: 10px;
      box-shadow: 0 6px 15px rgba(255, 255, 255, 0.5); /* ✅ Image SHADOW added */
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .gallery img:hover {
      transform: scale(1.03);
      box-shadow: 0 8px 20px rgba(0, 255, 225, 0.7); /* ✅ Glow on hover */
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

  
  <div class="header">Library and Learning Center</div>

  <div class="container">
    <h2>Library Bookshop</h2>
    <p class="description">The Library Bookshop has General Books, Coffee Mugs, T-Shirts etc on Sale.</p>
    
    <div class="gallery">
      <img src="https://library.atmiyauni.ac.in/cdn/images/book-shop/1-1024x683.jpg" alt="Bookshop Image 1">
      <img src="https://library.atmiyauni.ac.in/cdn/images/book-shop/2-1024x683.jpg" alt="Bookshop Image 2">
      <img src="https://library.atmiyauni.ac.in/cdn/images/book-shop/3-1024x683.jpg" alt="Bookshop Image 3">
      <img src="20.jpg" alt="Bookshop Image 4">
      <img src="https://library.atmiyauni.ac.in/cdn/images/book-shop/5-1024x683.jpg" alt="Bookshop Image 5">
      <img src="https://library.atmiyauni.ac.in/cdn/images/book-shop/6-1024x683.jpg" alt="Bookshop Image 6">
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
