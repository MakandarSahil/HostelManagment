<?php
session_start();         // Start the session
session_unset();         // Unset session variables
session_destroy();       // Destroy the session completely

// Redirect clearly back to the login page
header("Location: /hostelmanagment/index.php");
exit;
?>
