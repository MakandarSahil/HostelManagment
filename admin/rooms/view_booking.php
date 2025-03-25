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
      cursor: pointer;
    }

    table tr:nth-child(even) {
      background-color: #f4f4f4;
    }

    table a {
      color: #3949ab;
      text-decoration: none;
      font-weight: 500;
    }

    table a:hover {
      text-decoration: underline;
    }

    .search-box {
      margin-bottom: 10px;
      padding: 8px;
      width: 100%;
      max-width: 300px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
  </style>
</head>

<body>
  <div class="dashboard-container">
    <?php include('../includes/sidebar.php'); ?>

    <main class="main-content">
      <h2>Room Bookings</h2>
      <input type="text" id="searchInput" class="search-box" placeholder="Search bookings..." onkeyup="searchTable()">
      <div class="table-container">
        <table id="bookingTable">
          <thead>
            <tr>
              <th class="sortable">Booking ID</th>
              <th class="sortable">Student Name</th>
              <th class="sortable">Room Number</th>
              <th class="sortable">Booking Date</th>
              <th class="sortable">Start Date</th>
              <th class="sortable">End Date</th>
              <th class="sortable">Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>BK101</td>
              <td>Rahul Kumar</td>
              <td>101</td>
              <td>2025-03-25</td>
              <td>2025-03-27</td>
              <td>2025-06-30</td>
              <td>Pending</td>
              <td><a href="#">Approve</a> | <a href="#">Cancel</a></td>
            </tr>
            <tr>
              <td>BK102</td>
              <td>Sneha Patil</td>
              <td>105</td>
              <td>2025-03-20</td>
              <td>2025-04-01</td>
              <td>2025-07-01</td>
              <td>Approved</td>
              <td><a href="#">View</a> | <a href="#">Cancel</a></td>
            </tr>
          </tbody>
        </table>
      </div>
    </main>
  </div>
  <script src="/hostelManagment/assets/js/sidebar.js"></script>
</body>

</html>