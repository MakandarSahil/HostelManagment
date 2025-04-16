<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['role'] !== 'admin') {
    header("Location: /hostelManagment/Auth/login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Students - Hostel Management</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/hostelManagment/assets/css/styleAdmin.css">
    <link rel="stylesheet" href="/hostelManagment/assets/css/sidebar.css">

    <style>
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

        th,
        td {
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
            padding: 10px 15px;
            border: none;
            margin: 10px 0;
            border-radius: 5px;
            cursor: pointer;
        }

        #searchInput {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
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

        .modal-content button {
            background-color: #3949ab;
            color: white;
            border: none;
            padding: 10px;
            width: 100%;
            border-radius: 5px;
            cursor: pointer;
        }

        .modal-content .close {
            float: right;
            font-size: 24px;
            cursor: pointer;
        }

        .action-btn {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            cursor: pointer;
        }

        .action-btn:hover {
            background-color: #218838;
        }
        .nav-box {
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            padding: 30px 40px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 300px;
        }

        .nav-box h3 {
            margin-bottom: 20px;
            color: #333;
        }

        .btn-nav {
            background-color: #3949ab;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 6px;
            text-decoration: none;
            font-size: 16px;
            cursor: pointer;
        }

        .btn-nav:hover {
            background-color: #2e3e9c;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <?php include('../includes/sidebar.php'); ?>

        <main class="main-content">
            <div class="nav-box">
                <h3>Student Info</h3>
                <a href="/hostelManagment/admin/studentsInfo/studnetsInfo.php" class="btn-nav">View All Students</a>
            </div>

            <div class="nav-box">
                <h3>Student Logs</h3>
                <a href="/hostelManagment/admin/student_logs/logs.php" class="btn-nav">View Logs</a>
            </div>
        </main>
    </div>
</body>
</html>
