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
    
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    
    <!-- Admin & Sidebar CSS -->
    <link rel="stylesheet" href="/hostelManagment/assets/css/styleAdmin.css">
    <link rel="stylesheet" href="/hostelManagment/assets/css/sidebar.css">

    <style>
        /* Table Styling */
        .table-container {
            width: 100%;
            overflow-x: auto;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            min-width: 600px;
        }

        th, td {
            padding: 12px;
            border: 1px solid #ccc;
            text-align: left;
        }

        th {
            background-color: #3949ab;
            color: white;
            cursor: pointer; /* Indicates it's sortable */
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

        /* Search Box Styling */
        #searchInput {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <!-- Sidebar Include -->
    <?php include('../includes/sidebar.php'); ?>

    <div class="dashboard-container">
        <main class="main-content">
            <h2>All Hostel Rooms</h2>
            <a href="add_room.php" class="btn-add">+ Add Room</a>

            <!-- Search Box -->
            <input type="text" id="searchInput" placeholder="Search..." onkeyup="searchTable()">

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th class="sortable">Room No</th>
                            <th class="sortable">Capacity</th>
                            <th class="sortable">Status</th>
                            <th class="sortable">Hostel</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>101</td>
                            <td>2</td>
                            <td>Available</td>
                            <td>Block A</td>
                            <td>
                                <a href="edit_room.php?id=101">Edit</a> |
                                <a href="delete_room.php?id=101" onclick="return confirm('Are you sure?')">Delete</a>
                            </td>
                        </tr>
                        <tr>
                            <td>102</td>
                            <td>3</td>
                            <td>Occupied</td>
                            <td>Block B</td>
                            <td>
                                <a href="edit_room.php?id=102">Edit</a> |
                                <a href="delete_room.php?id=102" onclick="return confirm('Are you sure?')">Delete</a>
                            </td>
                        </tr>
                        <tr>
                            <td>103</td>
                            <td>4</td>
                            <td>Available</td>
                            <td>Block C</td>
                            <td>
                                <a href="edit_room.php?id=103">Edit</a> |
                                <a href="delete_room.php?id=103" onclick="return confirm('Are you sure?')">Delete</a>
                            </td>
                        </tr>
                        <tr>
                            <td>104</td>
                            <td>1</td>
                            <td>Occupied</td>
                            <td>Block D</td>
                            <td>
                                <a href="edit_room.php?id=104">Edit</a> |
                                <a href="delete_room.php?id=104" onclick="return confirm('Are you sure?')">Delete</a>
                            </td>
                        </tr>
                        <tr>
                            <td>105</td>
                            <td>3</td>
                            <td>Available</td>
                            <td>Block A</td>
                            <td>
                                <a href="edit_room.php?id=105">Edit</a> |
                                <a href="delete_room.php?id=105" onclick="return confirm('Are you sure?')">Delete</a>
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
