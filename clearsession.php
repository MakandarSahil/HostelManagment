<?php
session_start();
session_destroy();
echo "Session cleared. <a href='/hostelmanagment/Auth/login.php'>Login</a>";
?>
