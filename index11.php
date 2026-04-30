<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "book_management";


session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index7.php");
    exit();
}







$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$printBooksCount = $conn->query("SELECT COUNT(*) AS total FROM books")->fetch_assoc()['total'];
$periodicalsCount = $conn->query("SELECT COUNT(*) AS total FROM journals")->fetch_assoc()['total'];
$ebooksCount = $conn->query("SELECT COUNT(*) AS total FROM ebooks")->fetch_assoc()['total'];
$ejournalsCount = 0; // You can update this if you separate e-journals in the future
$conferenceCount = $conn->query("SELECT COUNT(*) AS total FROM proceedings")->fetch_assoc()['total'];
$thesisCount = $conn->query("SELECT COUNT(*) AS total FROM thesis")->fetch_assoc()['total'];
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tattva Gyan Learning Center</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background: url('wp2508260.webp') no-repeat center center fixed;
            background-size: cover;
            color: #000;
        }

        .header {
    position: absolute;
    top: 20px;
    left: 20px;
    background: url('a963081c-331e-4373-94f5-6aa1081a3ff2.png') no-repeat center center;
    background-size: cover;
    color: white;
    font-size: 28px;
    font-weight: bold;
    text-shadow: 1px 1px 3px black;
    padding: 10px 20px;
    margin-top: -7px;
    
    z-index: 99;
}

.logo-text {
      font-size: 28px;
      font-weight: bold;
      color: white;
      text-shadow: 1px 1px 2px black;
      margin-left: 10px;
    }



        .nav {
    position: absolute;
    top: 25px;
    right: 20px; /* You can adjust this to move more left/right */
    display: flex;
    align-items: center;
    gap: 20px;
    z-index: 100;
}
/*body.sidebar-open .nav {
    display: none;
}*/


        .nav a,
        .dropbtn {
            color: white;
            font-weight: bold;
            text-decoration: none;
            padding: 8px 15px;
            border-radius: 5px;
            transition: 0.3s ease;
            background-color: rgba(255, 255, 255, 0.2);
            border: none;
            cursor: pointer;
            box-shadow: 0 4px 8px rgba(255, 255, 255, 0.5); /* ✅ HERE */
        }

        .nav a:hover,
        .dropbtn:hover {
            background-color: rgba(0, 255, 225, 0.57);
        }

        .dropdown {
            position: relative;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: white;
            min-width: 200px;
            border-radius: 5px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.5);
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            padding: 10px;
            display: block;
            text-decoration: none;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .search-bar {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            background: url('search-background.webp') no-repeat center center;
            background-size: cover;
            margin-top: -80px;
        }
.search-bar input {
  width: 400px;        /* Increase width */
  height: 20px;        /* Taller input */
  padding: 12px 15px;  /* More padding */
  font-size: 18px;     /* Bigger text */
  border-radius: 8px;
  border: none;
  outline: none;
  margin-bottom: 50px;
}


 .search-bar button {
    background-color: rgba(255, 255, 255, 0.2); /* Always visible background */
    color: white;
    font-weight: bold;
    padding: 8px 20px;
    border: none;
    font-size: 18px;
    cursor: pointer;
    border-radius: 8px;
    transition: 0.3s;
    margin-left: 10px;
    box-shadow: 0 4px 8px rgba(255, 255, 255, 0.5); /* ✅ HERE */
}


.search-bar button:hover {
    background-color: rgba(0, 255, 225, 0.57);
    color: white;
}


        .resources {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 30px;
            flex-wrap: wrap;
        }

.resources button {
  min-width: 150px;
  background-color: rgba(255, 255, 255, 0.2);
  color: white;
  border: none;
  font-size: 18px;
  font-weight: bold;
  padding: 20px 20px;
  border-radius: 8px;
  cursor: pointer;
  transition: 0.3s;
  box-shadow: 0 4px 8px rgba(255, 255, 255, 0.5); /* ✅ HERE */
}

