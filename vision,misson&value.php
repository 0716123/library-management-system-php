<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Library and Learning Center</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      color: white;
      background: url('wp2508260.webp') no-repeat center center fixed;
      background-size: cover;
    }

    .header {
      /*background: url('wp2508260.webp') no-repeat center center fixed;*/
      padding: 80px;
      color: #00ffe1;
      font-size: 24px;
      font-weight: bold;
      text-align: center;
      text-shadow: 1px 1px 4px black;
    }

    .nav {
      display: flex;
      justify-content: center;
      background-color: rgba(255, 255, 255, 0.1);
      padding: 10px;
      gap: 15px;
      border-bottom: 2px solid #ddd;
    }

    .nav a {
      text-decoration: none;
      font-size: 16px;
      font-weight: bold;
      color: #ffffff;
      padding: 10px;
    }

    .nav a:hover {
      color: #00ffe1;
    }

    .content {
      text-align: center;
      margin-top: 30px;
    }

    .tabs {
      display: flex;
      justify-content: center;
      gap: 20px;
      border-bottom: 2px solid #00ffe1;
      padding-bottom: 10px;
    }

    .tab-button {
      padding: 10px 20px;
      border: none;
      background-color: rgba(255, 255, 255, 0.2);
      color: white;
      cursor: pointer;
      font-size: 16px;
      border-radius: 5px;
      transition: 0.3s;
    }

    .tab-button.active {
      background-color: #00ffe1;
      color: black;
      font-weight: bold;
    }

    .tab-content {
      margin-top: 40px;
      font-size: 18px;
      padding: 20px;
      background: rgba(0, 0, 0, 0.6);
      border: 2px solid #00ffe1;
      border-radius: 8px;
      max-width: 700px;
      margin-left: auto;
      margin-right: auto;
      text-align: left;
    }

    .visitor-stats {
      display: flex;
      justify-content: center;
      margin-top: 30px;
      gap: 10px;
    }

    .visitor-stats button {
      padding: 10px 20px;
      font-size: 16px;
      font-weight: bold;
      background-color: rgba(0, 255, 225, 0.7);
      color: #000;
      border: none;
      border-radius: 5px;
      box-shadow: 0 4px 8px rgba(255, 255, 255, 0.4);
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
  
  <div class="content">
    <div class="tabs">
      <button class="tab-button active" onclick="showTab(0)">Vision Statement</button>
      <button class="tab-button" onclick="showTab(1)">Mission Statement</button>
      <button class="tab-button" onclick="showTab(2)">Value Statement</button>
    </div>
    <div class="tab-content" id="tab-content">
      LLC's Vision is to be recognized as the most innovative, user-centered, academic and research Library.
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

  <script>
  function showTab(index) {
    const content = [
      "<div style='padding:10px; border:2px solid #00ffe1; border-radius:5px; margin:10px 0;'>LLC's Vision is to be recognized as the most innovative, user-centered, academic and research Library.</div>",

      "<div style='padding:10px; border:2px solid #00ffe1; border-radius:5px; margin:10px 0;'>LLC's Mission is to advance teaching, learning & research at AITS by:</div>" +
      "<ul><li style='padding:10px; border:2px solid #00ffe1; border-radius:5px; margin:10px 0;'>Teaching students to be successful, ethical information seekers.</li>" +
      "<li style='padding:10px; border:2px solid #00ffe1; border-radius:5px; margin:10px 0;'>Facilitating access to information resources.</li>" +
      "<li style='padding:10px; border:2px solid #00ffe1; border-radius:5px; margin:10px 0;'>Providing welcoming physical space for intellectual discovery.</li>" +
      "<li style='padding:10px; border:2px solid #00ffe1; border-radius:5px; margin:10px 0;'>Promoting the innovative adoption of emerging learning technologies.</li></ul>",

      "We Value:<br> <ul>" +
      "<li style='padding:10px; border:2px solid #00ffe1; border-radius:5px; margin:10px 0;'>Users and colleagues</li>" +
      "<li style='padding:10px; border:2px solid #00ffe1; border-radius:5px; margin:10px 0;'>Knowledge and learning</li>" +
      "<li style='padding:10px; border:2px solid #00ffe1; border-radius:5px; margin:10px 0;'>Accessibility and openness</li>" +
      "<li style='padding:10px; border:2px solid #00ffe1; border-radius:5px; margin:10px 0;'>Diversity and collaboration</li>" +
      "<li style='padding:10px; border:2px solid #00ffe1; border-radius:5px; margin:10px 0;'>Innovation and commitment</li>" +
      "<li style='padding:10px; border:2px solid #00ffe1; border-radius:5px; margin:10px 0;'>Accountability and integrity</li></ul>"
    ];

    document.getElementById('tab-content').innerHTML = content[index];

    const buttons = document.querySelectorAll('.tab-button');
    buttons.forEach((btn, i) => {
      btn.classList.toggle('active', i === index);
    });
  }
</script>

</body>
</html>
