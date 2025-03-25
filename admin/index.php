<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['role'] != 'admin') {
    header("Location:/hostelmanagment/Auth/login.php");
    exit;
}
?>

<h2>Welcome Admin: <?= htmlspecialchars($_SESSION['name']); ?></h2>
<a href="../Auth/logout.php">Logout</a>