.resources button:hover {
  background-color: rgba(0, 255, 225, 0.57);
  
  /* No underline */
}
.nav, .resources, .visitor-stats {
    justify-content: center;
    flex-wrap: wrap;
}


        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            margin: 40px 0;
        }

        .card {
            background: #f8f8f8;
            padding: 60px;
            width: 200px;
            text-align: center;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.90);
            transition: 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 10px rgba(0, 255, 225, 0.90);
        }

        .card h2 {
            font-size: 22px;
            color: #000;
        }

        .card p {
            font-size: 16px;
            color: #666;
        }

        .visitor-stats {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-bottom: 40px;
        }

        .visitor-stats button {
    background-color: rgba(255,255,255,0.2);
    color: white;
    font-size: 16px;
    padding: 10px 20px;
    border: none;
    border-radius: 8px;
    font-weight: bold;
    cursor: pointer;
    transition: 0.3s;
    box-shadow: 0 4px 8px rgba(255, 255, 255, 0.5); /* ✅ HERE */
}

.visitor-stats button:hover {
    background-color: rgba(0, 255, 225, 0.57);
}


        .footer {
            background: url('a963081c-331e-4373-94f5-6aa1081a3ff2.png') no-repeat center center;
            background-size: cover;
            color: white;
            padding: 50px;
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            text-shadow: 1px 1px 3px black;
        }

        .footer div {
            max-width: 300px;
            margin-bottom: 50px;
        }

        .bx {
            font-size: 40px;
            color: #007BFF;
        }
        .sidebar {
    height: 100%;
    width: 250px;
    position: fixed;
    top: 0;
    left: 0;
    background-color: rgba(0, 0, 0, 0.85);
    padding-top: 60px;
    overflow-x: hidden;
    transition: 0.5s;
    z-index: 1000;
    box-shadow: 4px 0 15px rgba(0, 255, 225, 0.3); /* 🌟 Shadow added */
    border-right: 1px solid rgba(255, 255, 255, 0.1); /* Optional border */
}


.sidebar a, .sidebar .dropdown-btn {
    padding: 10px 20px;
    text-decoration: none;
    font-size: 18px;
    color: white;
    display: block;
    transition: 0.3s;
    background: none;
    border: none;
    text-align: left;
    width: 150%;
    font-weight: bold;
    cursor: pointer;
}

.sidebar a:hover, .sidebar .dropdown-btn:hover {
    background-color: rgba(0,255,225,0.3);
    box-shadow: inset 2px 0 5px rgba(0, 255, 225, 0.3); /* subtle glow */
}


.dropdown-container {
    display: none;
    background-color: rgba(255, 255, 255, 0.05);
    padding-left: 15px;
    margin-top: 0px; /* 🛠 Add this line to pull it up slightly */
    box-shadow: inset 0 0 5px rgba(0, 255, 225, 0.2);
    border-left: 2px solid rgba(0, 255, 225, 0.2);
}


.sidebar .active {
    background-color: rgba(0,255,225,0.5);
}


/* Hamburger icon */
.hamburger {
    font-size: 15px;
    color: white;
    position: fixed;
    top: 20px;
    left: 20px;
    cursor: pointer;
    z-index: 1100;
    background-color: rgba(0, 0, 0, 0.5);
    padding: 8px 15px;
    border-radius: 10px;
    box-shadow: 2px 2px 13px rgba(0, 255, 225, 0.4);
    margin-top: -10px;
}

/* Hide sidebar by default on smaller screens */
#sidebar {
    transform: translateX(-260px);
    transition: 0.4s ease;
}

/* Show sidebar when active */
#sidebar.active {
    transform: translateX(0);
}

/* Push content when sidebar is active (optional) */
body.sidebar-open {
    margin-left: 250px;
}
.main-content {
    margin-left: 0;
    transition: margin-left 0.3s ease;
    padding: 20px;
}

body.sidebar-open .main-content {
    margin-left: 10px;
}

.sidebar button.dropdown-btn {
    margin-bottom: 2px;
    border-bottom: 2px solid rgba(255,255,255,0.1); /* line between buttons */
}
body:not(.sidebar-open) .header,
body:not(.sidebar-open) .main-content {
    margin-left: 0;
    text-align: center;
}
.section-divider {
    border: none;
    height: 2px;
    background: rgba(0, 255, 225, 0.6);
    margin: 90px auto;
    width: 100%;
    box-shadow: 0 0 10px rgba(0, 255, 225, 0.5);
}
.footer-divider {
    
    border: none;
    height: 2px; /* Thicker line */
    width: 102%;  /* Wider line */
    margin: 80px auto 0 auto; /* Space around it */
    margin: -20px;
    background: rgba(0, 255, 225, 0.8);
    box-shadow: 0 0 12px rgba(0, 255, 225, 0.7);
    overflow-x: hidden;
    margin-top: 60px;
}
.scroll-wrapper {
  width: 100%;
  overflow: hidden;
  position: relative;
  background: transparent;
}

