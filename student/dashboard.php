<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['role'] != 'student') {
    header("Location: /hostelmanagment/Auth/login.php");
    exit;
}

?>

<h2>Welcome Student: <?= htmlspecialchars($_SESSION['name']); ?></h2>
<a href="../Auth/logout.php">Logout</a>
