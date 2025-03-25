<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['role'] !== 'admin') {
    header("Location: /hostelManagment/Auth/login.php");
    exit;
}
include('../includes/header.php');
include('../includes/sidebar.php');
$room_id = $_GET['id'];
?>

<div class="main-content">
    <h2>Edit Room <?= htmlspecialchars($room_id); ?></h2>
    <form method="POST" action="">
        <label>Room Number:</label>
        <input type="text" name="room_no" value="<?= htmlspecialchars($room_id); ?>" required>

        <label>Capacity:</label>
        <input type="number" name="capacity" required>

        <button type="submit">Save Changes</button>
    </form>
</div>

<?php include('../includes/footer.php'); ?>