.scroll-track {
  display: flex;
  width: fit-content;
  animation: scroll-left 10s linear infinite;
  animation-play-state: running; /* default state */
}

.scroll-wrapper:hover .scroll-track {
  animation-play-state: paused; /* pause on hover */
}

.scroll-track img {
  height: 220px;
  width: 150px;
  margin-right: 15px;
  object-fit: cover;
  border-radius: 10px;
}


/* animation for smooth scrolling */
@keyframes scroll-left {
  0% {
    transform: translateX(0%);
  }
  100% {
    transform: translateX(-50%);
  }
}

.scroll-title {
  text-align: center;
  font-size: 32px;
  font-weight: bold;
  margin: 30px 0 20px;
  color: #2a7de1;
  font-family: 'Segoe UI', sans-serif;
  letter-spacing: 2px;
  text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
  margin-bottom: 20px;
}
html, body {
    margin: 0;
    padding: 0;
}




@import url('https://fonts.googleapis.com/css2?family=Orbitron:wght@700&display=swap');

.logo-circle {
  left: -30px;
  transform: translateY(-18px);
  display: inline-flex;
  justify-content: center;
  align-items: center;
  background: radial-gradient(circle at center, rgba(0,255,225,0.2), rgba(0, 0, 0, 0.8));
  width: 70px;
  height: 70px;
  border-radius: 50%;
  margin-right: 15px;
  position: relative;
  box-shadow: 0 0 20px rgba(0, 255, 225, 0.7);
  overflow: hidden;
  animation: glowPulse 2s infinite ease-in-out;
}

/* Rotating neon ring border */
.animated-ring::before {
  content: '';
  position: absolute;
  width: 100%;
  height: 100%;
  border-radius: 50%;
  border: 3px solid rgba(0,255,225,0.3);
  box-shadow: 0 0 10px rgba(0,255,225,0.5);
  animation: spin 5s linear infinite;
}

/* Stylish futuristic letters */
.letter {
  font-family: 'Orbitron', sans-serif;
  font-size: 28px;
  font-weight: 700;
  color: #00ffe1;
  text-shadow: 0 0 8px #00ffe1, 0 0 12px rgba(0,255,225,0.8);
  opacity: 0;
}

.letter.t {
  animation: typeT 1s forwards ease-in-out;
}

.letter.g {
  animation: typeG 1s forwards 0.8s ease-in-out;
}

@keyframes typeT {
  from { opacity: 0; transform: translateY(10px) rotate(-10deg); }
  to { opacity: 1; transform: translateY(0) rotate(0deg); }
}

