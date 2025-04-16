<?php
session_start();
include('../../includes/db_connect.php');

if (isset($_GET['id'])) {
    $bookingId = intval($_GET['id']);
    $delete = "DELETE FROM RoomBooking WHERE booking_id = ?";
    $stmt = $conn->prepare($delete);
    $stmt->bind_param("i", $bookingId);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Booking deleted successfully.";
    } else {
        $_SESSION['error'] = "Failed to delete booking.";
    }
}
header("Location: view_booking.php");
exit;
?>
