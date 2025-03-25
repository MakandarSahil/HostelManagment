<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['role'] !== 'admin') {
  header("Location: /hostelManagment/Auth/login.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Student Logs - Hostel Management</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/hostelManagment/assets/css/styleAdmin.css">
  <link rel="stylesheet" href="/hostelManagment/assets/css/sidebar.css">

  <style>
    .dashboard-container {
      display: flex;
    }

    .main-content {
      flex-grow: 1;
      padding: 20px;
    }

    /* Table responsiveness */
    .table-container {
      width: 100%;
      overflow-x: auto;
      margin-top: 20px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      min-width: 700px;
      /* Ensures scrolling if screen width is smaller */
    }

    th,
    td {
      padding: 12px;
      border: 1px solid #ccc;
      text-align: left;
      white-space: nowrap;
      /* Prevents text from wrapping */
    }

    th {
      background-color: #3949ab;
      color: white;
    }

    tr:nth-child(even) {
      background-color: #f9f9f9;
    }

    .action-btns a {
      margin-right: 8px;
      text-decoration: none;
      font-weight: bold;
    }

    .approve {
      color: green;
    }

    .return {
      color: orange;
    }

    .pending {
      color: red;
    }

    .btn-add {
      background-color: #3949ab;
      color: white;
      padding: 8px 15px;
      text-decoration: none;
      border-radius: 5px;
      margin-bottom: 15px;
      display: inline-block;
    }

    #searchInput {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

    /* Responsive table styling */
    @media (max-width: 768px) {

      th,
      td {
        font-size: 14px;
        padding: 8px;
      }

      .main-content {
        margin-left: 0;
        /* Remove left margin for smaller screens */
      }
    }
  </style>
</head>

<body>
  <div class="dashboard-container">
    <?php include('../includes/sidebar.php'); ?>

    <main class="main-content">
      <h2>Student Logs</h2>
      <a href="add_room.php" class="btn-add">+ Add Logs</a>

      <!-- Search Box -->
      <input type="text" id="searchInput" placeholder="Search..." onkeyup="searchTable()">
      <div class="table-container">
        <table>
          <thead>
            <tr>
              <th>Student Name</th>
              <th>Room No</th>
              <th>Out Time</th>
              <th>In Time</th>
              <th>Purpose</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <!-- Replace with PHP foreach after DB integration -->
            <tr>
              <td>Rahul Kumar</td>
              <td>101</td>
              <td>2025-03-25 09:00 AM</td>
              <td>2025-03-25 05:00 PM</td>
              <td>College Visit</td>
              <td class="pending">Pending</td>
              <td class="action-btns">
                <a href="update_log.php?action=approve&id=1" class="approve">Approve</a>
                <a href="update_log.php?action=returned&id=1" class="return">Mark Returned</a>
              </td>
            </tr>
            <tr>
              <td>Sneha Patil</td>
              <td>105</td>
              <td>2025-03-26 10:00 AM</td>
              <td>2025-03-26 04:00 PM</td>
              <td>Medical Checkup</td>
              <td style="color: green;">Approved</td>
              <td class="action-btns">
                <a href="update_log.php?action=returned&id=2" class="return">Mark Returned</a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </main>
  </div>
  <script src="/hostelManagment/assets/js/sidebar.js"></script> 
</body>

</html>