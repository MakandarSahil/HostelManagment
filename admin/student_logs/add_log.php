<?php
session_start();
include('../../includes/db_connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = $_POST['student_id'];
    $room_id = $_POST['room_id'];
    $out_time = $_POST['out_time'];
    $in_time = !empty($_POST['in_time']) ? $_POST['in_time'] : NULL;
    $purpose = $_POST['purpose'];
    $status = $_POST['status'];

    $stmt = $conn->prepare("INSERT INTO StudentLog (student_id, room_id, out_time, in_time, purpose, status) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("iissss", $student_id, $room_id, $out_time, $in_time, $purpose, $status);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Student log added successfully.";
    } else {
        $_SESSION['error'] = "Error adding log: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
    header("Location: logs.php");
    exit;
}
?>
