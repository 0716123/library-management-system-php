<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Register & Login</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
  <link rel="stylesheet" href="style12.css?v=<?php echo time(); ?>">
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
      background: url('wp2508260.webp') no-repeat center center fixed;
      background-size: cover;
      color: #fff;
    }

    #introPage {
      background-color: rgba(0, 0, 0, 0.6);
      height: 100vh;
      width: 100vw;
      position: fixed;
      top: 0;
      left: 0;
      z-index: 9999;
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
      animation: fadeOut 1s ease-in-out 20s forwards;
      overflow: hidden;
    }

    @keyframes fadeOut {
      to {
        opacity: 0;
        visibility: hidden;
      }
    }

    #hobbyText {
      white-space: pre-line;
      font-size: 1.1rem;
      font-weight: 500;
      text-shadow: 1px 1px 2px #000;
    }

    input[type="file"] {
      color: #fff;
      background-color: rgba(255, 255, 255, 0.1);
      padding: 10px;
      border: 1px solid #fff;
      border-radius: 5px;
      font-size: 0.9rem;
      cursor: pointer;
      width: 100%;
    }

    input[type="file"]::file-selector-button {
      background-color: #3498db;
      color: white;
      border: none;
      padding: 8px 14px;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s ease;
      font-weight: 600;
    }

    input[type="file"]::file-selector-button:hover {
      background-color: #2c80b4;
    }

    .input-group label[for="profile_image"] {
      top: -15px;
      font-size: 0.9rem;
      color: #ccc;
    }

    #skipIntroBtn {
      position: absolute;
      top: 20px;
      right: 30px;
      padding: 8px 16px;
      background-color: rgba(0, 0, 0, 0.6);
      color: white;
      border: 1px solid #fff;
      border-radius: 6px;
      cursor: pointer;
      font-weight: bold;
      z-index: 10000;
    }

    #skipIntroBtn:hover {
      background-color: rgba(255, 255, 255, 0.8);
      color: #000;
      transition: 0.3s ease;
    }
  </style>
</head>
<body>

<!-- INTRO PAGE -->
<div id="introPage">
  <button id="skipIntroBtn">Skip Intro</button>
  <div style="display: flex; align-items: center; animation: slideLeft 5s linear forwards;">
    <img src="intro.png" alt="Welcome" style="
      width: 200px; height: 200px;
      border-radius: 50%;
      object-fit: cover;
      box-shadow: 0 0 25px rgba(255, 255, 255, 0.4); 
      border: 3px solid #fff;
      margin-right: 40px;
    ">
    <div>
      <h2 id="introText"></h2>
      <p id="developerText" style="margin-top: 10px;"></p>
      <p id="hobbyText" style="margin-top: 10px;"></p>
      <p id="thanksText" style="margin-top: 10px; font-style: italic;"></p>
    </div>
  </div>
</div>

<!-- SECOND INTRO PAGE (Rishit Bhateliya) -->
<div id="introPage2" style="
  background-color: rgba(0, 0, 0, 0.6);
  height: 100vh;
  width: 100vw;
  position: fixed;
  top: 0;
  left: 0;
  z-index: 9999;
  display: none;
  justify-content: center;
  align-items: center;
  flex-direction: column;
  overflow: hidden;
">
  <button id="skipIntroBtn2" style="
    position: absolute;
    top: 20px;
    right: 30px;
    padding: 8px 16px;
    background-color: rgba(0, 0, 0, 0.6);
    color: white;
    border: 1px solid #fff;
    border-radius: 6px;
    cursor: pointer;
    font-weight: bold;
    z-index: 10000;">
    Skip Intro
  </button>
  <div style="display: flex; align-items: center; animation: slideLeft 5s linear forwards;">
    <img src="r.jpg" alt="Welcome" style="
      width: 200px; height: 200px;
      border-radius: 50%;
      object-fit: cover;
      box-shadow: 0 0 25px rgba(255, 255, 255, 0.4);
      border: 3px solid #fff;
      margin-right: 40px;">
    <div>
      <h2 id="introText2"></h2>
      <p id="developerText2" style="margin-top: 10px;"></p>
      <p id="hobbyText2" style="margin-top: 10px;"></p>
      <p id="thanksText2" style="margin-top: 10px; font-style: italic;"></p>
    </div>
  </div>
</div>

