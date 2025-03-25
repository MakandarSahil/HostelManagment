<?php
session_start();
include('../includes/db_connect.php');

// Prevent browser caching to fix back-button issue
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

if (isset($_SESSION['logged_in'])) {
    if ($_SESSION['role'] == 'admin') {
        header("Location: /hostelManagment/admin/index.php");
        exit;
    } elseif ($_SESSION['role'] == 'student') {
        header("Location: /hostelManagment/student/dashboard.php");
        exit;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $stmt = $conn->prepare("SELECT * FROM Users WHERE email = ? AND isActive = 1");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            $_SESSION['logged_in'] = true;
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['name'] = $user['fname'];

            if ($user['role'] == 'admin') {
                header("Location: /hostelManagment/admin/index.php");
                exit;
            } elseif ($user['role'] == 'student') {
                header("Location: /hostelManagment/student/dashboard.php");
                exit;
            }
        } else {
            $error = "Incorrect Password";
        }
    } else {
        $error = "User not found or inactive";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login - Hostel Management</title>
  <link rel="stylesheet" href="../assets/css/styleLogin.css">
</head>
<body>

<div class="login-container">
  <form action="login.php" method="POST" class="login-form">
    <h2>User Login</h2>

    <?php if(isset($error)) { ?>
      <p class="error"><?php echo htmlspecialchars($error); ?></p>
    <?php } ?>

    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>

    <button type="submit">Login</button>
  </form>
</div>

</body>
</html>