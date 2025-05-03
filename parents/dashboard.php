<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['role'] != 'parent') {
  header("Location: /hostelmanagment/Auth/login.php");
  exit;
}

// Sample data - in a real app this would come from a database
$child = [
  'id' => 'STU1001',
  'name' => 'Rahul Sharma',
  'room' => 'B-204',
  'course' => 'Computer Science',
  'year' => '3rd Year',
  'contact' => 'rahul@example.com',
  'warden_name' => 'Dr. Smitha Patel',
  'warden_contact' => 'warden@hostel.edu'
];

$complaints = [
  [
    'id' => 1001,
    'type' => 'Electrical',
    'description' => 'Lights not working in bathroom',
    'status' => 'Pending',
    'date' => '2023-10-10'
  ],
  [
    'id' => 1002,
    'type' => 'Plumbing',
    'description' => 'Water leakage in washbasin',
    'status' => 'In Progress',
    'date' => '2023-10-05'
  ]
];

$permissions = [
  [
    'id' => 2001,
    'reason' => 'Family Function',
    'from' => '2023-10-15 18:00',
    'to' => '2023-10-16 22:00',
    'status' => 'Pending Parent Approval',
    'date' => '2023-10-10'
  ],
  [
    'id' => 2002,
    'reason' => 'Medical Checkup',
    'from' => '2023-10-12 10:00',
    'to' => '2023-10-12 14:00',
    'status' => 'Parent Approved',
    'date' => '2023-10-08'
  ]
];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Parent Portal - Hostel Management</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <style>
    :root {
      --primary: #4361ee;
      --primary-light: #e0e7ff;
      --secondary: #3f37c9;
      --light: #f8f9fa;
      --dark: #212529;
      --gray: #6c757d;
      --gray-light: #f1f3f5;
      --success: #28a745;
      --warning: #ffc107;
      --danger: #dc3545;
      --border-radius: 8px;
      --sidebar-width: 280px;
    }

    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f5f7fa;
      margin: 0;
      padding: 0;
      display: flex;
      min-height: 100vh;
    }

    .sidebar {
      width: var(--sidebar-width);
      background: white;
      box-shadow: 2px 0 10px rgba(0, 0, 0, 0.05);
      padding: 20px 0;
      position: fixed;
      height: 100vh;
    }

    .sidebar-header {
      padding: 0 20px 20px;
      border-bottom: 1px solid var(--gray-light);
      text-align: center;
    }

    .sidebar-header img {
      width: 80px;
      height: 80px;
      border-radius: 50%;
      object-fit: cover;
      border: 3px solid var(--primary-light);
      margin-bottom: 10px;
    }

    .sidebar-menu {
      list-style: none;
      padding: 20px 0;
    }

    .sidebar-menu li a {
      display: flex;
      align-items: center;
      padding: 12px 20px;
      color: var(--dark);
      text-decoration: none;
      transition: all 0.3s;
    }

    .sidebar-menu li a:hover,
    .sidebar-menu li a.active {
      background: var(--primary-light);
      color: var(--primary);
    }

    .sidebar-menu li a i {
      margin-right: 10px;
      width: 20px;
      text-align: center;
    }

    .main-content {
      flex: 1;
      margin-left: var(--sidebar-width);
      padding: 20px;
    }

    .header {
      background: white;
      padding: 15px 20px;
      border-radius: var(--border-radius);
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
      margin-bottom: 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .logout-btn {
      background: var(--primary);
      color: white;
      border: none;
      padding: 8px 15px;
      border-radius: var(--border-radius);
      cursor: pointer;
      display: flex;
      align-items: center;
      gap: 5px;
    }

    .card {
      background: white;
      border-radius: var(--border-radius);
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
      padding: 20px;
      margin-bottom: 20px;
    }

    .card-header {
      border-bottom: 1px solid var(--gray-light);
      padding-bottom: 15px;
      margin-bottom: 15px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    th,
    td {
      padding: 12px 15px;
      text-align: left;
      border-bottom: 1px solid var(--gray-light);
    }

    th {
      background: var(--gray-light);
      color: var(--dark);
      font-weight: 500;
    }

    .status {
      padding: 5px 10px;
      border-radius: 20px;
      font-size: 12px;
      font-weight: 500;
    }

    .status-pending {
      background: #fff3cd;
      color: #856404;
    }

    .status-approved {
      background: #d4edda;
      color: #155724;
    }

    .status-rejected {
      background: #f8d7da;
      color: #721c24;
    }

    .status-in-progress {
      background: #e2e3e5;
      color: #383d41;
    }

    .btn {
      padding: 8px 15px;
      border-radius: var(--border-radius);
      font-size: 14px;
      cursor: pointer;
      border: none;
      display: inline-flex;
      align-items: center;
      gap: 5px;
    }

    .btn-sm {
      padding: 5px 10px;
      font-size: 12px;
    }

    .btn-primary {
      background: var(--primary);
      color: white;
    }

    .btn-success {
      background: var(--success);
      color: white;
    }

    .btn-danger {
      background: var(--danger);
      color: white;
    }

    .profile-info {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 15px;
    }

    .profile-item {
      margin-bottom: 15px;
    }

    .profile-item label {
      display: block;
      font-size: 13px;
      color: var(--gray);
      margin-bottom: 5px;
    }

    .profile-item span {
      font-weight: 500;
    }

    .form-group {
      margin-bottom: 15px;
    }

    .form-group label {
      display: block;
      margin-bottom: 5px;
      font-weight: 500;
    }

    .form-control {
      width: 100%;
      padding: 10px;
      border: 1px solid #ddd;
      border-radius: var(--border-radius);
    }

    textarea.form-control {
      min-height: 120px;
    }

    @media (max-width: 768px) {
      .sidebar {
        width: 100%;
        position: relative;
        height: auto;
      }

      .main-content {
        margin-left: 0;
      }

      .profile-info {
        grid-template-columns: 1fr;
      }
    }
  </style>
</head>

<body>
  <!-- Sidebar Navigation -->
  <div class="sidebar">
    <div class="sidebar-header">
      <img src="https://ui-avatars.com/api/?name=<?= urlencode($child['name']) ?>&background=random" alt="Child Photo">
      <h3><?= htmlspecialchars($child['name']) ?></h3>
      <p>Room: <?= htmlspecialchars($child['room']) ?></p>
    </div>

    <ul class="sidebar-menu">
      <li><a href="#" class="active" onclick="showSection('child-info')">
          <i class="fas fa-user-graduate"></i>
          <span>Child Information</span>
        </a></li>
      <li><a href="#" onclick="showSection('complaints')">
          <i class="fas fa-exclamation-circle"></i>
          <span>Complaints</span>
        </a></li>
      <li><a href="#" onclick="showSection('permissions')">
          <i class="fas fa-walking"></i>
          <span>Permission Requests</span>
        </a></li>
      <li><a href="#" onclick="showSection('contact')">
          <i class="fas fa-envelope"></i>
          <span>Contact Warden</span>
        </a></li>
    </ul>
  </div>

  <!-- Main Content Area -->
  <div class="main-content">
    <div class="header">
      <h2>Parent Portal</h2>
      <a href="../Auth/logout.php" class="logout-btn">
        <i class="fas fa-sign-out-alt"></i>
        <span>Logout</span>
      </a>
    </div>

    <!-- Child Information Section -->
    <div id="child-info" class="section-content">
      <div class="card">
        <div class="card-header">
          <h3><i class="fas fa-user-graduate"></i> Child Information</h3>
        </div>

        <div class="profile-info">
          <div class="profile-item">
            <label>Full Name</label>
            <span><?= htmlspecialchars($child['name']) ?></span>
          </div>
          <div class="profile-item">
            <label>Room Number</label>
            <span><?= htmlspecialchars($child['room']) ?></span>
          </div>
          <div class="profile-item">
            <label>Course</label>
            <span><?= htmlspecialchars($child['course']) ?></span>
          </div>
          <div class="profile-item">
            <label>Year</label>
            <span><?= htmlspecialchars($child['year']) ?></span>
          </div>
          <div class="profile-item">
            <label>Contact Email</label>
            <span><?= htmlspecialchars($child['contact']) ?></span>
          </div>
          <div class="profile-item">
            <label>Warden Name</label>
            <span><?= htmlspecialchars($child['warden_name']) ?></span>
          </div>
          <div class="profile-item">
            <label>Warden Contact</label>
            <span><?= htmlspecialchars($child['warden_contact']) ?></span>
          </div>
        </div>
      </div>
    </div>

    <!-- Complaints Section -->
    <div id="complaints" class="section-content" style="display:none;">
      <div class="card">
        <div class="card-header">
          <h3><i class="fas fa-exclamation-circle"></i> Complaints</h3>
        </div>

        <?php if (count($complaints) > 0): ?>
          <table>
            <thead>
              <tr>
                <th>Date</th>
                <th>Type</th>
                <th>Description</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($complaints as $complaint): ?>
                <tr>
                  <td><?= date('d M Y', strtotime($complaint['date'])) ?></td>
                  <td><?= htmlspecialchars($complaint['type']) ?></td>
                  <td><?= htmlspecialchars($complaint['description']) ?></td>
                  <td>
                    <span class="status status-<?= strtolower(str_replace(' ', '-', $complaint['status'])) ?>">
                      <?= $complaint['status'] ?>
                    </span>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        <?php else: ?>
          <p>No complaints found.</p>
        <?php endif; ?>
      </div>
    </div>

    <!-- Permission Requests Section -->
    <div id="permissions" class="section-content" style="display:none;">
      <div class="card">
        <div class="card-header">
          <h3><i class="fas fa-walking"></i> Permission Requests</h3>
        </div>

        <?php if (count($permissions) > 0): ?>
          <table>
            <thead>
              <tr>
                <th>Date</th>
                <th>Reason</th>
                <th>From</th>
                <th>To</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($permissions as $permission): ?>
                <tr>
                  <td><?= date('d M Y', strtotime($permission['date'])) ?></td>
                  <td><?= htmlspecialchars($permission['reason']) ?></td>
                  <td><?= date('d M H:i', strtotime($permission['from'])) ?></td>
                  <td><?= date('d M H:i', strtotime($permission['to'])) ?></td>
                  <td>
                    <span class="status status-<?= strtolower(str_replace(' ', '-', $permission['status'])) ?>">
                      <?= $permission['status'] ?>
                    </span>
                  </td>
                  <td>
                    <?php if ($permission['status'] == 'Pending Parent Approval'): ?>
                      <button class="btn btn-success btn-sm" onclick="approvePermission(<?= $permission['id'] ?>)">
                        <i class="fas fa-check"></i> Approve
                      </button>
                      <button class="btn btn-danger btn-sm" onclick="rejectPermission(<?= $permission['id'] ?>)">
                        <i class="fas fa-times"></i> Reject
                      </button>
                    <?php endif; ?>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        <?php else: ?>
          <p>No permission requests found.</p>
        <?php endif; ?>
      </div>
    </div>

    <!-- Contact Warden Section -->
    <div id="contact" class="section-content" style="display:none;">
      <div class="card">
        <div class="card-header">
          <h3><i class="fas fa-envelope"></i> Contact Warden</h3>
        </div>

        <form>
          <div class="form-group">
            <label>Subject</label>
            <input type="text" class="form-control" placeholder="Enter subject">
          </div>

          <div class="form-group">
            <label>Message</label>
            <textarea class="form-control" placeholder="Enter your message"></textarea>
          </div>

          <button type="button" class="btn btn-primary">
            <i class="fas fa-paper-plane"></i> Send Message
          </button>
        </form>
      </div>
    </div>
  </div>

  <script>
    // Show the selected section and hide others
    function showSection(sectionId) {
      // Hide all sections
      document.querySelectorAll('.section-content').forEach(section => {
        section.style.display = 'none';
      });

      // Show the selected section
      document.getElementById(sectionId).style.display = 'block';

      // Update active state in sidebar
      document.querySelectorAll('.sidebar-menu a').forEach(link => {
        link.classList.remove('active');
      });

      // Find the clicked link and make it active
      const links = document.querySelectorAll('.sidebar-menu a');
      for (let i = 0; i < links.length; i++) {
        if (links[i].getAttribute('onclick')?.includes(sectionId)) {
          links[i].classList.add('active');
          break;
        }
      }
    }

    function approvePermission(id) {
      if (confirm('Are you sure you want to approve this permission request?')) {
        // In a real app, this would be an AJAX call to the server
        alert('Permission request #' + id + ' approved!');
        // Update the status in the UI
        const row = document.querySelector(`button[onclick="approvePermission(${id})"]`).closest('tr');
        row.querySelector('.status').textContent = 'Parent Approved';
        row.querySelector('.status').className = 'status status-approved';
        // Remove action buttons
        row.querySelector('td:last-child').innerHTML = '';
      }
    }

    function rejectPermission(id) {
      if (confirm('Are you sure you want to reject this permission request?')) {
        // In a real app, this would be an AJAX call to the server
        alert('Permission request #' + id + ' rejected!');
        // Update the status in the UI
        const row = document.querySelector(`button[onclick="rejectPermission(${id})"]`).closest('tr');
        row.querySelector('.status').textContent = 'Parent Rejected';
        row.querySelector('.status').className = 'status status-rejected';
        // Remove action buttons
        row.querySelector('td:last-child').innerHTML = '';
      }
    }
  </script>
</body>

</html>