<!-- MAIN CONTENT HIDDEN INITIALLY -->
<div id="mainContent" style="display: none;">
  <div class="container" id="signup" style="display: block;">
    <h1 class="form-title">Sign Up</h1>
    <form method="post" action="register.php" enctype="multipart/form-data">
      <div class="input-group">
        <input type="text" name="fName" id="fName" placeholder="First Name" required>
        <label for="fName">First Name</label>
      </div>
      <div class="input-group">
        <input type="text" name="lName" id="lName" placeholder="Last Name" required>
        <label for="lName">Last Name</label>
      </div>
      <div class="input-group">
        <input type="email" name="email" id="email" placeholder="Email" required>
        <label for="email">Email</label>
      </div>
      <div class="input-group">
        <input type="password" name="password" id="password" placeholder="Password" required>
        <label for="password">Password</label>
      </div>
      <div class="input-group">
        <input type="file" name="profile_image" id="profile_image" accept="image/*" required>
        <label for="profile_image">Upload Profile Image</label>
      </div>
      <input type="submit" class="btn" value="Sign Up" name="signUp">
    </form>

    <p class="or">------------OR------------</p>
    <div class="icons">
      <i class="fab fa-google"></i>
      <i class="fab fa-facebook"></i>
    </div>
    <div class="links">
      <p>Already Have Account ?</p>
      <button id="signInButton" class="signin-button">Sign In</button>
    </div>
  </div>

  <div class="container" id="signIn" style="display: none;">
    <h1 class="form-title">Sign In</h1>
    <form method="post" action="register.php">
      <div class="input-group">
        <i class="fas fa-envelope"></i>
        <input type="email" name="email" id="email" placeholder="Email" required>
        <label for="email">Email</label>
      </div>
      <div class="input-group">
        <i class="fas fa-lock"></i>
        <input type="password" name="password" id="password" placeholder="password" required>
        <label for="password">password</label>
      </div>
      <p class="recover"><a href="#">Recover Password</a></p>
      <input type="submit" class="btn" value="Sign In" name="signIn">
    </form>

    <p class="or">------------OR------------</p>
    <div class="icons">
      <i class="fab fa-google"></i>
      <i class="fab fa-facebook"></i>
    </div>
    <div class="links">
      <p style="font-size: 0.8rem;">Don't Have Account yet ?</p>
      <button id="signUpButton" class="signin-button">Sign Up</button>
    </div>
    <div style="text-align: center; margin-top: 20px;">
      <form action="admin_login.php" method="get">
        <button type="submit" class="btn">Admin Login</button>
      </form>
    </div>
  </div>
</div>

<!-- SCRIPT AREA -->
<script>
  let hasPlayed = false;
  let bgMusic;

  function playMusicOnce() {
    if (!hasPlayed) {
      bgMusic = new Audio("bgMusic.mp3");
      bgMusic.loop = true;
      bgMusic.volume = 0.2;
      bgMusic.play().catch(err => console.log("Autoplay error:", err));
      hasPlayed = true;
    }
  }

  document.addEventListener("click", playMusicOnce);

  // Sequence: first intro (20s) -> second intro (20s) -> show main register content
  setTimeout(() => {
    const intro1 = document.getElementById("introPage");
    const intro2 = document.getElementById("introPage2");
    if (intro1) intro1.style.display = "none";
    if (intro2) {
      intro2.style.display = "flex";
      // start typewriter for second intro
      if (typeof typeText === 'function') {
        typeText("introText2", introText2, 70, () => {
          typeText("developerText2", developerText2, 50, () => {
            typeText("hobbyText2", hobbyText2, 45, () => {
              typeText("thanksText2", thanksText2, 50);
            });
          });
        });
      }
    }
  }, 20000);

  setTimeout(() => {
    // hide second intro and reveal main register content
    const intro2 = document.getElementById("introPage2");
    const main = document.getElementById("mainContent");
    if (intro2) intro2.style.display = "none";
    if (main) main.style.display = "block";
    // stop music
    if (bgMusic && !bgMusic.paused) {
      bgMusic.pause();
      bgMusic.currentTime = 0;
    }
  }, 40000);

  document.getElementById("skipIntroBtn").addEventListener("click", function () {
    const intro1 = document.getElementById("introPage");
    const intro2 = document.getElementById("introPage2");
    const main = document.getElementById("mainContent");
    if (intro1) intro1.style.display = "none";
    if (intro2) intro2.style.display = "none";
    if (main) main.style.display = "block";
    if (bgMusic && !bgMusic.paused) {
      bgMusic.pause();
      bgMusic.currentTime = 0;
    }
  });

  const skip2 = document.getElementById("skipIntroBtn2");
  if (skip2) {
    skip2.addEventListener("click", function () {
      const intro1 = document.getElementById("introPage");
      const intro2 = document.getElementById("introPage2");
      const main = document.getElementById("mainContent");
      if (intro1) intro1.style.display = "none";
      if (intro2) intro2.style.display = "none";
      if (main) main.style.display = "block";
      if (bgMusic && !bgMusic.paused) {
        bgMusic.pause();
        bgMusic.currentTime = 0;
      }
    });
  }
</script>

<script>
  const introText = "Welcome to the Tattva Gyan Learning Center";
  const developerText = "Devloped by Kalpesh Ghediya – Passionate Coder & Learner";
  const hobbyText = `Hobbies:\n• Playing Piano 🎹\n• Coding 👨‍💻\n• Listening to Music 🎧\n• Reading Books 📚`;
  const thanksText = "✨ Special Thanks to My Mentor ✨\nFor the inspiration, guidance, and endless motivation!";

  // Second intro content (Rishit Bhateliya)
  const introText2 = "Welcome to the Tattva Gyan Learning Center";
  const developerText2 = "Developed by Rishit Bhateliya – Curious Mind & Consistent Learner";
  const hobbyText2 = `Hobbies:\n• Exploring Technology 🔧\n• Coding 👨‍💻\n• Music & Podcasts 🎧\n• Reading & Research 📚`;
  const thanksText2 = "✨ Special Thanks to My Mentor ✨\nFor constant guidance, encouragement, and support!";

  function typeText(elementId, text, delay = 50, callback = null) {
    const element = document.getElementById(elementId);
    let i = 0;
    function type() {
      if (i < text.length) {
        element.innerHTML += text.charAt(i);
        i++;
        setTimeout(type, delay);
      } else if (callback) {
        callback();
      }
    }
    type();
  }

  window.addEventListener("DOMContentLoaded", () => {
    typeText("introText", introText, 70, () => {
      typeText("developerText", developerText, 50, () => {
        typeText("hobbyText", hobbyText, 45, () => {
          typeText("thanksText", thanksText, 50);
        });
      });
    });
  });
</script>

<script src="script.js"></script>
</body>
</html>
