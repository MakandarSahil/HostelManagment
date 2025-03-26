<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['role'] !== 'admin') {
    header("Location: /hostelManagment/Auth/login.php");
    exit;
}

include('../../includes/db_connect.php');

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $room_no = trim($_POST['room_no']);
    $capacity = intval($_POST['capacity']);
    $status = trim($_POST['status']);
    $hostel_name = trim($_POST['hostel_name']);

    // Step 1: Check if hostel exists
    $stmt = $conn->prepare("SELECT hostel_id FROM Hostels WHERE name = ?");
    $stmt->bind_param("s", $hostel_name);
    $stmt->execute();
    $result = $stmt->get_result();
    $hostel_id = null;

    if ($result->num_rows > 0) {
        $hostel = $result->fetch_assoc();
        $hostel_id = $hostel['hostel_id'];
    } else {
        // Step 2: If not, insert new hostel with 1 room
        $insertHostel = $conn->prepare("INSERT INTO Hostels (name, no_of_rooms, remaining) VALUES (?, 1, 1)");
        $insertHostel->bind_param("s", $hostel_name);
        if ($insertHostel->execute()) {
            $hostel_id = $insertHostel->insert_id;
        } else {
            die("Error creating hostel: " . $conn->error);
        }
        $insertHostel->close();
    }
    $stmt->close();

    // Step 3: Insert the new room
    $insertRoom = $conn->prepare("INSERT INTO HostelRooms (room_no, capacity, status, hostel_id) VALUES (?, ?, ?, ?)");
    $insertRoom->bind_param("sisi", $room_no, $capacity, $status, $hostel_id);

    if ($insertRoom->execute()) {
        // Step 4: Update hostel's room count
        $conn->query("UPDATE Hostels SET no_of_rooms = no_of_rooms + 1, remaining = remaining + 1 WHERE hostel_id = $hostel_id");

        $_SESSION['success'] = "Room added successfully!";
    } else {
        $_SESSION['error'] = "Failed to add room: " . $conn->error;
    }

    $insertRoom->close();
    $conn->close();

    header("Location: view_room.php");
    exit;
}
?>
