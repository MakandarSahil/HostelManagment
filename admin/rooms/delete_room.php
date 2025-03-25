<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['role'] !== 'admin') {
    header("Location: /hostelManagment/Auth/login.php");
    exit;
}
$room_id = $_GET['id'];
// Perform deletion from database here, then redirect back:
header("Location: view_rooms.php");
exit;
?>
