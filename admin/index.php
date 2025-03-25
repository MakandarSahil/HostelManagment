<?php
session_start();
// Authentication check
if (!isset($_SESSION['logged_in']) || $_SESSION['role'] !== 'admin') {
    header("Location: /hostelManagment/Auth/login.php");
    exit;
}

// Dashboard statistics (replace these placeholders with actual database queries)
$totalRooms = 50;
$occupiedRooms = 35;
$pendingBookings = 10;
$totalStudents = 100;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Hostel Management</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/hostelManagment/assets/css/styleSidebar.css">
    <style>
        .dashboard-container {
            display: flex;
        }

        .sidebar {
            width: 250px;
            min-height: 100vh;
        }

        .main-content {
            flex-grow: 1;
            padding: 20px;
            margin-left: 250px; /* Adjust according to sidebar width */
        }

        .dashboard-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .dashboard-stats {
            display: flex;
            gap: 20px;
            margin-top: 20px;
        }

        .stat-card {
            flex: 1;
            background-color: #f4f7fa;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .stat-card i {
            font-size: 2em;
            color: #3949ab;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar Include -->
        <?php include('includes/sidebar.php'); ?>

        <main class="main-content">
            <header class="dashboard-header">
                <h1>Welcome, Admin <?php echo htmlspecialchars($_SESSION['name']); ?></h1>
                <div class="header-actions">
                    <a href="#" class="btn-notification">
                        <i class="fas fa-bell"></i>
                        <span class="badge">3</span>
                    </a>
                </div>
            </header>

            <section class="dashboard-stats">
                <div class="stat-card">
                    <div>
                        <h3>Total Rooms</h3>
                        <p><?php echo $totalRooms; ?></p>
                    </div>
                    <i class="fas fa-bed"></i>
                </div>

                <div class="stat-card">
                    <div>
                        <h3>Occupied Rooms</h3>
                        <p><?php echo $occupiedRooms; ?></p>
                    </div>
                    <i class="fas fa-door-closed"></i>
                </div>

                <div class="stat-card">
                    <div>
                        <h3>Pending Bookings</h3>
                        <p><?php echo $pendingBookings; ?></p>
                    </div>
                    <i class="fas fa-bookmark"></i>
                </div>

                <div class="stat-card">
                    <div>
                        <h3>Total Students</h3>
                        <p><?php echo $totalStudents; ?></p>
                    </div>
                    <i class="fas fa-users"></i>
                </div>
            </section>
        </main>
    </div>
</body>
</html>