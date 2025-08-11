<?php include("includes/db.php"); session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <h2>User Login</h2>
    <form action="" method="POST">
        Email: <input type="email" name="email" required><br>
        Password: <input type="password" name="password" required><br>
        <button type="submit" name="login">Login</button>
    </form>
    <a href="register.php">Don't have an account? Register</a>

<?php
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];

        if ($user['role'] == 'admin') {
            header("Location: admin/admin_panel.php");
        } elseif ($user['role'] == 'pharmacist') {
            header("Location: pharmacist/pharmacist_dashboard.php");
        } else {
            header("Location: dashboard.php");
        }
    } else {
        echo "<p style='color:red;'>Invalid credentials.</p>";
    }
}
?>
</body>
</html>
