<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Tattva Gyan Learning Center</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

<?php
if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['user'])) {
    exit; // This will fully stop the page
}

?>



  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: Arial, sans-serif;
      padding-top: 100px;
      background-color: #f8f9fa;
    }

    /* Navbar styling */
    #navbar {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      z-index: 1000;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 20px 30px;
      background: url('wp2508260.webp') no-repeat center center fixed;
      background-size: cover;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.4);
      border-bottom: 1px solid #00f2ff;
    }

    .logo {
      display: flex;
      align-items: center;
    }

    .logo-circle {
      width: 60px;
      height: 60px;
      background-color: #00f2ff;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #000;
      font-weight: bold;
      font-size: 20px;
      box-shadow: 0 0 20px #00f2ff;
      margin-right: 15px;
      animation: glow 2s infinite alternate;
    }

    @keyframes glow {
      0% {
        box-shadow: 0 0 10px #00f2ff;
      }
      100% {
        box-shadow: 0 0 30px #00f2ff, 0 0 60px #00f2ff;
      }
    }

    .logo-text {
      font-size: 28px;
      font-weight: bold;
      color: white;
      text-shadow: 1px 1px 2px black;
      margin-left: 30px;
    }

    .nav-links {
      display: flex;
      align-items: center;
      gap: 15px;
    }

    .nav-btn {
      background-color: #222;
      color: white;
      padding: 10px 16px;
      border: none;
      border-radius: 10px;
      font-weight: bold;
      cursor: pointer;
      box-shadow: 0 4px 8px rgba(255, 255, 255, 0.4);
      transition: all 0.3s ease;
    }

    .nav-btn:hover {
      background-color: #00f2ff;
      color: black;
    }

    /* Dropdown styling */
    .dropdown {
      position: relative;
    }

    .dropdown-content {
      display: none;
      position: absolute;
      top: 45px;
      background-color: #444;
      min-width: 200px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,255,255,0.5);
      z-index: 999;
    }

    .dropdown-content a {
      display: block;
      padding: 10px 15px;
      color: white;
      text-decoration: none;
      border-bottom: 1px solid rgba(255, 255, 255, 0.1);
      transition: 0.2s ease;
    }

    .dropdown-content a:hover {
      background-color: #00f2ff;
      color: black;
    }

    .dropdown-toggle::after {
      content: ' ▾';
      font-size: 10px;
    }

    /* Underline below navbar */
    #navbar::after {
      content: "";
      position: absolute;
      left: 0;
      right: 0;
      bottom: 0;
      height: 3px;
      background: linear-gradient(to right, cyan, transparent, cyan);
    }
    .logo img {
  height: 60px;
  vertical-align: middle;
  transition: transform 0.3s ease;
}

.logo img:hover {
  transform: scale(1.05);
}

  </style>
</head>


<body>

  <!-- Navbar -->
  <div id="navbar">
    <div class="logo">
    <a href="index11.php">
  <img src="logo2.png" alt="Tattva Gyan Logo" style="height: 60px; border-radius: 50%; ">
</a>


      <div class="logo-text">Tattva Gyan Learning Center</div>
    </div>
    <div class="nav-links">

    

      <a href="booktalk.php"><button class="nav-btn">Event</button></a>

      <a href="index11.php"><button class="nav-btn">Home</button></a>
      
      <!-- About Us Dropdown -->  
      <div class="dropdown">
        <button class="nav-btn dropdown-toggle" onclick="toggleDropdown('aboutDropdown')">About Us</button>
        <div class="dropdown-content" id="aboutDropdown">
          <a href="code of conduct.php">Code of Conduct</a>
          <a href="galary.php">Gallery</a>
          <a href="vision,misson&value.php">Vision, Mission & Values</a>
        </div>
      </div>

      <!-- Facility Dropdown -->
      <div class="dropdown">
        <button class="nav-btn dropdown-toggle" onclick="toggleDropdown('facilityDropdown')">Facility</button>
        <div class="dropdown-content" id="facilityDropdown">
          <a href="Media Library.php">Media Library</a>
          <a href="Staff Reading Room.php">Staff Reading Room</a>
          <a href="Bookshop.php">Book Shop</a>
        </div>
      </div>

      <a href="contact.php"><button class="nav-btn">Feedback</button></a>
    </div>
  </div>

  <!-- Script for Dropdown -->
  <script>
    function toggleDropdown(id) {
      const dropdown = document.getElementById(id);
      const isVisible = dropdown.style.display === "block";

      // Close all dropdowns
      document.querySelectorAll('.dropdown-content').forEach(el => el.style.display = "none");

      // Show clicked one
      dropdown.style.display = isVisible ? "none" : "block";
    }

    // Close dropdowns if clicked outside
    window.addEventListener("click", function (e) {
      if (!e.target.matches('.dropdown-toggle')) {
        document.querySelectorAll('.dropdown-content').forEach(el => el.style.display = "none");
      }
    });
  </script>

</body>
</html>