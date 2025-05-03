<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['role'] != 'student') {
    header("Location: /hostelmanagment/Auth/login.php");
    exit;
}

// Sample data - in a real app this would come from a database
$announcements = [
    [
        'title' => 'Hostel Maintenance',
        'content' => 'There will be water supply interruption tomorrow from 9 AM to 3 PM for maintenance work.',
        'date' => '2023-10-14'
    ],
    [
        'title' => 'Cultural Fest',
        'content' => 'Annual hostel cultural fest will be held on November 5th. Registrations are now open.',
        'date' => '2023-10-05'
    ],
    [
        'title' => 'New Warden',
        'content' => 'We welcome our new hostel warden, Dr. Smitha Patel. She will be available for meetings every Wednesday.',
        'date' => '2023-09-28'
    ]
];

$user = [
    'name' => $_SESSION['name'],
    'room' => 'B-204',
    'contact' => '9876543210',
    'email' => $_SESSION['email'] ?? 'student@example.com',
    'course' => 'Computer Science',
    'year' => '3rd Year'
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
        'status' => 'Approved',
        'date' => '2023-10-10'
    ],
    [
        'id' => 2002,
        'reason' => 'Medical Checkup',
        'from' => '2023-10-12 10:00',
        'to' => '2023-10-12 14:00',
        'status' => 'Rejected',
        'date' => '2023-10-08'
    ]
];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Hostel Portal</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        :root {
            --primary: #4361ee;
            --primary-light: #e0e7ff;
            --secondary: #3f37c9;
            --accent: #4895ef;
            --light: #f8f9fa;
            --dark: #212529;
            --success: #4cc9f0;
            --success-light: #e6f7ff;
            --warning: #f72585;
            --warning-light: #ffe6ef;
            --danger: #ef233c;
            --danger-light: #ffebee;
            --gray: #6c757d;
            --gray-light: #f1f3f5;
            --border-radius: 12px;
            --box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f7fa;
            color: var(--dark);
            line-height: 1.6;
        }

        .container {
            max-width: 100%;
            margin: 0 auto;
            padding: 20px;
        }

        header {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            box-shadow: var(--box-shadow);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 15       px;
            font-weight: 700;
            display: flex;
            align-items: center;
        }

        .logo i {
            margin-right: 10px;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .user-info img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid white;
        }

        .logout-btn {
            background-color: rgba(255, 255, 255, 0.2);
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 20px;
            cursor: pointer;
            font-weight: 500;
            transition: var(--transition);
            margin-left: 15px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .logout-btn:hover {
            background-color: rgba(255, 255, 255, 0.3);
        }

        .main-content {
            display: grid;
            grid-template-columns: 280px 1fr;
            gap: 25px;
            margin-top: 20px;
            /* display: none; */
        }

        .sidebar {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            padding: 25px;
            height: fit-content;
            position: sticky;
            top: 100px;
        }

        .sidebar-menu {
            list-style: none;
            margin-top: 20px;
        }

        .sidebar-menu li {
            margin-bottom: 10px;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            padding: 10px 15px;
            border-radius: 8px;
            color: var(--dark);
            text-decoration: none;
            transition: var(--transition);
            gap: 10px;
        }

        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            background-color: var(--primary-light);
            color: var(--primary);
        }

        .sidebar-menu a i {
            width: 20px;
            text-align: center;
        }

        .content-area {
            display: grid;
            gap: 25px;
        }

        .card {
            background: white;
            border-radius: var(--border-radius);
            padding: 25px;
            box-shadow: var(--box-shadow);
            margin-bottom: 10px;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid var(--gray-light);
        }

        .card-header h2 {
            font-size: 20px;
            color: var(--primary);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .btn {
            padding: 8px 16px;
            border-radius: 6px;
            border: none;
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .btn-primary {
            background-color: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background-color: var(--secondary);
        }

        .btn-outline {
            background: transparent;
            border: 1px solid var(--primary);
            color: var(--primary);
        }

        .btn-outline:hover {
            background-color: var(--primary-light);
        }

        .announcement-item {
            padding: 15px 0;
            border-bottom: 1px solid var(--gray-light);
        }

        .announcement-item:last-child {
            border-bottom: none;
        }

        .announcement-item h4 {
            color: var(--dark);
            margin-bottom: 5px;
            font-size: 16px;
        }

        .announcement-item p {
            color: var(--gray);
            font-size: 14px;
            margin-bottom: 5px;
        }

        .announcement-item .date {
            font-size: 12px;
            color: var(--gray);
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .table-responsive {
            overflow-x: auto;
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
            background-color: var(--primary-light);
            color: var(--primary);
            font-weight: 600;
        }

        tr:hover {
            background-color: var(--gray-light);
        }

        .status {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }

        .status-pending {
            background-color: #fff3cd;
            color: #856404;
        }

        .status-approved {
            background-color: var(--success-light);
            color: var(--success);
        }

        .status-rejected {
            background-color: var(--danger-light);
            color: var(--danger);
        }

        .status-in-progress {
            background-color: #e2e3e5;
            color: #383d41;
        }

        .profile-info {
            display: grid;
            grid-template-columns: 120px 1fr;
            gap: 25px;
            align-items: center;
        }

        .profile-pic {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 5px solid var(--primary-light);
        }

        .profile-details {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
        }

        .profile-detail {
            margin-bottom: 10px;
        }

        .profile-detail label {
            display: block;
            font-size: 13px;
            color: var(--gray);
            margin-bottom: 3px;
        }

        .profile-detail span {
            font-weight: 500;
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background: white;
            border-radius: var(--border-radius);
            width: 100%;
            max-width: 500px;
            padding: 25px;
            box-shadow: 0 5px 30px rgba(0, 0, 0, 0.3);
            animation: modalFadeIn 0.3s ease;
        }

        @keyframes modalFadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .modal-header h3 {
            font-size: 20px;
            color: var(--primary);
        }

        .close-btn {
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            color: var(--gray);
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
            padding: 10px 15px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-family: inherit;
            transition: var(--transition);
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.2);
        }

        textarea.form-control {
            min-height: 100px;
            resize: vertical;
        }

        .modal-footer {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 20px;
            padding-top: 15px;
            border-top: 1px solid var(--gray-light);
        }

        .tab-container {
            margin-top: 20px;
        }

        .tabs {
            display: flex;
            border-bottom: 1px solid var(--gray-light);
            margin-bottom: 20px;
        }

        .tab {
            padding: 10px 20px;
            cursor: pointer;
            font-weight: 500;
            color: var(--gray);
            border-bottom: 2px solid transparent;
            transition: var(--transition);
        }

        .tab.active {
            color: var(--primary);
            border-bottom-color: var(--primary);
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        .empty-state {
            text-align: center;
            padding: 40px 0;
            color: var(--gray);
        }

        .empty-state i {
            font-size: 50px;
            margin-bottom: 15px;
            color: var(--gray-light);
        }

        @media (max-width: 992px) {
            .main-content {
                grid-template-columns: 1fr;
            }

            .sidebar {
                position: static;
            }

            .profile-details {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .header-content {
                flex-direction: column;
                text-align: center;
                gap: 15px;
            }

            .user-info {
                margin-top: 10px;
            }
        }
    </style>
</head>

<body>
    <header>
        <div class="container header-content">
            <div class="logo">
                <i class="fas fa-home"></i>
                <span>Hostel Management System</span>
            </div>
            <div class="user-info">
                <a href="../Auth/logout.php" class="logout-btn">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
            </div>
        </div>
    </header>

    <div class="container">
        <div class="main-content">
            <!-- Sidebar Navigation -->
            <aside class="sidebar">
                <div class="profile-summary">
                    <img src="https://ui-avatars.com/api/?name=<?= urlencode($user['name']) ?>&background=<?= substr(md5($user['name']), 0, 6) ?>&color=fff&size=120" alt="Profile" class="profile-pic">
                    <h3 style="margin-top: 15px; text-align: center;"><?= htmlspecialchars($user['name']) ?></h3>
                    <p style="text-align: center; color: var(--gray); font-size: 14px;">Room: <?= htmlspecialchars($user['room']) ?></p>
                </div>

                <ul class="sidebar-menu">
                    <li><a href="#" class="active" onclick="showTab('dashboard')">
                            <i class="fas fa-tachometer-alt"></i>
                            <span>Dashboard</span>
                        </a></li>
                    <li><a href="#" onclick="showTab('complaints')">
                            <i class="fas fa-exclamation-circle"></i>
                            <span>Complaints</span>
                        </a></li>
                    <li><a href="#" onclick="showTab('permissions')">
                            <i class="fas fa-walking"></i>
                            <span>Permissions</span>
                        </a></li>
                    <li><a href="#" onclick="showTab('profile')">
                            <i class="fas fa-user"></i>
                            <span>My Profile</span>
                        </a></li>
                </ul>
            </aside>

            <!-- Main Content Area -->
            <div class="content-area">
                <!-- Dashboard Tab -->
                <div id="dashboard" class="tab-content active">
                    <div class="card">
                        <h2 style="color: var(--primary); margin-bottom: 20px;">Welcome, <?= htmlspecialchars($user['name']) ?>!</h2>
                        <p style="color: var(--gray); margin-bottom: 20px;">Here's what's happening in your hostel today.</p>

                        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-top: 30px;">
                            <div class="card" style="background-color: var(--primary-light); border-left: 4px solid var(--primary);">
                                <h3 style="color: var(--primary); margin-bottom: 10px;">Room Details</h3>
                                <p style="font-size: 14px; color: var(--gray);">You're staying in <strong><?= htmlspecialchars($user['room']) ?></strong></p>
                            </div>
                            <div class="card" style="background-color: var(--success-light); border-left: 4px solid var(--success);">
                                <h3 style="color: var(--success); margin-bottom: 10px;">Active Permissions</h3>
                                <p style="font-size: 14px; color: var(--gray);">You have <strong>1 approved</strong> permission</p>
                            </div>
                            <div class="card" style="background-color: var(--warning-light); border-left: 4px solid var(--warning);">
                                <h3 style="color: var(--warning); margin-bottom: 10px;">Pending Complaints</h3>
                                <p style="font-size: 14px; color: var(--gray);">You have <strong>1 pending</strong> complaint</p>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h2><i class="fas fa-bullhorn"></i> Announcements</h2>
                        </div>

                        <?php foreach ($announcements as $announcement): ?>
                            <div class="announcement-item">
                                <h4><?= htmlspecialchars($announcement['title']) ?></h4>
                                <p><?= htmlspecialchars($announcement['content']) ?></p>
                                <div class="date">
                                    <i class="far fa-calendar-alt"></i>
                                    <?= date('F j, Y', strtotime($announcement['date'])) ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Complaints Tab -->
                <div id="complaints" class="tab-content">
                    <div class="card">
                        <div class="card-header">
                            <h2><i class="fas fa-exclamation-circle"></i> My Complaints</h2>
                            <button class="btn btn-primary" onclick="openModal('complaintModal')">
                                <i class="fas fa-plus"></i> New Complaint
                            </button>
                        </div>

                        <?php if (count($complaints) > 0): ?>
                            <div class="table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Type</th>
                                            <th>Description</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($complaints as $complaint): ?>
                                            <tr>
                                                <td>#<?= $complaint['id'] ?></td>
                                                <td><?= htmlspecialchars($complaint['type']) ?></td>
                                                <td><?= htmlspecialchars($complaint['description']) ?></td>
                                                <td><?= date('M j, Y', strtotime($complaint['date'])) ?></td>
                                                <td>
                                                    <span class="status status-<?= strtolower(str_replace(' ', '-', $complaint['status'])) ?>">
                                                        <?= $complaint['status'] ?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <button class="btn btn-outline" style="padding: 5px 10px; font-size: 12px;">
                                                        <i class="fas fa-eye"></i> View
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php else: ?>
                            <div class="empty-state">
                                <i class="fas fa-exclamation-circle"></i>
                                <h3>No Complaints Found</h3>
                                <p>You haven't submitted any complaints yet.</p>
                                <button class="btn btn-primary" onclick="openModal('complaintModal')" style="margin-top: 15px;">
                                    <i class="fas fa-plus"></i> Submit Your First Complaint
                                </button>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Permissions Tab -->
                <div id="permissions" class="tab-content">
                    <div class="card">
                        <div class="card-header">
                            <h2><i class="fas fa-walking"></i> My Permissions</h2>
                            <button class="btn btn-primary" onclick="openModal('permissionModal')">
                                <i class="fas fa-plus"></i> New Request
                            </button>
                        </div>

                        <?php if (count($permissions) > 0): ?>
                            <div class="table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Reason</th>
                                            <th>From</th>
                                            <th>To</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($permissions as $permission): ?>
                                            <tr>
                                                <td>#<?= $permission['id'] ?></td>
                                                <td><?= htmlspecialchars($permission['reason']) ?></td>
                                                <td><?= date('M j, g:i A', strtotime($permission['from'])) ?></td>
                                                <td><?= date('M j, g:i A', strtotime($permission['to'])) ?></td>
                                                <td><?= date('M j, Y', strtotime($permission['date'])) ?></td>
                                                <td>
                                                    <span class="status status-<?= strtolower($permission['status']) ?>">
                                                        <?= $permission['status'] ?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <button class="btn btn-outline" style="padding: 5px 10px; font-size: 12px;">
                                                        <i class="fas fa-eye"></i> View
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php else: ?>
                            <div class="empty-state">
                                <i class="fas fa-walking"></i>
                                <h3>No Permission Requests</h3>
                                <p>You haven't requested any permissions yet.</p>
                                <button class="btn btn-primary" onclick="openModal('permissionModal')" style="margin-top: 15px;">
                                    <i class="fas fa-plus"></i> Request Your First Permission
                                </button>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Profile Tab -->
                <div id="profile" class="tab-content">
                    <div class="card">
                        <div class="card-header">
                            <h2><i class="fas fa-user"></i> My Profile</h2>
                        </div>

                        <div class="profile-info">
                            <img src="https://ui-avatars.com/api/?name=<?= urlencode($user['name']) ?>&background=<?= substr(md5($user['name']), 0, 6) ?>&color=fff&size=200" alt="Profile" class="profile-pic">

                            <div class="profile-details">
                                <div class="profile-detail">
                                    <label>Full Name</label>
                                    <span><?= htmlspecialchars($user['name']) ?></span>
                                </div>
                                <div class="profile-detail">
                                    <label>Room Number</label>
                                    <span><?= htmlspecialchars($user['room']) ?></span>
                                </div>
                                <div class="profile-detail">
                                    <label>Email</label>
                                    <span><?= htmlspecialchars($user['email']) ?></span>
                                </div>
                                <div class="profile-detail">
                                    <label>Contact Number</label>
                                    <span><?= htmlspecialchars($user['contact']) ?></span>
                                </div>
                                <div class="profile-detail">
                                    <label>Course</label>
                                    <span><?= htmlspecialchars($user['course']) ?></span>
                                </div>
                                <div class="profile-detail">
                                    <label>Year</label>
                                    <span><?= htmlspecialchars($user['year']) ?></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="card">
                        <div class="card-header">
                            <h2><i class="fas fa-lock"></i> Change Password</h2>
                        </div>

                        <form style="margin-top: 20px;">
                            <div class="form-group">
                                <label for="current-password">Current Password</label>
                                <input type="password" id="current-password" class="form-control" placeholder="Enter current password">
                            </div>
                            <div class="form-group">
                                <label for="new-password">New Password</label>
                                <input type="password" id="new-password" class="form-control" placeholder="Enter new password">
                            </div>
                            <div class="form-group">
                                <label for="confirm-password">Confirm New Password</label>
                                <input type="password" id="confirm-password" class="form-control" placeholder="Confirm new password">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline">Cancel</button>
                                <button type="button" class="btn btn-primary">Update Password</button>
                            </div>
                        </form>
                    </div> -->
                </div>
            </div>
        </div>
    </div>

    <!-- Complaint Modal -->
    <div id="complaintModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3><i class="fas fa-exclamation-circle"></i> New Complaint</h3>
                <button class="close-btn" onclick="closeModal('complaintModal')">&times;</button>
            </div>

            <form>
                <div class="form-group">
                    <label for="complaint-type">Complaint Type</label>
                    <select id="complaint-type" class="form-control">
                        <option value="">Select complaint type</option>
                        <option value="Electrical">Electrical</option>
                        <option value="Plumbing">Plumbing</option>
                        <option value="Furniture">Furniture</option>
                        <option value="Cleaning">Cleaning</option>
                        <option value="Other">Other</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="complaint-description">Description</label>
                    <textarea id="complaint-description" class="form-control" placeholder="Describe your complaint in detail..."></textarea>
                </div>

                <div class="form-group">
                    <label for="complaint-urgency">Urgency Level</label>
                    <select id="complaint-urgency" class="form-control">
                        <option value="Low">Low - Can wait a few days</option>
                        <option value="Medium">Medium - Needs attention soon</option>
                        <option value="High">High - Requires immediate action</option>
                    </select>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline" onclick="closeModal('complaintModal')">Cancel</button>
                    <button type="button" class="btn btn-primary">Submit Complaint</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Permission Modal -->
    <div id="permissionModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3><i class="fas fa-walking"></i> Permission Request</h3>
                <button class="close-btn" onclick="closeModal('permissionModal')">&times;</button>
            </div>

            <form>
                <div class="form-group">
                    <label for="permission-reason">Reason for Permission</label>
                    <select id="permission-reason" class="form-control">
                        <option value="">Select reason</option>
                        <option value="Family Function">Family Function</option>
                        <option value="Medical Checkup">Medical Checkup</option>
                        <option value="Personal Work">Personal Work</option>
                        <option value="College Event">College Event</option>
                        <option value="Other">Other</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="permission-description">Additional Details</label>
                    <textarea id="permission-description" class="form-control" placeholder="Provide additional details about your request..."></textarea>
                </div>

                <div class="form-group">
                    <label for="permission-from">From</label>
                    <input type="datetime-local" id="permission-from" class="form-control">
                </div>

                <div class="form-group">
                    <label for="permission-to">To</label>
                    <input type="datetime-local" id="permission-to" class="form-control">
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline" onclick="closeModal('permissionModal')">Cancel</button>
                    <button type="button" class="btn btn-primary">Submit Request</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function showTab(tabId) {
            // Hide all tab contents
            document.querySelectorAll('.tab-content').forEach(tab => {
                tab.classList.remove('active');
            });

            // Show the selected tab content
            document.getElementById(tabId).classList.add('active');

            // Update active state in sidebar
            document.querySelectorAll('.sidebar-menu a').forEach(link => {
                link.classList.remove('active');
            });

            // Find the clicked link and make it active
            const links = document.querySelectorAll('.sidebar-menu a');
            for (let i = 0; i < links.length; i++) {
                if (links[i].getAttribute('onclick')?.includes(tabId)) {
                    links[i].classList.add('active');
                    break;
                }
            }
        }

        function openModal(modalId) {
            document.getElementById(modalId).style.display = 'flex';
        }

        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }

        // Close modal when clicking outside of it
        window.onclick = function(event) {
            if (event.target.className === 'modal') {
                event.target.style.display = 'none';
            }
        }
    </script>
</body>

</html>