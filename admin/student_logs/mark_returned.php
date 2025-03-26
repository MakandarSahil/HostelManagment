<?php
session_start();
include('../../includes/db_connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['log_id'])) {
    $log_id = $_POST['log_id'];
    $in_time = date("Y-m-d H:i:s");

    $stmt = $conn->prepare("UPDATE StudentLog SET status = 'Returned', in_time = ? WHERE log_id = ?");
    $stmt->bind_param("si", $in_time, $log_id);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Marked as Returned successfully.";
    } else {
        $_SESSION['error'] = "Failed to update status.";
    }

    $stmt->close();
    $conn->close();
    header("Location: logs.php");
    exit;
}
?>
