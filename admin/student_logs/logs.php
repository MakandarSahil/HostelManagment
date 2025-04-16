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
    <title>Student Log - Hostel Management</title>

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
            <h2>Student Log</h2>
            <button onclick="openLogModal()" class="btn-add">+ Add Log</button>
            <input type="text" id="searchInput" placeholder="Search..." onkeyup="searchTable()">

            <?php if (isset($_SESSION['success'])): ?>
                <p style="color: green;"> <?php echo $_SESSION['success'];
                                            unset($_SESSION['success']); ?> </p>
            <?php endif; ?>

            <?php if (isset($_SESSION['error'])): ?>
                <p style="color: red;"> <?php echo $_SESSION['error'];
                                        unset($_SESSION['error']); ?> </p>
            <?php endif; ?>

            <div class="table-container">
                <table id="roomTable">
                    <thead>
                        <tr>
                            <th>Student Name</th>
                            <th>Out Time</th>
                            <th>In Time</th>
                            <th>Purpose</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT 
            l.log_id, l.student_id, l.out_time, l.in_time, l.purpose, l.status,
            CONCAT(u.fname, ' ', u.lname) AS student_name
        FROM StudentLog l
        JOIN Student s ON l.student_id = s.student_id
        JOIN Users u ON s.userId = u.user_id
        ORDER BY l.out_time DESC";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>
                <td>" . htmlspecialchars($row['student_name']) . "</td>
                <td>" . htmlspecialchars(date('Y-m-d h:i A', strtotime($row['out_time']))) . "</td>
                <td>" . ($row['in_time'] ? htmlspecialchars(date('Y-m-d h:i A', strtotime($row['in_time']))) : '-') . "</td>
                <td>" . htmlspecialchars($row['purpose']) . "</td>
                <td>";

                                if ($row['status'] === 'Pending') {
                                    echo "Pending
                <form action='mark_returned.php' method='POST' style='display:inline'>
                    <input type='hidden' name='log_id' value='" . $row['log_id'] . "'>
                    <button type='submit' class='action-btn'>Mark as Returned</button>
                </form>";
                                } else {
                                    echo "N/A";
                                }

                                echo "</td></tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>No logs found.</td></tr>";
                        }
                        ?>
                    </tbody>

                </table>
            </div>
        </main>
    </div>

    <!-- Add Log Modal -->
    <div id="logModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeLogModal()">&times;</span>
            <h3>Add Student Log</h3>
            <form action="add_log.php" method="POST">
                <label>Student ID</label>
                <input type="number" name="student_id" required />

                <label>Room ID</label>
                <input type="number" name="room_id" required />

                <label>Out Time</label>
                <input type="datetime-local" name="out_time" required />

                <label>In Time</label>
                <input type="datetime-local" name="in_time" />

                <label>Purpose</label>
                <input type="text" name="purpose" required />

                <label>Status</label>
                <select name="status" required>
                    <option value="Pending">Pending</option>
                    <option value="Returned">Returned</option>
                </select>

                <button type="submit">Add Log</button>
            </form>
        </div>
    </div>

    <script>
        function openLogModal() {
            document.getElementById('logModal').style.display = 'block';
        }

        function closeLogModal() {
            document.getElementById('logModal').style.display = 'none';
        }

        function searchTable() {
            const input = document.getElementById("searchInput");
            const filter = input.value.toLowerCase();
            const table = document.getElementById("roomTable");
            const tr = table.getElementsByTagName("tr");

            for (let i = 1; i < tr.length; i++) {
                let match = false;
                const td = tr[i].getElementsByTagName("td");
                for (let j = 0; j < td.length; j++) {
                    if (td[j].innerText.toLowerCase().indexOf(filter) > -1) {
                        match = true;
                        break;
                    }
                }
                tr[i].style.display = match ? "" : "none";
            }
        }
    </script>

    <script src="/hostelManagment/assets/js/sidebar.js"></script>
</body>

</html>