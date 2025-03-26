<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['role'] !== 'admin') {
    header("Location: /hostelManagment/Auth/login.php");
    exit;
}

include('../../includes/db_connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $room_id = intval($_POST['room_id']);
    $room_no = trim($_POST['room_no']);
    $capacity = intval($_POST['capacity']);
    $status = trim($_POST['status']);

    $stmt = $conn->prepare("UPDATE HostelRooms SET room_no = ?, capacity = ?, status = ? WHERE room_id = ?");
    $stmt->bind_param("sisi", $room_no, $capacity, $status, $room_id);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Room updated successfully!";
    } else {
        $_SESSION['error'] = "Failed to update room: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
    header("Location: view_room.php");
    exit;
} else {
    $_SESSION['error'] = "Invalid request.";
    header("Location: view_room.php");
    exit;
}
