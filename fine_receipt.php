<?php
$name = $_GET['name'] ?? 'Student';
$book = $_GET['book'] ?? 'Book';
$issued = $_GET['issued'] ?? 'N/A';
$due = $_GET['due'] ?? 'N/A';
$fine = $_GET['fine'] ?? 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Fine Receipt</title>
  <script src="https://cdn.jsdelivr.net/npm/html2canvas@1.4.1/dist/html2canvas.min.js"></script>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: #e9ecef;
      padding: 30px;
    }

    .receipt {
      max-width: 520px;
      margin: auto;
      background: white;
      padding: 35px;
      border-radius: 15px;
      box-shadow: 0 0 25px rgba(0,0,0,0.2);
      color: #2c3e50;
    }

    h2 {
      text-align: center;
      margin-bottom: 25px;
    }

    .line {
      display: flex;
      justify-content: space-between;
      margin: 14px 0;
    }

    .label {
      font-weight: bold;
      color: #555;
    }

    .value {
      color: #222;
    }

    .thank-you {
      text-align: center;
      margin-top: 30px;
      font-style: italic;
      color: #777;
    }

    .btns {
      margin-top: 35px;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .btns button {
      padding: 12px 28px;
      background-color: #2ecc71;
      color: white;
      border: none;
      font-size: 15px;
      border-radius: 8px;
      cursor: pointer;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      transition: transform 0.3s ease, background-color 0.3s;
    }

    .btns button:hover {
      background-color: #27ae60;
      transform: translateX(8px);
    }

    @media (max-width: 600px) {
      .receipt {
        padding: 20px;
      }

      .btns button {
        width: 100%;
      }
    }

    @media print {
      .btns {
        display: none;
      }
    }
  </style>
</head>
<body>

<div id="capture" class="receipt">
  <h2>📄 Fine Payment Receipt</h2>

  <div class="line"><span class="label">Name:</span><span class="value"><?= htmlspecialchars($name) ?></span></div>
  <div class="line"><span class="label">Book Title:</span><span class="value"><?= htmlspecialchars($book) ?></span></div>
  <div class="line"><span class="label">Issue Date:</span><span class="value"><?= htmlspecialchars($issued) ?></span></div>
  <div class="line"><span class="label">Due Date:</span><span class="value"><?= htmlspecialchars($due) ?></span></div>
  <div class="line"><span class="label">Fine Amount:</span><span class="value">₹<?= htmlspecialchars($fine) ?></span></div>

  <div class="thank-you">Thank you for your timely action.</div>
</div>

<div class="btns">
  <button onclick="saveAsImage()">🧾 Download Fine Receipt</button>
</div>

<script>
function saveAsImage() {
  html2canvas(document.getElementById("capture")).then(function(canvas) {
    const link = document.createElement("a");
    link.download = "fine_receipt.png";
    link.href = canvas.toDataURL("image/png");
    link.click();
  });
}
</script>

</body>
</html>
