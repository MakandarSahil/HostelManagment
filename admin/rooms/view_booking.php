<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['role'] !== 'admin') {
  header("Location: /hostelManagment/Auth/login.php");
  exit;
}
include('../../includes/db_connect.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>View Bookings - Hostel Management</title>
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

    .table-container {
      overflow-x: auto;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
      min-width: 800px;
    }

    table th,
    table td {
      padding: 12px;
      border: 1px solid #ccc;
      text-align: left;
    }

    table th {
      background-color: #3949ab;
      color: white;
    }

    table tr:nth-child(even) {
      background-color: #f4f4f4;
    }

    .search-box,
    .btn-add {
      margin-bottom: 10px;
      padding: 10px 15px;
      border-radius: 5px;
      border: 1px solid #ccc;
    }

    .btn-add {
      background-color: #3949ab;
      color: white;
      cursor: pointer;
      border: none;
    }

    .btn-action {
      padding: 6px 10px;
      border: none;
      border-radius: 4px;
      color: white;
      cursor: pointer;
      margin-right: 5px;
    }

    .view-btn {
      background-color: #5bc0de;
    }

    .edit-btn {
      background-color: #f0ad4e;
    }

    .delete-btn {
      background-color: #d9534f;
    }

    .approve-btn {
      background-color: #5cb85c;
    }

    .modal {
      display: none;
      position: fixed;
      z-index: 2000;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgba(0, 0, 0, 0.5);
    }

    .modal-content {
      background-color: #fff;
      margin: 8% auto;
      padding: 20px;
      border-radius: 8px;
      width: 400px;
      box-shadow: 0 5px 10px rgba(0, 0, 0, 0.3);
    }

    .modal-content input,
    .modal-content select {
      width: 100%;
      margin-top: 8px;
      margin-bottom: 15px;
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    .modal-content .close {
      float: right;
      font-size: 24px;
      cursor: pointer;
    }
  </style>
</head>

<body>
  <div class="dashboard-container">
    <?php include('../includes/sidebar.php'); ?>
    <main class="main-content">
      <h2>Room Bookings</h2>
      <button onclick="openBookingModal()" class="btn-add">+ Add Booking</button>
      <input type="text" id="searchInput" class="search-box" placeholder="Search bookings..." onkeyup="searchTable()">

      <select id="statusFilter" onchange="filterByStatus()" class="search-box" style="max-width: 200px;">
        <option value="">All</option>
        <option value="Approved">Approved</option>
        <option value="Pending">Pending</option>
      </select>

      <div class="table-container">
        <table id="bookingTable">
          <thead>
            <tr>
              <th>Booking ID</th>
              <th>Student Name</th>
              <th>Room Number</th>
              <th>Booking Date</th>
              <th>Start Date</th>
              <th>End Date</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $sql = "SELECT rb.booking_id, CONCAT(u.fname, ' ', u.lname) AS student_name,
                       hr.room_no, rb.booking_date, rb.start_date, rb.end_date, rb.status
                FROM RoomBooking rb
                JOIN Student s ON rb.student_id = s.student_id
                JOIN Users u ON s.userId = u.user_id
                JOIN HostelRooms hr ON rb.room_id = hr.room_id";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>BK" . $row['booking_id'] . "</td>
                    <td>" . htmlspecialchars($row['student_name']) . "</td>
                    <td>" . htmlspecialchars($row['room_no']) . "</td>
                    <td>" . htmlspecialchars($row['booking_date']) . "</td>
                    <td>" . htmlspecialchars($row['start_date']) . "</td>
                    <td>" . htmlspecialchars($row['end_date']) . "</td>
                    <td>" . htmlspecialchars($row['status']) . "</td>
                    <td>";
                echo "<button class='btn-action view-btn' onclick=\"viewBooking('" . htmlspecialchars($row['student_name']) . "','" . $row['room_no'] . "','" . $row['booking_date'] . "','" . $row['start_date'] . "','" . $row['end_date'] . "')\">View</button>";
                echo "<button class='btn-action edit-btn' onclick=\"editBooking('" . $row['booking_id'] . "','" . $row['booking_date'] . "','" . $row['start_date'] . "','" . $row['end_date'] . "')\">Edit</button>";
                echo "<a href='delete_booking.php?id=" . $row['booking_id'] . "' onclick=\"return confirm('Delete this booking?')\" class='btn-action delete-btn'>Delete</a>";
                if ($row['status'] === "Pending") {
                  echo "<a href='approve_booking.php?id=" . $row['booking_id'] . "' class='btn-action approve-btn'>Approve</a>";
                }
                echo "</td></tr>";
              }
            } else {
              echo "<tr><td colspan='8'>No bookings found.</td></tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
    </main>
  </div>

  <!-- Modals -->
  <div id="bookingModal" class="modal">
    <div class="modal-content">
      <span class="close" onclick="closeModal('bookingModal')">&times;</span>
      <h3>Add New Booking</h3>
      <form action="add_booking.php" method="POST">
        <label>Student ID</label>
        <input type="number" name="student_id" required>
        <label>Room ID</label>
        <input type="number" name="room_id" required>
        <label>Booking Date</label>
        <input type="date" name="booking_date" value="<?= date('Y-m-d'); ?>" required>
        <label>Start Date</label>
        <input type="date" name="start_date" required>
        <label>End Date</label>
        <input type="date" name="end_date" required>
        <select name="status" required>
          <option value="Pending">Pending</option>
          <option value="Approved">Approved</option>
        </select>
        <button type="submit">Add Booking</button>
      </form>
    </div>
  </div>

  <div id="viewModal" class="modal">
    <div class="modal-content">
      <span class="close" onclick="closeModal('viewModal')">&times;</span>
      <h3>Booking Details</h3>
      <p><strong>Student:</strong> <span id="viewStudent"></span></p>
      <p><strong>Room:</strong> <span id="viewRoom"></span></p>
      <p><strong>Booking Date:</strong> <span id="viewBooking"></span></p>
      <p><strong>Start:</strong> <span id="viewStart"></span></p>
      <p><strong>End:</strong> <span id="viewEnd"></span></p>
    </div>
  </div>

  <div id="editModal" class="modal">
    <div class="modal-content">
      <span class="close" onclick="closeModal('editModal')">&times;</span>
      <h3>Edit Booking</h3>
      <form action="edit_booking.php" method="POST">
        <input type="hidden" name="booking_id" id="editBookingId">
        <label>Booking Date</label>
        <input type="date" name="booking_date" id="editBookingDate" required>
        <label>Start Date</label>
        <input type="date" name="start_date" id="editStartDate" required>
        <label>End Date</label>
        <input type="date" name="end_date" id="editEndDate" required>
        <button type="submit">Save</button>
      </form>
    </div>
  </div>

  <script>
    function openBookingModal() {
      document.getElementById('bookingModal').style.display = 'block';
    }

    function viewBooking(student, room, booking, start, end) {
      document.getElementById('viewStudent').innerText = student;
      document.getElementById('viewRoom').innerText = room;
      document.getElementById('viewBooking').innerText = booking;
      document.getElementById('viewStart').innerText = start;
      document.getElementById('viewEnd').innerText = end;
      document.getElementById('viewModal').style.display = 'block';
    }

    function editBooking(id, booking, start, end) {
      document.getElementById('editBookingId').value = id;
      document.getElementById('editBookingDate').value = booking;
      document.getElementById('editStartDate').value = start;
      document.getElementById('editEndDate').value = end;
      document.getElementById('editModal').style.display = 'block';
    }

    function closeModal(id) {
      document.getElementById(id).style.display = 'none';
    }

    window.onclick = function(event) {
      ['bookingModal', 'viewModal', 'editModal'].forEach(id => {
        if (event.target === document.getElementById(id)) {
          closeModal(id);
        }
      });
    }

    function searchTable() {
      const input = document.getElementById("searchInput").value.toLowerCase();
      const rows = document.querySelectorAll("#bookingTable tbody tr");
      rows.forEach(row => {
        const match = [...row.getElementsByTagName("td")].some(td => td.innerText.toLowerCase().includes(input));
        row.style.display = match ? "" : "none";
      });
    }

    function filterByStatus() {
      const status = document.getElementById("statusFilter").value.toLowerCase();
      const rows = document.querySelectorAll("#bookingTable tbody tr");
      rows.forEach(row => {
        const cell = row.cells[6];
        row.style.display = (!status || cell.innerText.toLowerCase().includes(status)) ? "" : "none";
      });
    }
  </script>
  <script src="/hostelManagment/assets/js/sidebar.js"></script>
</body>

</html>