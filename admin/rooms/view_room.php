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
    <title>View Rooms - Hostel Management</title>

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

        .btn-edt {
            background-color: #3949ab;
            color: white;
            padding: 10px 15px;
            border: none;
            margin: 10px 0;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-dlt {
            background-color: rgb(171, 57, 57);
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
    </style>
</head>

<body>
    <?php include('../includes/sidebar.php'); ?>

    <div class="dashboard-container">
        <main class="main-content">
            <h2>All Hostel Rooms</h2>

            <button onclick="openModal()" class="btn-add">+ Add Room</button>
            <input type="text" id="searchInput" placeholder="Search..." onkeyup="searchTable()">

            <?php if (isset($_SESSION['success'])): ?>
                <p style="color: green;"><?php echo $_SESSION['success'];
                                            unset($_SESSION['success']); ?></p>
            <?php endif; ?>

            <?php if (isset($_SESSION['error'])): ?>
                <p style="color: red;"><?php echo $_SESSION['error'];
                                        unset($_SESSION['error']); ?></p>
            <?php endif; ?>

            <div class="table-container">
                <table id="roomTable">
                    <thead>
                        <tr>
                            <th class="sortable">Room No</th>
                            <th class="sortable">Capacity</th>
                            <th>Remaining Capacity</th>
                            <th class="sortable">Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // $sql = "SELECT r.room_id, r.room_no, r.capacity, r.status FROM HostelRooms r";
                        //                 $sql = "SELECT r.room_id, r.room_no, r.capacity, 
                        //        IF(COUNT(s.student_id) > 0, 'Occupied', 'Available') AS status,
                        //        h.name AS hostel_name
                        // FROM HostelRooms r
                        // JOIN Hostels h ON r.hostel_id = h.hostel_id
                        // LEFT JOIN Student s ON r.room_id = s.room_id
                        // GROUP BY r.room_id";
                        $sql = "SELECT 
        r.room_id, 
        r.room_no, 
        r.capacity, 
        COUNT(s.student_id) AS occupied_count,
        (r.capacity - COUNT(s.student_id)) AS remaining_capacity,
        IF(COUNT(s.student_id) > 0, 'Occupied', 'Available') AS status
    FROM HostelRooms r
    LEFT JOIN Student s ON r.room_id = s.room_id
    GROUP BY r.room_id";


                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>
                                        <td>" . htmlspecialchars($row['room_no']) . "</td>
                                        <td>" . htmlspecialchars($row['capacity']) . "</td>
                                        <td>" . htmlspecialchars($row['remaining_capacity']) . "</td>
                                        <td>" . htmlspecialchars($row['status']) . "</td>
                                        <td>
                                            <button class=\"btn-edt\" onclick=\"openEditModal('{$row['room_id']}', '{$row['room_no']}', '{$row['capacity']}', '{$row['status']}')\">Edit</button> |
                                            <button class=\"btn-dlt\" onclick=\"openDeleteModal('{$row['room_id']}')\">Delete</button>
                                        </td>
                                    </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>No rooms found.</td></tr>";
                        }
                        $conn->close();
                        ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    <!-- Add Room Modal -->
    <div id="addRoomModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h3>Add New Room</h3>
            <form action="add_room.php" method="POST">
                <label>Room Number</label>
                <input type="text" name="room_no" required />

                <label>Capacity</label>
                <input type="number" name="capacity" required />

                <label>Status</label>
                <select name="status" required>
                    <option value="Available">Available</option>
                    <option value="Occupied">Occupied</option>
                </select>

                <label>Hostel Name</label>
                <input type="text" name="hostel_name" required />

                <button type="submit">Add Room</button>
            </form>
        </div>
    </div>

    <!-- Edit Room Modal -->
    <div id="editRoomModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeEditModal()">&times;</span>
            <h3>Edit Room</h3>
            <form id="editRoomForm" action="edit_room.php" method="POST">
                <input type="hidden" name="room_id" id="editRoomId">

                <label>Room Number</label>
                <input type="text" name="room_no" id="editRoomNo" required>

                <label>Capacity</label>
                <input type="number" name="capacity" id="editCapacity" required>

                <label>Status</label>
                <select name="status" id="editStatus">
                    <option value="Available">Available</option>
                    <option value="Occupied">Occupied</option>
                </select>

                <button type="submit">Update Room</button>
            </form>
        </div>
    </div>

    <!-- Delete Room Modal -->
    <div id="deleteRoomModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeDeleteModal()">&times;</span>
            <h3>Are you sure you want to delete this room?</h3>
            <form id="deleteRoomForm" action="delete_room.php" method="GET">
                <input type="hidden" name="id" id="deleteRoomId">
                <button type="submit" style="background-color: red;">Yes, Delete</button>
                <button type="button" onclick="closeDeleteModal()">Cancel</button>
            </form>
        </div>
    </div>

    <script>
        function openModal() {
            document.getElementById('addRoomModal').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('addRoomModal').style.display = 'none';
        }

        function openEditModal(id, room_no, capacity, status) {
            document.getElementById("editRoomId").value = id;
            document.getElementById("editRoomNo").value = room_no;
            document.getElementById("editCapacity").value = capacity;
            document.getElementById("editStatus").value = status;
            document.getElementById("editRoomModal").style.display = "block";
        }

        function closeEditModal() {
            document.getElementById("editRoomModal").style.display = "none";
        }

        function openDeleteModal(id) {
            document.getElementById("deleteRoomId").value = id;
            document.getElementById("deleteRoomModal").style.display = "block";
        }

        function closeDeleteModal() {
            document.getElementById("deleteRoomModal").style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target.classList.contains("modal")) {
                closeModal();
                closeEditModal();
                closeDeleteModal();
            }
        }

        function searchTable() {
            const input = document.getElementById("searchInput");
            const filter = input.value.toLowerCase();
            const table = document.getElementById("roomTable");
            const tr = table.getElementsByTagName("tr");

            for (let i = 1; i < tr.length; i++) {
                let match = false;
                const td = tr[i].getElementsByTagName("td");
                for (let j = 0; j < td.length - 1; j++) {
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