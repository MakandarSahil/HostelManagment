<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['role'] !== 'admin') {
  header("Location: /hostelManagment/Auth/login.php");
  exit;
}

include('../includes/sidebar.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Add Student Log</title>
  <link rel="stylesheet" href="/hostelManagment/assets/css/styleAdmin.css">
  <style>
    .main-content {
      margin-left: 250px;
      padding: 20px;
    }

    form {
      background: #f9f9f9;
      padding: 20px;
      border-radius: 8px;
      max-width: 500px;
    }

    label {
      display: block;
      margin-top: 15px;
      font-weight: bold;
    }

    input, select, textarea {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      border-radius: 4px;
      border: 1px solid #ccc;
    }

    button {
      margin-top: 20px;
      background-color: #3949ab;
      color: #fff;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
    }
  </style>
</head>
<body>
  <main class="main-content">
    <h2>Add Student Log</h2>
    <form action="process_add_log.php" method="POST">
      <label for="student_id">Student ID</label>
      <input type="number" name="student_id" required>

      <label for="room_id">Room No</label>
      <input type="number" name="room_id" required>

      <label for="out_time">Out Time</label>
      <input type="datetime-local" name="out_time" required>

      <label for="in_time">In Time</label>
      <input type="datetime-local" name="in_time" required>

      <label for="purpose">Purpose</label>
      <textarea name="purpose" required></textarea>

      <label for="status">Status</label>
      <select name="status" required>
        <option value="Pending">Pending</option>
        <option value="Returned">Returned</option>
        <option value="Approved">Approved</option>
      </select>

      <button type="submit">Add Log</button>
    </form>
  </main>
</body>
</html>
