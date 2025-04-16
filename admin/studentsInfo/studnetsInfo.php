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
    </style>
</head>
<body>
    <?php include('../includes/sidebar.php'); ?>

    <div class="dashboard-container">
        <main class="main-content">
            <h2>All Students</h2>
            <table>
                <thead>
                    <tr>
                        <th>Student ID</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Room No</th>
                        <th>Admission Date</th>
                        <th>Parent's Contact</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT s.student_id, CONCAT(u.fname, ' ', u.lname) AS full_name, u.email, u.phone,
                                   hr.room_no, s.admission_date, s.parents_no
                            FROM Student s
                            JOIN Users u ON s.userId = u.user_id
                            LEFT JOIN HostelRooms hr ON s.room_id = hr.room_id";

                    $result = $conn->query($sql);
                    if ($result && $result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>{$row['student_id']}</td>
                                    <td>" . htmlspecialchars($row['full_name']) . "</td>
                                    <td>" . htmlspecialchars($row['email']) . "</td>
                                    <td>" . htmlspecialchars($row['phone']) . "</td>
                                    <td>" . htmlspecialchars($row['room_no'] ?? 'NA') . "</td>
                                    <td>" . htmlspecialchars($row['admission_date']) . "</td>
                                    <td>" . htmlspecialchars($row['parents_no']) . "</td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7'>No students found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </main>
    </div>
</body>
</html>
