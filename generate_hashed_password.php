<?php
echo "Admin Hashed Password: " . password_hash("admin123", PASSWORD_DEFAULT);
echo "<br>";
echo "Student Hashed Password: " . password_hash("student123", PASSWORD_DEFAULT);
?>

<?php
echo "Rahul: " . password_hash("rahul@123", PASSWORD_DEFAULT) . "<br>";
echo "Sneha: " . password_hash("sneha@123", PASSWORD_DEFAULT) . "<br>";
echo "Arjun: " . password_hash("arjun@123", PASSWORD_DEFAULT) . "<br>";
echo "Priya: " . password_hash("priya@123", PASSWORD_DEFAULT) . "<br>";
echo "Amit: " . password_hash("amit@123", PASSWORD_DEFAULT) . "<br>";
?>
