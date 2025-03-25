<button id="sidebarToggle" class="toggle-btn">
  <i class="fas fa-bars"></i>
</button>

<div class="sidebar" id="sidebar">
  <div class="sidebar-header">
    <div class="sidebar-icon">
      <i class="fas fa-building" style="color: white;"></i>
    </div>
    <h3>Hostel Admin</h3>
    <!-- <button id="closeSidebar" class="close-btn">&times;</button> -->
  </div>
  <ul class="sidebar-menu">
    <li>
      <a href="/hostelManagment/admin/index.php">
        <i class="fas fa-tachometer-alt"></i>
        <span>Dashboard</span>
      </a>
    </li>
    <li>
      <a href="/hostelManagment/admin/rooms/view_room.php">
        <i class="fas fa-bed"></i>
        <span>Rooms</span>
      </a>
    </li>
    <li>
      <a href="/hostelManagment/admin/rooms/view_booking.php">
        <i class="fas fa-bookmark"></i>
        <span>Bookings</span>
      </a>
    </li>
    <li>
      <a href="/hostelManagment/admin/student_logs/logs.php">
        <i class="fas fa-clipboard-list"></i>
        <span>Student Logs</span>
      </a>
    </li>
    <li>
      <a href="/hostelManagment/Auth/logout.php">
        <i class="fas fa-sign-out-alt"></i>
        <span>Logout</span>
      </a>
    </li>
  </ul>
</div>

<style>
  /*  */
</style>

<script>
  document.getElementById('sidebarToggle').addEventListener('click', function () {
    document.getElementById('sidebar').classList.toggle('open');
  });
  // document.getElementById('closeSidebar').addEventListener('click', function () {
  //   document.getElementById('sidebar').classList.remove('open');
  // });
</script>
