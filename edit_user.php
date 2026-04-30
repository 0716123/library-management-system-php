<?php
$conn = new mysqli("localhost", "root", "", "book_management");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM users WHERE id=$id";
    $result = $conn->query($sql);
    $user = $result->fetch_assoc();
}

if (isset($_POST['update'])) {
    $id = $_GET['id'];

    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("UPDATE users SET firstName=?, lastName=?, email=?, password=? WHERE id=?");
    $stmt->bind_param("ssssi", $firstName, $lastName, $email, $password, $id);
    $stmt->execute();

    header("Location: users.php");
    exit();
}

?>

<h2>Edit User</h2>
<form method="POST">
    First Name: <input type="text" name="firstName" value="<?= $user['firstName']; ?>"><br><br>
    Last Name: <input type="text" name="lastName" value="<?= $user['lastName']; ?>"><br><br>
    Email: <input type="email" name="email" value="<?= $user['email']; ?>"><br><br>
    Password: <input type="text" name="password" value="<?= $user['password']; ?>"><br><br>
    <button type="submit" name="update">Update</button>
</form>
