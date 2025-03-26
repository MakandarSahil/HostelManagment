<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['role'] !== 'admin') {
    header("Location: /hostelManagment/Auth/login.php");
    exit;
}

include('../../includes/db_connect.php');

if (!isset($_GET['id'])) {
    die("Room ID not provided.");
}

$room_id = $_GET['id'];

// Get hostel_id before deletion to update count
$getHostel = $conn->prepare("SELECT hostel_id FROM HostelRooms WHERE room_id = ?");
$getHostel->bind_param("i", $room_id);
$getHostel->execute();
$getResult = $getHostel->get_result();

if ($getResult->num_rows === 0) {
    $_SESSION['error'] = "Room not found.";
    header("Location: view_room.php");
    exit;
}

$hostel_id = $getResult->fetch_assoc()['hostel_id'];
$getHostel->close();

// Delete the room
$stmt = $conn->prepare("DELETE FROM HostelRooms WHERE room_id = ?");
$stmt->bind_param("i", $room_id);
if ($stmt->execute()) {
    // Update hostel room count
    $conn->query("UPDATE Hostels SET no_of_rooms = no_of_rooms - 1, remaining = remaining - 1 WHERE hostel_id = $hostel_id");
    $_SESSION['success'] = "Room deleted successfully!";
} else {
    $_SESSION['error'] = "Failed to delete room.";
}
$stmt->close();
$conn->close();

header("Location: view_room.php");
exit;
