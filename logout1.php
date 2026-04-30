<?php
session_start();
session_unset();
session_destroy();
header("Location: index7.php");
exit();
?>
