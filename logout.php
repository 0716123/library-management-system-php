<?php
session_start();
$_SESSION = array(); // Clear all session variables
session_destroy();
header("Location: index7.php");
exit();
?>
