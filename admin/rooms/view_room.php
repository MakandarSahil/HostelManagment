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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Rooms - Hostel Management</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/hostelManagment/assets/css/styleAdmin.css">
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
            margin-left: 250px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            border: 1px solid #ccc;
            text-align: left;
        }

        th {
            background-color: #3949ab;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f4f4f4;
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
    </style>
</head>
<body>
    <div class="dashboard-container">
        <?php include('../includes/sidebar.php'); ?>

        <main class="main-content">
            <h2>All Hostel Rooms</h2>
            <a href="add_room.php" class="btn-add">+ Add Room</a>
            <table>
                <thead>
                    <tr>
                        <th>Room No</th>
                        <th>Capacity</th>
                        <th>Status</th>
                        <th>Hostel</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Sample static data (replace with DB later) -->
                    <tr>
                        <td>101</td>
                        <td>2</td>
                        <td>Available</td>
                        <td>Block A</td>
                        <td>
                            <a href="edit_room.php?id=101">Edit</a> |
                            <a href="delete_room.php?id=101">Delete</a>
                        </td>
                    </tr>
                    <tr>
                        <td>102</td>
                        <td>3</td>
                        <td>Occupied</td>
                        <td>Block B</td>
                        <td>
                            <a href="edit_room.php?id=102">Edit</a> |
                            <a href="delete_room.php?id=102">Delete</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </main>
    </div>
</body>
</html>
