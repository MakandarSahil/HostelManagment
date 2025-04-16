<?php
session_start();
// Authentication check
if (!isset($_SESSION['logged_in']) || $_SESSION['role'] !== 'admin') {
    header("Location: /hostelManagment/Auth/login.php");
    exit;
}

include('../includes/db_connect.php');

// Fetch total rooms
$totalRooms = $conn->query("SELECT COUNT(*) FROM HostelRooms")->fetch_row()[0];

// Fetch occupied rooms (rooms with students assigned)
$occupiedRooms = $conn->query("SELECT COUNT(DISTINCT room_id) FROM Student")->fetch_row()[0];

// Fetch pending bookings
$pendingBookings = $conn->query("SELECT COUNT(*) FROM RoomBooking WHERE status = 'Pending'")->fetch_row()[0];

// Fetch total students
$totalStudents = $conn->query("SELECT COUNT(*) FROM Student")->fetch_row()[0];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Hostel Management</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/hostelManagment/assets/css/styleAdmin.css">
    <link rel="stylesheet" href="/hostelManagment/assets/css/sidebar.css">
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