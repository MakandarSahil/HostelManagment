<?php
include('../../includes/db_connect.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = $_POST['student_id'];
    $room_id = $_POST['room_id'];
    $booking_date = $_POST['booking_date'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $status = $_POST['status'];

    $stmt = $conn->prepare("INSERT INTO Bookings (student_id, room_id, booking_date, start_date, end_date, status) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("iissss", $student_id, $room_id, $booking_date, $start_date, $end_date, $status);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Booking added successfully.";
    } else {
        $_SESSION['error'] = "Failed to add booking.";
    }

    header("Location: view_booking.php");
    exit;
}
?>