@keyframes typeG {
  from { opacity: 0; transform: translateX(-10px) rotate(10deg); }
  to { opacity: 1; transform: translateX(0) rotate(0deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

@keyframes glowPulse {
  0%, 100% { box-shadow: 0 0 15px rgba(0,255,225,0.6); }
  50% { box-shadow: 0 0 25px rgba(0,255,225,1); }
}

.logo-img {
  height: 60px;
  width: 60px;
  border-radius: 50%;
  margin-right: 15px;
  object-fit: cover;
  margin-top: -15px; /* 👈 This moves the image up */
  margin-left:-10px;
}


.header {
  display: flex;
  align-items: center;
  position: absolute;
  top: 20px;
  left: 20px;
  z-index: 99;
  font-size: 24px;
  font-weight: bold;
  text-shadow: 1px 1px 3px black;
  color: white;
}

.header-text {
  font-family: 'Segoe UI', sans-serif;
  color: white;
}

.profile-icon-btn {
  display: inline-flex;
  justify-content: center;
  align-items: center;
  width: 42px;
  height: 42px;
  border-radius: 50%;
  background-color: rgba(255, 255, 255, 0.1);
  color: white;
  font-size: 20px;
  text-decoration: none;
  transition: background-color 0.3s, transform 0.2s;
  box-shadow: 0 0 8px rgba(0, 255, 255, 0.3);
}

.profile-icon-btn:hover {
  background-color: rgba(0, 255, 200, 0.4);
  transform: scale(1.05);
}
 



    



    </style>
</head>
<body>
    <!-- Hamburger Icon -->
<!--<span class="hamburger" onclick="toggleSidebar()">&#9776;</span>
-->

<div class="header">
  <img src="logo2.png" alt="Tattva Gyan Logo" class="logo-img">
  <div class="logo-text">Tattva Gyan Learning Center</div>
</div>



    <hr class="section-divider">

    <div id="sidebar" class="sidebar">
    <a href="index11.php">Home</a>
    <button class="dropdown-btn">About Us</button>
    <div class="dropdown-container">
        <a href="Code of Conduct.php">Code of Conduct</a>
        
        <a href="galary.php">Gallery</a>
        <a href="vision,misson&value.html">Vision, Mission & Values</a>
    </div>
    
    <button class="dropdown-btn">Facility</button>
    <div class="dropdown-container">
        <a href="Media Library.php">Media Library</a>
        <a href="Staff Reading Room.html">Staff Reading Room</a>
        <a href="Bookshop.html">Book Shop</a>
    </div>
    <a href="contact.php">Feedback</a>
</div>

    <div class="main-content">

    <div class="nav">

    <!-- Remove -->
<!-- <button class="dropbtn" onclick="location.href='profile.php'">My Profile</button> -->




        
        <button class="dropbtn" onclick="location.href='booktalk.php'">Event</button>

        <button class="dropbtn" onclick="location.href='index11.php'">Home</button>
        <div class="dropdown">
            <button class="dropbtn">About Us</button>
            <div class="dropdown-content">
                <a href="Code of Conduct.php">Code of Conduct</a>
                
                <a href="galary.php">Gallery</a>
                <a href="vision,misson&value.php">Vision, Mission & Values</a>
            </div>
        </div>
        <!--<div class="dropdown">
            <button class="dropbtn">Services</button>
            <div class="dropdown-content">
                <a href="Inter Library Loan - ILL.html">Inter Library Loan - ILL</a>
                <a href="Document Delivery Service DDS.html">Document Delivery Service</a>
            </div>
        </div>-->
        <div class="dropdown">
            <button class="dropbtn">Facility</button>
            <div class="dropdown-content">
                <a href="Media Library.php">Media Library</a>
                <a href="Staff Reading Room.php">Staff Reading Room</a>
                <a href="Bookshop.php">Book Shop</a>
            </div>
        </div>
        <button class="dropbtn" onclick="location.href='contact.php'">Feedback</button>

        <a href="profile.php" class="profile-icon-btn" title="My Profile" style="width: 30px; height: 40px; border-radius: 50%; object-fit: cover; border: 3px solid #ffffffcc; box-shadow: 0 0 10px #ffffff66; display: block; margin: -10px auto;">
  <i class="fas fa-user" style="margin-top: 10px"></i>
</a>

    </div>

    <div class="search-bar">
        <form action="search_books.php" method="GET">
            <input type="text" name="query" placeholder="Search for books by Title, Keywords, Author etc." required>
            <button type="submit">Search</button>
        </form>
    </div>

    <div class="resources">
        <button onclick="location.href='Staff Reading Room.php'">Staff Room</button>
        <button onclick="location.href='ebooks.php'">Books</button>
        <button onclick="location.href='Media Library.php'">Media Library</button>
    </div>

    <!--<div class="container">
    <div class="card"><i class='bx bxs-layer'></i><h2><?php echo $printBooksCount; ?></h2><p>Print Books</p></div>
    <div class="card"><i class='bx bx-book-reader'></i><h2><?php echo $periodicalsCount; ?></h2><p>Print Periodicals</p></div>
    <div class="card"><i class='bx bx-book'></i><h2><?php echo $ebooksCount; ?></h2><p>Ebooks</p></div>
    <div class="card"><i class='bx bx-receipt'></i><h2><?php echo $ejournalsCount; ?></h2><p>e Journals</p></div>
    <div class="card"><i class='bx bx-user-pin'></i><h2><?php echo $conferenceCount; ?></h2><p>eConference Proceedings</p></div>
    <div class="card"><i class='bx bx-book-content'></i><h2><?php echo $thesisCount; ?></h2><p>Thesis</p></div>-->

      <div class="container">
    <!--<a onclick="location.href='view_table.php?table=books'" class="card">📖 Books (<?php echo $printBooksCount; ?>)</a>-->
    <a onclick="location.href='view_table.php?table=ebooks'" class="card">📘 Ebooks (<?php echo $ebooksCount; ?>)</a>
    <a onclick="location.href='view_table.php?table=journals'" class="card">📑 Journals (<?php echo $periodicalsCount; ?>)</a>
    <a onclick="location.href='view_table.php?table=proceedings'" class="card">📄 eConference Proceedings (<?php echo $conferenceCount; ?>)</a>
    <a onclick="location.href='view_table.php?table=thesis'" class="card">🎓 Thesis (<?php echo $thesisCount; ?>)</a>
</div>

</div>

   
    <h2 class="scroll-title">NEW ARRIVALS</h2>

  <div class="scroll-wrapper">
  <div class="scroll-track">
    <img src="23.png" alt="Book 1">
    <img src="24.jpg" alt="Book 2">
    <img src="25.jpg" alt="Book 3">
    <img src="26.png" alt="Book 4">
    <img src="27.jpg" alt="Book 4">
    <img src="28.jpg" alt="Book 4">
    <img src="29.jpg" alt="Book 4">
    <!-- Add more as needed -->
    <img src="23.png" alt="Book 1">
    <img src="24.jpg" alt="Book 2">
    <img src="25.jpg" alt="Book 3">
    <img src="26.png" alt="Book 4">
    <img src="27.jpg" alt="Book 4">
    <img src="28.jpg" alt="Book 4">
    <img src="30.png" alt="Book 4">

    <img src="23.png" alt="Book 1">
    <img src="24.jpg" alt="Book 2">
    <img src="25.jpg" alt="Book 3">
    <img src="26.png" alt="Book 4">
    <img src="27.jpg" alt="Book 4">
    <img src="28.jpg" alt="Book 4">
    <img src="30.png" alt="Book 4">

  </div>
</div>

    <hr class="footer-divider">


    <div class="footer">
        <div><strong>Facilities</strong><br>Book Shop<br>Digital Library<br>Media Library<br></div>
        <div><strong>Contact Details</strong><br>Library and Learning Center<br>Atmiya University<br>Rajkot, Gujarat<br>Phone: +91 02812563445/1212<br>Email: librarian@atmiyauni.ac.in<br>Address: Atmiya University, Kalawad Road, Rajkot-360005 Gujarat, India</div>
        <div><strong>Developed By</strong><br>Kalpesh Ghediya (B.C.A 5th Sem)<br>Rishit Bhateliya (B.C.A 5th Sem)</div>
    </div>
</div>
    <script>
    const dropdowns = document.getElementsByClassName("dropdown-btn");

    for (let i = 0; i < dropdowns.length; i++) {
        dropdowns[i].addEventListener("click", function () {
            this.classList.toggle("active");
            let dropdownContent = this.nextElementSibling;
            if (dropdownContent.style.display === "block") {
                dropdownContent.style.display = "none";
            } else {
                dropdownContent.style.display = "block";
            }
        });
    }
</script>
<!--<script>
function toggleSidebar() {
    const sidebar = document.getElementById("sidebar");
    sidebar.classList.toggle("active");
    document.body.classList.toggle("sidebar-open");
}
</script>
-->
<script>
  let hasPlayed = false;
  let bgMusic;

  function playMusicOnce() {
    if (!hasPlayed) {
      bgMusic = new Audio("bgMusic.MP3"); // Ensure this file exists in the same folder
      bgMusic.loop = true;
      bgMusic.volume = 0.9;
      bgMusic.play().catch(error => {
        console.log("Autoplay failed:", error);
      });
      hasPlayed = true;
    }
  }

  // Trigger on first user interaction
  document.addEventListener("click", playMusicOnce);
</script>
</body>
</html>
