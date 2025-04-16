<?php
session_start();
include('../../includes/db_connect.php');

if (isset($_GET['id'])) {
    $bookingId = intval($_GET['id']);
    $update = "UPDATE RoomBooking SET status = 'Approved' WHERE booking_id = ?";
    $stmt = $conn->prepare($update);
    $stmt->bind_param("i", $bookingId);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Booking approved successfully.";
    } else {
        $_SESSION['error'] = "Failed to approve booking.";
    }
}
header("Location: view_booking.php");
exit;
?>
