<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['role'] !== 'admin') {
    header("Location: /hostelManagment/Auth/login.php");
    exit;
}
include('../includes/header.php');
include('../includes/sidebar.php');
?>

<div class="main-content">
    <h2>Add New Room</h2>
    <form method="POST" action="">
        <label>Room Number:</label>
        <input type="text" name="room_no" required>

        <label>Capacity:</label>
        <input type="number" name="capacity" required>

        <button type="submit">Add Room</button>
    </form>
</div>

<?php include('../includes/footer.php'); ?>
