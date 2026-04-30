<?php
session_start();
require 'db.php';

if (isset($_POST['signIn'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, password, is_verified, role FROM users WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $dbPassword, $is_verified, $role);
        $stmt->fetch();

        if (password_verify($password, $dbPassword)) {
            if ($is_verified == 1) {
                $_SESSION['user_id'] = $id;
                $_SESSION['role'] = $role;
                echo "✅ Login Successful! Welcome.";
                // redirect based on role
                if ($role == "admin") {
                    header("Location: admin_dashboard.php");
                } else {
                    header("Location: user_dashboard.php");
                }
            } else {
                echo "❌ Please verify your email before login.";
            }
        } else {
            echo "❌ Invalid Password.";
        }
    } else {
        echo "❌ No user found with this email.";
    }
}
?>
