<?php
echo "Admin Hashed Password: " . password_hash("admin123", PASSWORD_DEFAULT);
echo "<br>";
echo "Student Hashed Password: " . password_hash("student123", PASSWORD_DEFAULT);
?>
