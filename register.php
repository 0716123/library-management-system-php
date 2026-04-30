<?php
session_start();
include 'connect.php';

function showMessage($msg, $type = 'error') {
    $bgColor = $type === 'success' ? 'rgba(0, 128, 0, 0.9)' : 'rgba(255, 0, 0, 0.9)';
    echo "
    <div id='popup-message'>$msg <span id='close-btn'>&times;</span></div>
    <style>
        #popup-message {
            position: fixed;
            bottom: 50%;
            left: 50%;
            transform: translate(-50%, 50%);
            background-color: $bgColor;
            color: #fff;
            padding: 15px 30px;
            font-size: 18px;
            border-radius: 10px;
            z-index: 10000;
        }
        #popup-message #close-btn {
            cursor: pointer;
            font-size: 22px;
            font-weight: bold;
        }
    </style>
    <script>
        document.getElementById('close-btn').onclick = function() {
            document.getElementById('popup-message').remove();
        };
    </script>
    ";
}

// ✅ Register Section
if (isset($_POST['signUp'])) {
    $fName = trim($_POST['fName'] ?? '');
    $lName = trim($_POST['lName'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($fName === '' || $lName === '' || $email === '' || $password === '') {
        showMessage("⚠️ Please fill in all fields!");
        exit;
    }

    // Check if email already exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        showMessage("⚠️ Email already registered!");
        exit;
    }

    // ✅ Handle profile image upload
    $profileImage = '';
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
        $imgName = basename($_FILES['profile_image']['name']);
        $targetDir = "uploads/";
        $targetFile = $targetDir . time() . "_" . $imgName;
        if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $targetFile)) {
            $profileImage = basename($targetFile); // store only the filename
        }
    }

    // Hash password and set default role
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $role = 'user';

    // ✅ INSERT with profile_image
    $stmt = $conn->prepare("INSERT INTO users (firstName, lastName, email, password, role, profile_image) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $fName, $lName, $email, $hashedPassword, $role, $profileImage);

    if ($stmt->execute()) {
        $_SESSION['user'] = $email;
        $_SESSION['user_id'] = $conn->insert_id;
        header("Location: index11.php");
        exit;
    } else {
        showMessage("❌ Registration failed.");
    }
}


// ✅ Login Section
if (isset($_POST['signIn'])) {
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($email === '' || $password === '') {
        showMessage("⚠️ Please fill in both fields!");
        exit;
    }

    // Use correct column name: firstName (not first_name)
    $stmt = $conn->prepare("SELECT id, password, firstName, role FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
    $_SESSION['user'] = $email;
    $_SESSION['name'] = $user['firstName'];
    $_SESSION['role'] = $user['role'];
    $_SESSION['user_id'] = $user['id']; // ✅ Add this line
    header("Location: index11.php");
    exit;
}
 else {
            showMessage("❌ Incorrect password.");
        }
    } else {
        showMessage("❌ Email not found.");
    }
}
?>
